<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->load('groups');

    return $user;
});

Route::middleware('auth.api')->get('/members', function() {
    return \App\User::all()->mapWithKeys(function(\App\User $user) {
        return [
            $user->id => [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'surname' => $user->surname,
                'nickname' => $user->username
            ]
        ];
    });
});
