<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberExpiresInOneMonth extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->cc($this->user->username. '@air-stream.org')
            ->cc('committee@air-stream.org')
            ->subject('Your Air-Stream Membership expires soon.')
            ->markdown('emails.members.expiring_one_month', [
                'user' => $this->user
            ]);
    }
}
