@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <h1 class="display-4"> </h1>
        <h1 class="display-4">
            سندات القبض
            <a href="/receipts/create"><img src="{{asset("storage\img\plus.png")}}" width="50"></a>
        </h1>
        
        <div class="row">
            <div class="col">
                    <h3>المقبوض: {{$totalAmount}} ريال</h3>
            </div>
            <div class="col">
            <h3>الغير مقبوض: {{$totalRemainder}} ريال</h3>
            </div>
        </div>
    </div>
    @if(count($receipts)>0)
        @foreach($receipts as $receipt)
            <div class="card text-center">
                    <div class="card-header">
                        سند رقم: {{$receipt->id}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">العميل: {{$receipt->client->name}}</h5>
                        <p class="card-text">
                            <div class="row justify-content-md-center">
                                <div class="col-sm-auto">
                                    المقبوض: {{$receipt->amount}}
                                </div>
                                <div class="col-sm-auto">
                                    الغير مقبوض: {{$receipt->remainder}}
                                </div>
                            </div>
                            {{$receipt->discription}}
                            <br>
                            {{$receipt->user->name}}
                        </p>
                        <div class="row justify-content-md-center">
                            @if (Auth::user()->role == 0)
                                <div class="col-sm-auto">
                                    <form action="{{url('receipts',$receipt->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("DELETE")}}
                                        <input type="image" src="{{asset("storage\img\x.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                                <div class="col-sm-auto">
                                    <a href="receipts/edit"><img src="{{asset("storage\img\pencil.png")}}" width="30"></a>
                                </div>
                            @endif
                            <div class="col-sm-auto">
                                <a href="{{url('receipts',$receipt->id)}}"><img src="{{asset("storage\img\printer.png")}}" width="30"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center">
            </div>

        @endforeach
    @else
        <h3 class="text-center">لا توجد سندات قبض</h3>
    @endif
@endSection
