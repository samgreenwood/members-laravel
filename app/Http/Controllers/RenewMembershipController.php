<?php

namespace App\Http\Controllers;

use Braintree_Transaction;
use Illuminate\Http\Request;

class RenewMembershipController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $clientToken = \Braintree_ClientToken::generate();

        return view('memberships.renew', compact('user', 'startDate', 'clientToken'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_method_nonce' => 'required',
        ]);

        $result = Braintree_Transaction::sale([
            'amount' => $request->user()->renewal_amount,
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            auth()->user()->renewMembership($result->transaction->amount, $result->transaction->id);

            return redirect()->route('dashboard')->with('message', 'Payment successful, thankyou for renewing!');
        }

        return redirect()->back()->with('error', $result->transaction->status);
    }
}
