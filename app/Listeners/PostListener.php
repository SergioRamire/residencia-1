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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $this->user = User::all()

        if($event->post->role == 'Participante')
            $this->user=User::join('inscriptions as in', 'in.user_id', '=', 'users.id')
            ->join('course_details','course_details.id', '=', 'in.course_detail_id')
            ->join('periods','periods.id', '=','course_details.period_id' )
            ->select('users.id')
            ->where('in.estatus_participante','=','Participante')
            ->where('periods.fecha_inicio', '<', $event->post->created_at->format('Y-m-d'))
            ->where('periods.fecha_fin', '>', $event->post->created_at->format('Y-m-d'))->get()
            ->except($event->post->user_id)
            ->each(function($user) use ($event){
                Notification::send($user, new PostNotification($event->post));
            });
        elseif($event->post->role == 'Instructor')
            $this->user=User::join('inscriptions as in', 'in.user_id', '=', 'users.id')
            ->join('course_details','course_details.id', '=', 'in.course_detail_id')
            ->join('periods','periods.id', '=','course_details.period_id' )
            ->select('users.id')
            ->where('in.estatus_participante','=','Instructor')
            ->where('periods.fecha_inicio', '<', $event->post->created_at->format('Y-m-d'))
            ->where('periods.fecha_fin', '>', $event->post->created_at->format('Y-m-d'))->get()
            ->except($event->post->user_id)
            ->each(function($user) use ($event){
                Notification::send($user, new PostNotification($event->post));
            });
        elseif($event->post->role == 'Todos')
            $this->user=User::join('inscriptions as in', 'in.user_id', '=', 'users.id')
            ->join('course_details','course_details.id', '=', 'in.course_detail_id')
            ->join('periods','periods.id', '=','course_details.period_id' )
            ->select('users.id')
            ->where('periods.fecha_inicio', '<', $event->post->created_at->format('Y-m-d'))
            ->where('periods.fecha_fin', '>', $event->post->created_at->format('Y-m-d'))->get()
            ->except($event->post->user_id)
            ->each(function($user) use ($event){
                Notification::send($user, new PostNotification($event->post));
            });
    }
}
