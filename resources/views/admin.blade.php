@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h3>اضافة حساب جديد</h3>
        </div>
        <div class="card-body">  
            <form name="form1" action="{{url('/paymenttypes')}}" method="POST">
                {{ csrf_field() }}
                <div class="input-group mb-4">
                    <div class="input-group-postpend">
                        <span class="input-group-text">اسم الحساب</span>
                        <input required type="text"  name="name" class="form-control ">
                    </div>
                    <div class="input-group-postpend">
                        <span class="input-group-text">المبلغ المتوفر</span>
                        <input type="number" value="0.00" step="0.01" name="avl_amount" class="form-control">
                    </div>
                    <button type="submit" name="form1" class="btn btn-success">اضافة</button>
                </div>  
            </form>                                 
        </div>
    </div>
    <div class="card  text-center">
            <div class="card-header">
                <h3>حذف الحسابات</h3>
            </div>
        <div class="card-body">  
            <div class="row bg-dark text-light">
                <div class="col border"><h3>اسم الحساب</h3></div>
                <div class="col border"><h3>الرصيد المتوفر</h3></div>
                <div class="col border"><h3></h3></div>
            </div>
            @foreach ($paymentTypes as $paymentType)
                <div class="row border">
                    <div  class="col border">
                        <h5>{{$paymentType->name}}</h5>
                    </div>                   
                    <div class="col border">
                        <h5>{{$paymentType->avl_amount}}</h5>
                    </div>
                    <div class="col border">
                        <div class="col-sm-auto">
                            <form action="{{url('paymenttypes',$paymentType->id)}}"  onsubmit="return deleteConf()" method="POST">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <input type="image" src="{{asset("storage\img\x.png")}}"  width="30" alt="Submit" />
                            </form>
                        </div>
                    </div>    
                </div> 
            @endforeach                                        
        </div>
    </div>
    <div class="card  text-center">
        <div class="card-header">
            <h3>ادارة المستخدمين</h3>
        </div>
    <div class="card-body">  
        <div class="row bg-dark text-light">
            <div class="col border"><h3>اسم المستخدم</h3></div>
            <div class="col border"><h3>الوظيفة</h3></div>
            <div class="col border"><h3></h3></div>
        </div>
        @foreach ($users as $user)
            <div class="row border">
                <div  class="col border">
                    <h5>{{$user->name}}</h5>
                </div>                   
                <div class="col border">
                    @if ($user->role ==0)
                        <h5>ادارة</h5>
                    @elseif($user->role ==1)
                        <h5>مستخدم نشط</h5>
                    @else
                        <h5>مستخدم غير مفعل</h5>
                    @endif
                </div>
                <div class="col border">
                    @if (Auth::user()->id != $user->id)
                        <div class="row">
                            @if ($user->role == 0)
                                <div class="col">
                                    <form action="{{url('users',$user->id)}}"  onsubmit="return deleteConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("PATCH")}}
                                        <input  type="hidden" name="role" value={{$user->role - 1}}>
                                        <input disabled type="image" src="{{asset("storage\img\upgrade.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                                <div class="col">
                                    <form action="{{url('users',$user->id)}}"  onsubmit="return deleteConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("PATCH")}}
                                        <input  type="hidden" name="role" value={{$user->role + 1}}>
                                        <input type="image" src="{{asset("storage\img\downgrade.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                            @endif
                            @if ($user->role == 1 )
                                <div class="col">
                                    <form action="{{url('users',$user->id)}}"  onsubmit="return deleteConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("PATCH")}}
                                        <input  type="hidden" name="role" value={{$user->role - 1}}>
                                        <input type="image" src="{{asset("storage\img\upgrade.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                                <div class="col">
                                    <form action="{{url('users',$user->id)}}"  onsubmit="return deleteConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("PATCH")}}
                                        <input  type="hidden" name="role" value={{$user->role + 1}}>
                                        <input type="image" src="{{asset("storage\img\downgrade.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                            @endif
                            @if ($user->role == 2)
                                <div class="col">
                                    <form action="{{url('users',$user->id)}}"  onsubmit="return roleChangeConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("PATCH")}}
                                        <input  type="hidden" name="role" value={{$user->role - 1}}>
                                        <input type="image" src="{{asset("storage\img\upgrade.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                                <div class="col">
                                    <form action="{{url('users',$user->id)}}"  onsubmit="return roleChangeConf()" method="POST">
                                        {{csrf_field()}}
                                        {{method_field("PATCH")}}
                                        <input  type="hidden" name="role" value={{$user->role + 1}}>
                                        <input type="image" disabled src="{{asset("storage\img\downgrade.png")}}"  width="30" alt="Submit" />
                                    </form>
                                </div>
                            @endif
                            <div class="col">
                                <form action="{{url('users',$user->id)}}"  onsubmit="return deleteConf()" method="POST">
                                    {{csrf_field()}}
                                    {{method_field("DELETE")}}
                                    <input type="image" src="{{asset("storage\img\x.png")}}"  width="30" alt="Submit" />
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="row bg-secondary">
                            --
                        </div>
                    @endif
                </div>    
            </div> 
        @endforeach                                        
    </div>
</div>

</div>

<script type="text/javascript">
    function deleteConf()
    {
       return confirm("هل تريد حذف هذا الحساب؟")
    }
</script>
<script type="text/javascript">
    function roleChangeConf()
    {
       return confirm("هل تريد تغيير وظيفة هذا الحساب؟")
    }
</script>
@endsection
