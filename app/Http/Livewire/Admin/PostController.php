<?php

namespace App\Http\Livewire\Admin;

use App\Events\PostEvent;
use App\notifications\PostNotification;
use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Http\Traits\WithSearching;

class PostController extends Component
{
    use WithPagination;
    use WithSearching;
    // public Post $post;


    public $posts;
    public $title;
    public Post $postt;

    //variables de modales
    public $edit = false;
    public $create = false;
    public $showEditModal = 0;
    public $showViewModal =false;
    public $confirmingPartDeletion = false;
    public $confirmingSaveParti = false;
    public $confirminNotificacion=false;
    public $deletetodasnotifi= false;
    public $confirmingSaveNotificacion=false;

    //Variables de busqueda y paginación
    public int $perPage = 5;
    protected array $cleanStringsExcept = ['search'];

    //atributos del mensaje
    public $arr=[
        'title' => '',
        'description' =>'',
        'post_id' =>'',
        'role' =>'',
    ];

    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public function render()
    {
        return view('livewire.admin.notifications.index', [
            'postss' => Post::query()
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.id','posts.title', 'posts.description','posts.role','posts.created_at')
            ->when($this->search, function ($query, $b) {
                return $query->where(function ($q) {
                    $q->Where('posts.title', 'like', '%'.$this->search.'%')
                    ->orWhere('posts.description', 'like', '%'.$this->search.'%')
                    ->orWhere('posts.role', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('posts.created_at', 'DESC')
            ->paginate($this->perPage),
        ]);
    }

    public function openModal()
    {
        $this->showEditModal = true;
    }

    public function closeModal()
    {
        $this->showEditModal = false;
    }

    public function resetInputFields()
    {
        $this->reset('arr');
    }

    private function validateInputs()
    {
        $this->validate([
            'arr.title' => ['required', 'regex:/^[A-Z,Ñ,a-z,1-9][A-Z,a-z, ,,1-9,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:40'],
            'arr.description' => ['required', 'regex:/^[A-Z,Ñ,a-z,1-9][A-Z,a-z, ,,1-9,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'arr.role' =>  ['required', 'regex:/^[Participante, Instructor, Todos]+$/', 'max:15'],
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
        $this->edit = false;
        $this->create = true;
    }

    public function view(Post $post)
    {
        $this->title = $post->title;
        $this->description= $post->description;
        $this->role= $post->role;
        $this->showViewModal = true;
    }

    public function index()
    {
        $postNotifications = auth()->user()->unreadNotifications;
        return view('livewire.admin.notifications.view', compact('postNotifications'));
    }


    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
                ->when($request->input('id'), function($query) use ($request){
                    return $query->where('id', $request->input('id'));
                })->markAsRead();
        return response()->noContent();
    }

    //Eliminar un post
    public function deletePost($id, $title)
    {
        $this->posts = Post::findOrFail($id);
        $this->title = $title;
        $this->confirmingPartDeletion = true;
    }

    public function delete()
    {
        $this->posts->delete();
        // Notification::where('data[1]', '=', $title)->each->delete();
        $this->confirmingPartDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Mensaje eliminado exitosamente',
        ]);
        $this->resetInputFields();
    }

    public function confirmation(){
        $this->confirmingSaveNotificacion=true;
    }

    public function store()
    {
        $this->validateInputs();
        $this->arr['user_id']=Auth::id();
        $post=Post::create($this->arr);
        event(new PostEvent($post));

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Mensaje Enviado exitosamente' : 'Mensaje Enviado exitosamente',
        ]);

        $this->edit = false;
        $this->create = false;
        $this->closeModal();
        $this->resetInputFields();
    }

    //eliminar todas las notificaciones enviadas
    public function deleteNoti()
    {
        $this->confirminNotificacion= true;
    }

    public function deleteNotifications(){
        Notification::all()->each->delete();
        Post::all()->each->delete();
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Notificaciones eliminadas exitosamente!!!',
        ]);
        $this->confirminNotificacion= false;
    }

    public function deletetodasnoti(){
        // $this->deletetodasnotifi=true;
        auth()->user()->Notifications->each->delete();
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Notificaciones eliminadas exitosamente!!!',
        ]);
    }

    // public function deleteNotificationsleidas(){
    //     auth()->user()->Notifications->each->delete();
    //     $this->deletetodasnotifi= false;
    // }

    public function markAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Notificaciones marcada como leídas',
        ]);
    }

    public function markoneAsRead($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Notificación marcada como leída',
        ]);
    }

    public function deletfullnotifyread(){
        auth()->user()->readNotifications->each->delete();
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Notificación leíadas eliminadas exitosamente...',
        ]);
    }
}

