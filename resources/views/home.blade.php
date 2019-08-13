@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                   <div class="row">
                       <div class="col">
                           اجمالي المبالغ المصروفة: {{$totalPayments}}
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
