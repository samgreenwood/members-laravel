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

        ]);

        auth()->user()->update(request('member'));

        return redirect()->route('profile.index')->with('message', 'Profile Updated');
    }
}