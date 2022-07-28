<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Backup extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage = 8;

    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public function create()
    {
        $exitCode = Artisan::call('snapshot:create');
        $output = Artisan::output();

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

    private function relativeDate($disk, string $file): string
    {
        $lastModified = $disk->lastModified($file);
        $diff4Humans = Carbon::createFromTimestamp($lastModified)->diffForHumans();
        return ucfirst($diff4Humans);
    }

    private function absoluteDate($disk, string $file): string
    {
        $lastModified = $disk->lastModified($file);
        $date = Carbon::createFromTimestamp($lastModified)->isoFormat('MMMM D, YYYY, HH:mm:ss');
        return ucfirst("$date (GMT-5)");
    }

    private function size($disk, string $file): string
    {
        $suffixes = ['bytes', 'KB', 'MB', 'GB', 'TB'];

        $size = $disk->size($file);
        $base = log($size) / log(1024);
        $chosenSuffix = $suffixes[floor($base)];
        $diff4Humans = round(pow(1024, $base - floor($base)), 2);

        return "$diff4Humans $chosenSuffix";
    }

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
                    'path' => $file,
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
}
