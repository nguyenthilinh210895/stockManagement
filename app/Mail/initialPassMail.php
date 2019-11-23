<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class initialPassMail extends Mailable
{
    use Queueable, SerializesModels;
   protected $password_random;
   public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$password_random)
    {
        $this->user = $user;
        $this->password_random = $password_random;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('home');
        return $this
            ->subject('Stocke-Management sendmail')
            ->markdown('content.sendMail.initialPassword')
            ->with(['user'=>$this->user,'url'=>$url,'password_random'=>$this->password_random]);
    }
}
