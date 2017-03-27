<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Payment;
use App\User;
use Braintree_Transaction;
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
        $result = Braintree_Transaction::sale([
            'amount' => config('membership.rate'),
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($result->success)
        {
            $user = User::findByApprovalToken($request->input('approval_token'));

            $user->renewMembership($result->transaction->amount, $result->transaction->id);

            auth()->login($user);

            return redirect()->route('dashboard')->with('message', 'Payment successful, welcome!');
        }

        return redirect()->back()->with('error', $result->transaction->status);


    }
}