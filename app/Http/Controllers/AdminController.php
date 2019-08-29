<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentType;
use App\User;
class AdminController extends Controller
{
    public function index()
    {
        $payment_types = PaymentType::all();
        $users = User::all();
        return view("admin")->with(["paymentTypes"=>$payment_types,'users'=>$users]);
    }
}
