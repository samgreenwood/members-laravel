<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Payment;
use App\User;
use Carbon\Carbon;

class MembershipController extends Controller
{
    public function create()
    {
        $this->authorize('create', Membership::class);

        $member = User::find(request('member'));

        $form = [
            'payment' => ['amount' => $member->isExpired() ? 50 : 45]
        ];

        return view('memberships.create', compact('member', 'form'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->authorize('create', Membership::class);

        $this->validate(request(),[
            'payment.reference' => 'required',
            'payment.type' => 'required',
            'payment.date' => 'required|date',
            'membership.start' => 'required|date',
        ]);

        $member = User::find(request('member'));

        $payment = Payment::create(array_merge(
            request('payment'),
            ['user_id' => $member->id]
        ));

        $start = Carbon::createFromFormat('Y-m-d', request('membership.start'));
        $end = $start->copy()->addYear();

        Membership::create([
            'start' => $start,
            'end' => $end,
            'payment_id' => $payment->id,
            'user_id' => $member->id,
        ]);

        return redirect()->route('members.edit', $member->id)->with('message', 'Membership Renewed');
    }
}