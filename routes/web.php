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

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

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

    Route::get('/members/{user}/application', ['as' => 'membership.application', 'uses' => 'MembershipApplicationController@show']);
    Route::post('/members/{user}/application', ['as' => 'membership.application.approve', 'uses' => 'MembershipApplicationController@update']);

    Route::get('/renew-membership', ['as' => 'membership.renew.index', 'uses' => 'RenewMembershipController@index']);
    Route::post('/renew-membership', ['as' => 'membership.renew.store', 'uses' => 'RenewMembershipController@store']);
});

Route::get('/membership-payment/{approval_token}', ['as' => 'membership.application.payment', 'uses' => 'MembershipApplicationPaymentController@index']);
Route::get('/thankyou-for-registering', ['as' => 'registration.thankyou', 'uses' => 'ThankyouForRegistering@index']);

