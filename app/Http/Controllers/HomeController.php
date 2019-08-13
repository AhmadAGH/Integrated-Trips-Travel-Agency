<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\PaymentRecipient;
use App\Receipt;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $clients = Client::all();
        $receipts = Receipt::all();
        $paymentRecipients = PaymentRecipient::all();

        $totalPayments = 0;
        foreach ($paymentRecipients as $paymentRecipient)
        {
            $totalPayments+= $paymentRecipient->amount;
        }
        return view('home')->with( ['totalPayments'=>$totalPayments]);
    }
}
