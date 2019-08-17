@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-4"> </h1>
        <h1 class="display-4">
            سندات الصرف
            <a href="/payments/create"><img src="{{asset("storage\img\plus.png")}}" width="50"></a>
        </h1>
        <div class="row">
            <div class="col">
                <h3>المصروف: {{$totalAmount}} ريال</h3>
            </div>
        </div>
    </div>
    @if(count($payment_recipients)>0)
        @foreach($payment_recipients as $payment_recipient)
            <div class="card text-center">
                    <div class="card-header">
                        سند رقم: {{$payment_recipient->payment->id}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">المصروف: {{$payment_recipient->amount ." ". $payment_recipient->currency}}</h5>
                        <p class="card-text">
                            <div class="row justify-content-md-center">
                                <div class="col-sm-auto">
                                    مزود الخدمة: {{$payment_recipient->recipient_name}}
                                </div>
                            </div>
                            {{$payment_recipient->discription}}
                            <br>
                            {{$payment_recipient->payment->user->name}}
                            <br>
                            {{"طريقة الدفع: ".$payment_recipient->payment_type->name}}
                        </p>
                        <div class="row justify-content-md-center">
                            @if (Auth::user()->role == 0)
                                <div class="col-sm-auto">
                                    <form action="{{url('payments',$payment_recipient->payment->id)}}" onsubmit="return deleteConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("DELETE")}}
                                        <input type="image" src="{{asset("storage\img\x.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                                {{-- <div class="col-sm-auto">
                                    <a href="{{url('payments/edit',$payment_recipient->id)}}"><img src="{{asset("storage\img\pencil.png")}}" width="30"></a>
                                </div> --}}
                            @endif
                            <div class="col-sm-auto">
                                <a href="{{url('payments',$payment_recipient->payment->id)}}"><img src="{{asset("storage\img\printer.png")}}" width="30"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center">
                    {{$payment_recipient->payment_date}}
                </div>
            </div>

        @endforeach
    @else
        <h3 class="text-center">لا توجد سندات صرف</h3>
    @endif
    <script type="text/javascript">
        function deleteConf()
        {
           return confirm("هل تريد حذف هذا السند؟")
        }
    </script>
@endSection
