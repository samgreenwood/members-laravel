<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = [
            'forward_email' => auth()->user()->forward_email,
        ];

        return view('settings.index', compact('settings'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        auth()->user()->update([
            'forward_email' => request('forward_email', false),
        ]);

        return redirect()->route('settings.index')->with('message', 'Settings Updated.');
    }
}
