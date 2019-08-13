@extends('layouts.app')
@section('style')
<style>
    td {
        border-bottom: 1px solid #ddd;
        margin: 5px;
    }
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
@endsection
@section('content')
    <div class="container" style="padding:10px;">
        <div style="padding-top: 50px;padding-bottom: 10px;">
            <table style="text-align: center;  border: inset">
                <tbody >
                    <tr>
                        
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row border border-dark" >
            <div class="column"> 
                <img style="width: 180px; padding: 10px; padding-right:50px;" src="{{asset("storage\img\Itrips_Logo.png")}}">
            </div>
        </div>
        <div style=" padding-top: 30px; padding-bottom: 30px;">
            <table cellspacing="0" style="float: right; text-align: right;">
                <thead style="background-color: #eeeeee; border: inset;">
                    <tr>
                        <th style="border: inset;" width="100px">رقم السند</th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td style="border: inset; text-align: center;">
                            <h3>{{$paymentRecipients[0]->payment->id}}</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <br>
        
        <div>
            <table cellspacing="0" style="float: right; text-align: right">
                <thead style="background-color: #eeeeee; border: none;  ">
                    <tr>
                        <th style="border: inset;" width="120px" height="35px" style="margin: 5px">رقم</th>
                        <th style="border: inset;" width="120px">التاريخ</th>
                        <th style="border: inset;" width="220px">مزود الخدمة</th>
                        <th style="border: inset;" width="220px">البيان</th>
                        <th style="border: inset;" width="118px">طريقة الدفع</th>
                        <th style="border: inset;" width="118px">المبلغ</th>
                        <th style="border: inset;" width="118px">العملة</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($paymentRecipients as $paymentRecipient)
                        <tr>
                            <td style="border: inset;">{{$paymentRecipient->id}}</td>
                            <td style="border: inset;">{{$paymentRecipient->payment_date}}</td>
                            <td style="border: inset;">{{$paymentRecipient->recipient_name}}</td>
                            <td style="border: inset;">{{$paymentRecipient->discription}}</td>
                            <td style="border: inset;">{{$paymentRecipient->paymentType}}</td>
                            <td style="border: inset;">{{$paymentRecipient->amount}}</td>
                            <td style="border: inset;">{{$paymentRecipient->currency}}</td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
            <br><br>
            <div style=" padding-top: 100px;">
                <h4 align="right">الموظف: {{Auth::user()->name}}</h4>
                <h4 align="right">التوقيع: ..........................</h4>
            </div>

            <button class="btn-success no-print" onclick="window.print()">طباعة</button>
        </div>
    </div>
@endsection