<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;

class GroupController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('username', 'id');

        return view('groups.create', compact('users'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $group = Group::create(request()->only('name'));

        $group->users()->sync(request('users', []));

        return redirect()->route('groups.index')->with('message', 'Group Created');
    }

    /**
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Group $group)
    {
        $users = User::pluck('username', 'id');

        $selected = $group->users()->pluck('user_id');

        return view('groups.edit', compact('group', 'users', 'selected'));
    }

    /**
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Group $group)
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

       $group->update(request()->only('name'));

       $group->users()->sync(request('users', []));

        return redirect()->route('groups.index')->with('message', 'Group Updated');
    }

    /**
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }

}
