<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\MemberApproved;

class MembershipApplicationController extends Controller
{
    /**
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        if ($user->approved_at) {
            return redirect()->route('members.edit', $user->id)->with('message', 'Member already approved');
        }

        return view('members.application', compact('user'));
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user)
    {
        $user->update(['approved_at' => date('Y-m-d h:i:s')]);

        Mail::to($user->email)->cc('committee@air-stream.org')->send(new MemberApproved($user));

        return redirect()->route('members.edit', $user->id)->with('message', 'Membership Approved');
    }
}
