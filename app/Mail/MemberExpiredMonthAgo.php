<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberExpiredMonthAgo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $monthsAgo;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user, int $monthsAgo)
    {
        $this->user = $user;
        $this->monthsAgo = $monthsAgo;
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
            ->subject('Your Air-Stream Membership has expired.')
            ->markdown('emails.members.expired_' . $this->monthsAgo . '_month', [
                'user' => $this->user
            ]);
    }
}
