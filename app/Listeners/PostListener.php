<?php

namespace App\Listeners;

use App\Models\User;
use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostNotification;
use Illuminate\Database\Eloquent\Builder;

// class PostListener implements ShouldQueue
class PostListener
{
    // public $user1;
    // public $user2;
    // public $user3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->post->role == 'Participante' || $event->post->role == 'Instructor')
            $this->user = User::where('users.estado', '=', '1')
                ->whereRelation('roles', 'name', '=', $event->post->role)->get()
                ->except($event->post->user_id)
                ->each(function ($user) use ($event) {
                    Notification::send($user, new PostNotification($event->post));
                });
        // elseif($event->post->role == 'Instructor')
        //     $this->user=User::where('users.estado','=','1')
        //     ->whereRelation('roles', 'name', '=', 'Instructor')->get()
        //     ->except($event->post->user_id)
        //     ->each(function($user) use ($event){
        //         Notification::send($user, new PostNotification($event->post));
        //     });
        // elseif($event->post->role == 'Todos')
        //     $this->user=User::where('users.estado','=','1')
        //     ->whereRelation('roles', 'name', '=', 'Instructor')
        //     ->whereRelation('roles', 'name', '=', 'Participante')->get()
        //     ->except($event->post->user_id)
        //     // ->except('roles', 'name', '=', 'Coordinador')
        //     ->each(function($user) use ($event){
        //         Notification::send($user, new PostNotification($event->post));
        //     });
        elseif ($event->post->role == 'Todos')
            /*$this->user = User::join('model_has_roles','model_has_roles.model_id','=','users.id')
            ->join('roles', 'roles.id','=','model_has_roles.role_id')
            ->where('roles.name', '=','Instructor')
            ->where('roles.name', '=','Participante')->get()*/
            $this->user = User::where('users.estado', '=', '1')
                ->whereHas('roles', function ($query) {
                    $query->where('name', '=', 'Instructor')->orWhere('name', '=', 'Participante');
                })->get()
                ->except($event->post->user_id)
                // ->except('roles', 'name', '=', 'Coordinador')
                ->each(function ($user) use ($event) {
                    Notification::send($user, new PostNotification($event->post));
                });
    }
}
