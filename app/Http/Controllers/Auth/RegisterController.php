<?php

namespace App\Http\Controllers\Auth;

use App\Mail\CommitteeOnlineSignUp;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/thankyou-for-registering';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'member.username' => 'required|unique:users,username',
            'member.password' => 'required|confirmed',
            'member.firstname' => 'required',
            'member.surname' => 'required',
            'member.birthday' => 'required|date',
            'member.wia_member' => 'required',
            'member.affiliated_club' => 'required',
            'member.email' => 'required|unique:users,email',
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
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->input('member'))));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        unset($data['approved_at']);
        unset($data['password_confirmation']);

        $data['approval_token'] = sha1(uniqid('approval'));

        return User::create($data);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param mixed   $user
     *
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Mail::to('committee@air-stream.org')->send(new CommitteeOnlineSignUp($user));

        return redirect($this->redirectPath());
    }
}
