<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine weather the user can list the payments
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->isCommittee();
    }
}
