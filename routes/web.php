<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['name' => 'committee'], function() {
    Route::resource('groups', 'GroupController');
    Route::resource('members', 'MemberController');
    Route::resource('memberships', 'MembershipController');
    Route::resource('notes', 'NoteController');
});

Route::post('/password/auth', ['as' => 'password.update.auth', 'uses' => 'Auth\ChangePasswordController@auth']);
Route::post('/password/nas', ['as' => 'password.update.nas', 'uses' => 'Auth\ChangePasswordController@nas']);
Route::resource('settings', 'SettingsController');
Route::resource('profile', 'ProfileController');
