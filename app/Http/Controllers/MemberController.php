<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Payment;
use App\User;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {
        $this->authorize('index', User::class);

        $members = User::all();

        return view('members.index', compact('members'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('members.create');
    }

    public function store()
    {
        $this->authorize('create', User::class);

        $this->validate(request(), [
            'member.firstname' => 'required',
            'member.surname' => 'required',
            'member.username' => 'required|unique:users,username',
            'member.email' => 'required|unique:users,email',
            'member.birthday' => 'required|date',
            'member.wia_member' => 'required',
            'member.affiliated_club' => 'required',
            'member.forward_email' => 'required',
            'member.occupation' => 'required',
            'member.postal_address_1' => 'required',
            'member.postal_address_state' => 'required',
            'member.postal_address_suburb' => 'required',
            'member.postal_address_postcode' => 'required',
            'member.postal_address_country' => 'required',
            'member.billing_address_1' => 'required',
            'member.billing_address_state' => 'required',
            'member.billing_address_suburb' => 'required',
            'member.billing_address_postcode' => 'required',
            'member.billing_address_country' => 'required',
            'payment.type' => 'required',
            'payment.amount' => 'required',
            'payment.reference' => 'required',
            'payment.date' => 'required|date',
            'membership.start' => 'required|date',
            'membership.duration' => 'required'
        ]);

        $member = User::create(array_merge(
            request('member'),
            ['password' => md5(uniqid('as'))]
        ));

        $payment = Payment::create(array_merge(
            request('payment'),
            ['user_id' => $member->id]
        ));

        $start = Carbon::createFromFormat('Y-m-d',request('membership.start'));
        $end = $start->copy()->addYear();

        Membership::create([
            'start' => $start,
            'end' => $end,
            'payment_id' => $payment->id
        ]);

        return redirect()->route('members.index')->with('message', 'Member Registered');
    }

    public function edit(User $member)
    {
        $this->authorize('update', $member);

        return view('members.edit', compact('member'));
    }

    /**
     * @param User $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $member)
    {
        $this->authorize('update', $member);

        $this->validate(request(), [
            'member.firstname' => 'required',
            'member.surname' => 'required',
            'member.username' => 'required',
            'member.email' => 'required',
            'member.birthday' => 'required|date',
            'member.wia_member' => 'required',
            'member.affiliated_club' => 'required',
            'member.occupation' => 'required',
            'member.postal_address_1' => 'required',
            'member.postal_address_state' => 'required',
            'member.postal_address_suburb' => 'required',
            'member.postal_address_postcode' => 'required',
            'member.postal_address_country' => 'required',
            'member.billing_address_1' => 'required',
            'member.billing_address_state' => 'required',
            'member.billing_address_suburb' => 'required',
            'member.billing_address_postcode' => 'required',
            'member.billing_address_country' => 'required',
        ]);

        $member->update(request('member'));

        return redirect()->route('members.index')->with('message', 'Member Details Updated');
    }
}