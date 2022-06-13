<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = '';
    public $info=[];
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, User $user)
    {
        $this->info = $correo->description;
        $this->user = $user;
        $this->subject=$correo->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.orders.shipped');
        return $this->markdown('livewire.admin.emailss.sendemail');
    }
}
