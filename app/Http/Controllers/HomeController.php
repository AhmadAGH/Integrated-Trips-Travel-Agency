<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\PaymentRecipient;
use App\Receipt;
use App\PaymentType;
use Auth;
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
        if(Auth::user()->role == 1)
        {
            
            return redirect()->action('ReceiptsController@index');
        }

        $users = User::all();
        $clients = Client::all();
        $receipts = Receipt::all();
        $paymentRecipients = PaymentRecipient::all();
        $paymentTypes = PaymentType::all();

        $totalPaymentsAmount = 0;
        $totalReceiptsAmount = 0;
        $totalReceiptsReminder = 0;
        foreach ($paymentRecipients as $paymentRecipient)
        {
            $totalPaymentsAmount+= $paymentRecipient->amount;
        }
        foreach ($receipts as $receipt)
        {
            $totalReceiptsAmount+= $receipt->amount;
            $totalReceiptsReminder+= $receipt->remainder;
        }
        return view('home')->with( 
            ['totalPaymentsAmount'=>$totalPaymentsAmount
            ,'totalReceiptsAmount'=>$totalReceiptsAmount
            ,'totlaReceiptsReminder'=> $totalReceiptsReminder
            ,'paymentTypes'=> $paymentTypes]);
    }
}
