<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentType;
class PaymentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' =>'required',
            'avl_amount' =>'required',
        ]);
        
        if($validattion)
        {
            $paymentType = new PaymentType
            (['name'=>$request->name,'avl_amount' =>$request->avl_amount,]);
            $paymentType->save();
            return redirect('/admin')->with('success','تم اضافة الحساب بنجاح');
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
        //
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
        $paymenTypeToDelete = PaymentType::find($id);
        $paymenTypeToDelete->delete();
        return redirect('/admin')->with('success','تم حذف الحساب بنجاح');
    }
}
