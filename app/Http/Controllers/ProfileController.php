<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $member = auth()->user();

        return view('profile.index', compact('member'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'member.firstname' => 'required',
            'member.surname' => 'required',
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

        auth()->user()->update(request('member'));

        return redirect()->route('profile.index')->with('message', 'Profile Updated');
    }
}
