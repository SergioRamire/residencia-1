<?php

namespace App\Listeners;

use App\Models\User;
use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostNotification;

// class PostListener implements ShouldQueue
class PostListener
{
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $this->user = User::all()
        if($event->post->role == 'Participante')
            // $this->user=User::whereRelation('roles', 'name', '=', 'Participante')->get()
            $this->user=User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->where('inscriptions.estatus_participante','=','Participante')->get()
            ->except($event->post->user_id)
            ->each(function($user) use ($event){
                Notification::send($user, new PostNotification($event->post));
            });
        elseif($event->post->role == 'Instructor')
            // $this->user=User::whereRelation('roles', 'name', '=', 'Instructor')->get()
            $this->user=User::join('inscriptions', 'inscriptions.user_id', '=', 'users.id')
            ->where('inscriptions.estatus_participante','=','Instructor')->get()
            ->except($event->post->user_id)
            ->each(function($user) use ($event){
                Notification::send($user, new PostNotification($event->post));
            });
        elseif($event->post->role == 'Todos')
            $this->user = User::all()
            ->except($event->post->user_id)
            ->each(function($user) use ($event){
                Notification::send($user, new PostNotification($event->post));
            });
    }
}
