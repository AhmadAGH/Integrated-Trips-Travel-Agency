@extends('layouts.app')

@section('content')
<div class="container">
    <form name="form1" action="{{ action('PaymentsController@store') }}" method="POST" >
        {{csrf_field()}}
        <table class="table table-bordered table-fixed">
                <thead>
                  <tr>
                    <th scope="col" class="text-right th-lg">تاريخ الدفع</th>
                    <th scope="col" class="text-right th-lg">مزود الخدمة</th>
                    <th scope="col" class="text-right th-lg">المبلغ المدفوع</th>
                    <th scope="col" class="text-right th-lg">العملة</th>
                    <th scope="col" class="text-right th-lg">طريقة الدفع</th>
                    <th scope="col" class="text-right th-lg">البيان</th>
                    <th><a href="#" class="btn btn-primary" onclick="addRow()">+</a></th>
                    <th><a href="#" class="btn btn-danger btnRemove" style="display:none" onclick="removeRow()">-</a></th>
                  </tr>
                </thead>
                <tbody>
                        <tr id="0">
                            <th width="120px" scope="row"><input  value="{{date("Y-m-d")}}" type="date" name="payment_dates[0]" class="form-control text-right"></th>
                            <td width="150px"><input type="text" name="recipient_names[0]" class="form-control text-right"></td>
                            <td width="120px"><input type="number" step="0.1" name="amounts[0]" class="form-control text-right"></td>
                            <td width="120px"><input readonly="true" value="ريال سعودي" type="text" name="currencies[0]" class="form-control text-right"></td>
                            <td width="150px">
                                <select name="payment_type_ids[0]" class="form-control custom-select">
                                    @if(count($payment_types)>0)
                                        @foreach ($payment_types as $payment_type)
                                            <option value="{{$payment_type->id}}">{{$payment_type->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="-1">لا توجد طرق دفع</option>
                                    @endIf
                                </select>
                            </td>
                            <td width="250px"><input type="text" name="discriptions[0]" class="form-control text-right"></td>
                        </tr>
                </tbody>
              </table>
        <button type="submit" name="form1" class="btn btn-success">حفظ</button>
    </form>
    <script type="text/javascript">
    
     let i = 0;
        function addRow()
        {
            i++;
            if(i>0)
            {
                $('.btnRemove').show('1000');
            }
            let tr = '<tr style="display:none" id="'+i+'">'+
                    '<th scope="row"><input  value="{{date("Y-m-d")}}" type="date" name="payment_dates['+i+']" class="form-control text-right"></th>'+
                    '<td><input type="text" name="recipient_names['+i+']" class="form-control text-right"></td>'+
                    '<td><input type="number" step="0.1" name="amounts['+i+']" class="form-control text-right"></td>'+
                    '<td><input readonly="true" value="ريال سعودي" type="text" name="currencies['+i+']" class="form-control text-right"></td>'+
                    '<td width="150px">'+
                                '<select name="payment_type_ids['+i+']" class="form-control custom-select">'+
                                    '@if(count($payment_types)>0)'+
                                        '@foreach ($payment_types as $payment_type)'+
                                            '<option value="{{$payment_type->id}}">{{$payment_type->name}}</option>'+
                                        '@endforeach'+
                                    '@else'+
                                        '<option value="-1">لا توجد طرق دفع</option>'+
                                    '@endIf'+
                               '</select>'+
                            '</td>'+
                    '<td><input type="text" name="discriptions['+i+']" class="form-control text-right"></td>'+
                '</tr>';
            $('tbody').append(tr)
            $('#'+i).show('1000');
        }
        function removeRow()
        {
            if(i==1)
            {
                $('.btnRemove').hide('1000');
            }
            console.log(i);
            $('#'+(i)).remove();
            if(i<=0)
            {
                i=0
            }else{
                i--;
            }
            
        }
    </script>
@endSection
