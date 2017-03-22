<?php

namespace App\Observers;

use App\User;
use App\Mail\MemberWelcome;
use Illuminate\Support\Facades\Mail;

class EmailObserver
{
    /**
     * @param User $user
     */
    public function saved(User $user)
    {
        if($user->isDirty('approved_at') && $user->approved_at != null)
        {
            $password = uniqid('airstream');

            $user->update(['password' => bcrypt($password)]);

            Mail::to($user)->send(new MemberWelcome($user, $password));
        }
    }
}