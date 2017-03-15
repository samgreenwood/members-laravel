<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;

class NoteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Note::class);

        $member = User::find(request('member'));

        return view('notes.create', compact('member'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->authorize('create', Note::class);

        $this->validate(request(), [
            'note' => 'required'
        ]);

        $member = User::find(request('member'));

        Note::create([
            'note' => request('note'),
            'recorded_by' => auth()->user()->id,
            'user_id' => $member->id
        ]);

        return redirect()->route('members.edit', $member->id)->with('message', 'Note Recorded');
    }
}
