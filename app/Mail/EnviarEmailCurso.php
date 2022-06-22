<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class EnviarEmailCurso extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Inscripcion al curso de Capacitación docente';
    public $info=[];
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($arreglo, User $user)
    {
        $this->info = $arreglo;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('livewire.admin.emailss.email');
    }
}
