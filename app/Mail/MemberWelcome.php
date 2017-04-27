<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberWelcome extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $temporaryPassword;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param string $temporaryPassword
     */
    public function __construct(User $user, string $temporaryPassword)
    {
        $this->user = $user;
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Welcome to Air-Stream Wireless')
            ->cc('committee@air-stream.org')
            ->markdown('emails.members.welcome', [
            'user' => $this->user,
            'temporaryPassword' => $this->temporaryPassword,
        ]);
    }
}
