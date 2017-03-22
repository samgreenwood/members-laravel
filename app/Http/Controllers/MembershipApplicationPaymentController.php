<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembershipApplicationPaymentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = User::findByApprovalToken($request->input('approval_token'));

        return view('memberships.payment', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::findByApprovalToken($request->input('approval_token'));

        $payment = Payment::create([
            'user_id' => $user->id,
            'type' => 'Credit Card',
            'amount' => $request->amount,
            'reference' => $request->reference,
            'date' => Carbon::now(),
        ]);

        Membership::create([
            'user_id' => $user->id,
            'payment_id' => $payment->id,
            'start' => Carbon::now(),
            'end' => Carbon::now()->addYear()
        ]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('message', 'Payment successful, welcome!');
    }
}