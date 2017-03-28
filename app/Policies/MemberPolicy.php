<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the list of members.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->isCommittee();
    }

    /**
     * Determine whether the user can view the member.
     *
     * @param \App\User $user
     * @param \App\User $member
     *
     * @return mixed
     */
    public function view(User $user, User $member)
    {
        return $user->isCommittee() || $user->id == $member->id;
    }

    /**
     * Determine whether the user can create members.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isCommittee();
    }

    /**
     * Determine whether the user can update the member.
     *
     * @param \App\User $user
     * @param \App\User $member
     *
     * @return mixed
     */
    public function update(User $user, User $member)
    {
        return $user->isCommittee() || $user->id == $member->id;
    }

    /**
     * Determine whether the user can delete the member.
     *
     * @param \App\User $user
     * @param \App\User $member
     *
     * @return mixed
     */
    public function delete(User $user, User $member)
    {
        return $user->isCommittee();
    }
}
