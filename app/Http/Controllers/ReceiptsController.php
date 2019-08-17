<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Receipt;
use App\PaymentType;
use Auth;
class ReceiptsController extends Controller
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
        if($user->role == 0)
        {
            $receipts = Receipt::orderBy('id', 'DESC')->get();
        }else {
            
            $receipts = Receipt::orderBy('id', 'DESC')->where('user_id',$user->id)->get();
        }
        
        $totalAmount = 0;
        $totalRemainder = 0;
        foreach ($receipts as $receipt) 
        {
            $totalAmount+=$receipt->amount;
            $totalRemainder += $receipt->remainder;
        }

        return view('vouchers/receipts/index')->with(
            ['user'=>$user,'receipts'=>$receipts,'totalAmount'=>$totalAmount,'totalRemainder'=>$totalRemainder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $clients = Client::all();
        $payment_types = PaymentType::all();
        return view('vouchers/receipts/create')->with(['users' => $users ,'clients' =>$clients,'payment_types'=> $payment_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validattion = $request->validate([
            'amount' =>'required',
            'remainder' =>'required',
            'client_id' =>'required',
            'currency' =>'required',
            'discription' =>'required',
            'payment_type_id' =>'required',
            'receipt_date' =>'required',
        ]);
        
        if($validattion)
        {
            $receipt = new Receipt(['amount'=>$request->amount,
            'remainder' =>$request->remainder,
            'client_id' =>$request->client_id,
            'currency' => $request->currency,
            'discription' =>$request->discription,
            'payment_type_id' =>$request->payment_type_id,
            'receipt_date' =>$request->receipt_date,
            'user_id' =>Auth::user()->id]);
            $receipt->save();
            $paymentTypeAvlAmount = $receipt->payment_type->avl_amount;
            PaymentType::where('id',$receipt->payment_type->id)->update(['avl_amount'=>$paymentTypeAvlAmount + $receipt->amount]);
            return redirect('/receipts')->with('success','تم انشاء سند القبض بنجاح');
        }            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receiptToShow = Receipt::find($id);
        return view('vouchers/receipts/show')->with(['receipt' =>$receiptToShow]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $receiptToDelete = Receipt::find($id);
        $receiptToDelete->delete();
        return redirect('/receipts')->with('success','تم حذف سند القبض بنجاح');
    }
}
