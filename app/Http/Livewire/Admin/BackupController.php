<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Controla la vista de respaldos
 *
 * Libreria utlizada: {@link https://github.com/spatie/laravel-db-snapshots laravel-db-snapshots}
*/
class BackupController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    /**
         * Ruta del respaldo relativa al `disk` utilizado
         *
         * Ejemplo: `backup/2022-02-01.sql`
         */
        public string $file_path;

        /**
         * Determina el valor inicial de la paginación.
         */
        public int $perPage = 8;

        /**
         * Controla visibilidad del modal de confirmación
         */
        public bool $showConfirmationModal = false;

        /**
         * Refleja la acción que se ejecutará: Eliminar un respaldo
         *
         * Es utilizada en la vista del modal de confirmación para cambiar el texto y el botón
         */
        public bool $delete = false;

        /**
         * Refleja la acción que se ejecutará: Restaurar un respaldo
         *
         * Es utilizada en la vista del modal de confirmación para cambiar el texto y el botón
         */
        public bool $restore = false;

        /**
         * Permite personalizar el query string del navegador
         *
         * - La paginación por defecto (8) se omite
         * - Se usa un alias para la paginación: `p`
         *
         * Ejemplo: `http://localhost/admin/backup?p=16`
         *
         * @var array[]
     */
    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public bool $modal_ayuda = false;
    /**
     * Refleja la acción de crear respaldo y activa el modal de confirmación
     *
     * @return void
     */
    public function create()
    {
        $this->authorize('backup.create');
        $this->delete = false;
        $this->restore = false;
        $this->showConfirmationModal = true;
    }
    /**
     * Ejecuta el comando de creación de respaldos, notifica en el sistema y en el registro de Laravel
     *
     * @return void
     */
    public function save()
    {
        $exitCode = Artisan::call('snapshot:create');
        $output = Artisan::output();

        $this->showConfirmationModal = false;
        if ($exitCode === 1) {

            Log::info("DB-Snapshot -- Creando un nuevo respaldo \r\n
            $output\r\n
            DB-Snapshot -- Respaldo no creado");

            $this->dispatchBrowserEvent('notify', [
                'icon' => 'close',
                'message' => 'Respaldo no creado',
            ]);
            return;
        }

        Log::info("DB-Snapshot -- Creando un nuevo respaldo \r\n
            $output\r\n
            DB-Snapshot -- Respaldo creado exitosamente");

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Respaldo creado exitosamente',
        ]);
    }
    /**
     * Descarga el respaldo seleccionado
     *
     * @param string $file_path Ruta/Nombre del respaldo
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(string $file_path)
    {
        $this->authorize('backup.download');
        $snapshotDir = config('db-snapshots.disk');
        $path = config("filesystems.disks.$snapshotDir.root")."/$file_path";

        return response()->download($path);
    }

    /**
     * Refleja la acción de eliminar respaldo y activa el modal de confirmación
     *
     * @param string $file_path Ruta del respaldo
     * @param string $file_name Nombre del respaldo
     * @return void
     */
    public function delete(string $file_path, string $file_name)
    {
        $this->authorize('backup.delete');
        $this->file_path = $file_path;

        $this->delete = true;
        $this->restore = false;
        $this->showConfirmationModal = true;
    }

    /**
     * Elimina el respaldo seleccionado, notifica en el sistema y en el registro de Laravel
     *
     * @return void
     */
    public function destroy()
    {
        $disk = Storage::disk(config('db-snapshots.disk'));
        $disk->delete($this->file_path);
        $this->showConfirmationModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' => 'Respaldo eliminado exitosamente',
        ]);
    }

    /**
     * Refleja la acción de restaurar respaldo y activa el modal de confirmación
     *
     * @param string $file_path Ruta del respaldo
     * @param string $file_name Nombre del respaldo
     * @return void
     */
    public function restoreConfirm(string $file_path, string $file_name)
    {
        $this->authorize('backup.restore');
        $this->file_path = $file_path;

        $this->delete = false;
        $this->restore = true;
        $this->showConfirmationModal = true;
    }

    /**
     * Restaura el respaldo seleccionado, notifica en el sistema y en el registro de Laravel
     *
     * Puede que la sesión activa se pierda, por lo que se redirecciona a la ruta actual.
     * Esto para que vuelva a iniciar sesión si fuese necesario
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore()
    {
        $filename_without_ext = pathinfo($this->file_path, PATHINFO_FILENAME);
        Artisan::call("snapshot:load $filename_without_ext", [
            '--force' => true
        ]);

        $this->showConfirmationModal = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Respaldo restaurado exitosamente',
        ]);
        sleep(2);

        return redirect()->route('admin.backup');
    }

    /**
     * Convierte un timestamp a una fecha relativa a la actual
     *
     * Ejemplo: `Hace 1 hora`
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem $disk Almacenamiento con el que se interactuará
     * @param string $file Nombre del archivo
     * @return string Fecha relativa
     */
    private function relativeDate($disk, string $file): string
    {
        $lastModified = $disk->lastModified($file);
        $diff4Humans = Carbon::createFromTimestamp($lastModified)->diffForHumans();
        return ucfirst($diff4Humans);
    }

    /**
     * Convierte un timestamp a una fecha con formato 'MMMM D, YYYY, HH:mm:ss'
     *
     * Ejemplo: `Julio 28, 2022, 00:57:20 (GMT-5)`
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem $disk Almacenamiento con el que se interactuará
     * @param string $file Nombre del archivo
     * @return string Fecha con formato
     */
    private function absoluteDate($disk, string $file): string
    {
        $lastModified = $disk->lastModified($file);
        $date = Carbon::createFromTimestamp($lastModified)->isoFormat('MMMM D, YYYY, HH:mm:ss');
        return ucfirst("$date (GMT-5)");
    }

    /**
     * Convierte el tamaño en bytes a KB, MB, GB y TB
     *
     * Ejemplo: `14.12 KB`
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem $disk Almacenamiento con el que se interactuará
     * @param string $file Nombre del archivo
     * @return string Tamaño en formato legible
     */
    private function size($disk, string $file): string
    {
        $suffixes = ['bytes', 'KB', 'MB', 'GB', 'TB'];

        $size = $disk->size($file);
        $base = log($size) / log(1024);
        $chosenSuffix = $suffixes[floor($base)];
        $diff4Humans = round(pow(1024, $base - floor($base)), 2);

        return "$diff4Humans $chosenSuffix";
    }

    /**
     * Renderiza la vista y se actualiza cada vez que haya un cambio
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $disk = Storage::disk(config('db-snapshots.disk'));
        $files = $disk->files();
        $backups = [];

        foreach ($files as $file) {
            if ($disk->exists($file) || pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $backups[] = [
                    'file_name' => $file,
                    'file_size' => $this->size($disk, $file),
                    'file_date' => $this->absoluteDate($disk, $file),
                    'file_relative_date' => $this->relativeDate($disk, $file),
                    'size' => $disk->size($file),
                    'date' => $disk->lastModified($file),
                ];
            }
        }

        $backups = array_reverse($backups);
        $backups = collect($backups)
            ->sortBy($this->sortField, descending: $this->sortDirection === 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.backup.index', ['backups' => $backups]);
    }

    public function mostrar_ayuda(){
        $this->modal_ayuda = true;
    }
}
