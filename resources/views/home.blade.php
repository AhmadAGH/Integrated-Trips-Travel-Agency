@extends('layouts.app')

@section('style')
    <style>
        
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  text-center">
                <div class="card-header">
                    <h3>اجماليات عامة</h3>
                </div>
                <div class="card-body">  
                    <div class="row">
                        <div  class="col">
                            <h5>اجمالي المبالغ المقبوضة: {{$totalReceiptsAmount}}</h5>
                        </div>                   
                        <div class="col">
                            <h5>اجمالي المبالغ المصروفة: {{$totalPaymentsAmount}}</h5>
                        </div>    
                        <div class="col">
                            <h5>اجمالي المبالغ الغير المقبوضة: {{$totlaReceiptsReminder}}</h5>
                        </div>                            
                    </div>               
                </div>
            </div>
            <div class="card  text-center">
                    <div class="card-header">
                        <h3>الحسابات و الارصدة</h3>
                    </div>
                <div class="card-body">  
                    <div class="row bg-dark text-light">
                        <div class="col border"><h3>اسم الحساب</h3></div>
                        <div class="col border"><h3>الرصيد المتوفر</h3></div>
                    </div>
                    @foreach ($paymentTypes as $paymentType)
                        <div class="row border">
                            <div  class="col border">
                                <h5>{{$paymentType->name}}</h5>
                            </div>                   
                            <div class="col border">
                                <h5>{{$paymentType->avl_amount}}</h5>
                            </div>     
                        </div> 
                    @endforeach                                        
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection
