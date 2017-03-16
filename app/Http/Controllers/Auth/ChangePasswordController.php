<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth()
    {
        $this->validate(request(), [
            'password' => 'required|confirmed'
        ]);

        auth()->user()->update([
            'password' => bcrypt(request('password'))
        ]);

        return redirect()->route('settings.index')->with('message', 'Password Updated');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nas()
    {
        $this->validate(request(), [
            'nas_password' => 'required|confirmed'
        ]);

        auth()->user()->update([
            'nas_password' => bcrypt(request('nas_password'))
        ]);

        return redirect()->route('settings.index')->with('message', 'NAS Password Updated');
    }
}