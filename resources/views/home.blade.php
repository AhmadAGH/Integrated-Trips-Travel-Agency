@extends('layouts.app')

@section('style')
    <style>
        
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">  
                    <div class="row">
                        <div  class="col-md-6">
                            <h4>{{$totlaReceiptsReminder." rem"}}</h4>
                        </div>                   
                        <div class="col-md-6">
                            <h4>{{$totalReceiptsAmount." rec"}}</h4>
                        </div>    
                        <div class="col-md-6">
                            <h4>{{$totalPaymentsAmount." p"}}</h4>
                        </div>                            
                    </div>               
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection
