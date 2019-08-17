<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\PaymentRecipient;
use App\Payment;
use App\PaymentType;
use Auth;
class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user();
        $all_payment_recipients = PaymentRecipient::orderBy('id', 'DESC')->get();
        $payment_recipients = array();
        if($user->role == 1)
        {
            for ($i=0;$i<count($all_payment_recipients);$i++) 
            {
                if($all_payment_recipients[$i]->payment->user_id == $user->id)
                {
                    $payment_recipients[$i] = $all_payment_recipients[$i];
                }
            }
        }else{
            $payment_recipients = $all_payment_recipients;
        }
        

        $totalAmount = 0;
        foreach ($payment_recipients as $payment_recipient) 
        {
            $totalAmount+=$payment_recipient->amount;
        }
        return view('vouchers/payments/index')->with(
        ['payment_recipients'=>$payment_recipients,'totalAmount'=>$totalAmount]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_types = PaymentType::all();
        return view('vouchers/payments/create')->with(['payment_types'=> $payment_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $paymentDates = $request->payment_dates;
        $amounts = $request->amounts;
        $currencies = $request->currencies;
        $payment_type_ids = $request->payment_type_ids;
        $discriptions = $request->discriptions;
        $recipient_names = $request->recipient_names;
        

        $validattion = $request->validate([
            'amounts.*' =>'required',
            'recipient_names.*' =>'required',
            'payment_dates.*' =>'required',
            'currencies.*' =>'required',
            'discription.*' =>'required',
            'payment_type_ids.*' =>'required',
            'discriptions.*' =>'required',
        ]);
        
        
        $payment = new Payment(['user_id'=>$user->id]);
        $payment->save();

        $count = count($amounts);
        $payment_id = $payment->id;
        for($i = 0;$i<$count;$i++)
        {
            $paymentRecipient = new PaymentRecipient([
                'payment_id'=>$payment_id,
                'payment_date'=>$paymentDates[$i],
                'amount'=>$amounts[$i],
                'currency'=>$currencies[$i],
                'recipient_name'=>$recipient_names[$i],
                'discription'=>$discriptions[$i],
                'payment_type_id'=>$payment_type_ids[$i]
            ]);
            $paymentRecipient->save();
            $paymentTypeAvlAmount = $paymentRecipient->payment_type->avl_amount;
            PaymentType::where('id',$paymentRecipient->payment_type->id)->update(['avl_amount'=>$paymentTypeAvlAmount - $paymentRecipient->amount]);
        }
        return redirect('/payments')->with('success','تم انشاء سند الصرف بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentRecipientsToShow = PaymentRecipient::where('payment_id',$id)->get();
        $totalPaymentsToShow  = 0;
        foreach ($paymentRecipientsToShow as $paymentRecipientToShow) 
        {
            $totalPaymentsToShow+= $paymentRecipientToShow->amount;
        }
        return view('vouchers/payments/show')->with(['paymentRecipients' =>$paymentRecipientsToShow
        , 'totalPayments'=>$totalPaymentsToShow]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentRecipientToEdit = PaymentRecipient::where('id',$id)->get();
        return  view('vouchers/payments/edit')->with(['paymentRecipient' =>$paymentRecipientToEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentRecipientToDelete = PaymentRecipient::find($id);
        $paymentRecipientToDelete->delete();
        $paymentTypeAvlAmount = $paymentRecipientToDelete->payment_type->avl_amount;
        PaymentType::where('id',$paymentRecipientToDelete->payment_type->id)->update(['avl_amount'=>$paymentTypeAvlAmount - $paymentRecipientToDelete->amount]);
        return redirect('/payments')->with('success','تم حذف سند الصرف بنجاح');
    }
}
