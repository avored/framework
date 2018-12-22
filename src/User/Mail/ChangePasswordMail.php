<?php

namespace AvoRed\Framework\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User Model Object whose password has change.
     *
     * @param \Avored\Framework\Models\Database\User $user
     */
    public $user;

    /**
     * User New Password
     *
     * @param string $password
     */
    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('avored-framework::user.mail.change-password');
    }
}
