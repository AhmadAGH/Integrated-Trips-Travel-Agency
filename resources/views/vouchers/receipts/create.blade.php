@extends('layouts.app')

@section('content')
<div class="container">
    <form name="form1" action="{{url('/clients')}}" method="POST">
        {{ csrf_field() }}
        <div class="input-group mb-4">
            <div class="input-group-postpend">
                <span class="input-group-text">اسم العميل الجديد</span>
                <input required type="text"  name="name" class="form-control ">
            </div>
            <div class="input-group-postpend">
                <span class="input-group-text">رقم الجوال</span>
                <input type="text" value="05xxxxxxxx" name="phone_number" class="form-control">
            </div>
            <button type="submit" name="form1" class="btn btn-success">اضافة</button>
        </div>
    </form>
    <form name="form2" action="{{ action('ReceiptsController@store') }}" method="POST" >
        {{csrf_field()}}
            <div class="input-group mb-4">
                <div class="input-group-postpend">
                    <span class="input-group-text">اختر العميل</span>
                    <select name="client_id" class="custom-select">
                        @if(count($clients)>0)
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->id}}- {{$client->name}}</option>
                            @endforeach
                        @else
                            <option value="-1">خطأ, لا يوجد عملاء</option>
                        @endIf
                    </select>
                </div>
            </div>   

            <div class="input-group mb-4">
                <div class="input-group-postpend">
                    <span class="input-group-text">المبلغ المدفوع</span>
                    <input required type="number"  value="0.00" step="0.01" name="amount" class="form-control ">
                </div>
                <div class="input-group-postpend">
                    <span class="input-group-text">المبلغ المتبقي</span>
                    <input type="number" value="0.00" step="0.01" name="remainder" class="form-control">
                </div>
                <div class="input-group-postpend">
                    <span class="input-group-text">العملة</span>
                    <input type="text" readonly="true" value="ريال سعودي" name="currency" class="form-control">
                </div>
            </div>
            
            <div class="input-group mb-4">
                    <div class="input-group-postpend">
                        <span class="input-group-text">البيان</span>
                        <textarea name="discription"  rows="1" class="form-control"></textarea>
                    </div>
                    <div class="input-group-postpend">
                        <span class="input-group-text">طريقة الدفع</span>
                        <input type="text" name="payment_type" class="form-control">
                    </div>
                </div>
            
            <div class="input-group mb-4">
                    <div class="input-group-postpend">
                        <span class="input-group-text">تاريخ القبض</span>
                        <input type="date" value="{{date("Y-m-d")}}" name="receipt_date" class="form-control">
                    </div>
                </div> 

            <button type="submit" name="form2" class="btn btn-success">حفظ</button>
        </div>
    </form>
@endSection
