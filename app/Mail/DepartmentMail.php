<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepartmentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $application, $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $application, $url)
    {
        $this->user = $user;
        $this->url = $url;
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails/department');
    }
}
