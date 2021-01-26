<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $name,$user,$id;
    public function __construct($id,$name,$user)
    {
        $this->id =$id;
        $this->name =$name;
        $this->user =$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Người dùng mới')
        ->view('mail.notification')->with([
            'name' =>$this->name,
            'id' =>$this->id,
            'user' =>$this->user,

        ]);
    }
}
