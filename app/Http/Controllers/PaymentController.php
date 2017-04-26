<?php

namespace App\Http\Controllers;

use App\Payment;

class PaymentController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $this->authorize('index', Payment::class);

        $payments = Payment::with('member')->get();

        return view('payments.index', compact('payments'));
    }
}
