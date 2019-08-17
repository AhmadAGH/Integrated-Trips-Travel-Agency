<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Client;
use App\PaymentType;
class Receipt extends Model
{
    protected $fillable = ['user_id', 'client_id', 'amount', 'remainder','currency','receipt_date','discription','payment_type_id'];
    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function payment_type()
    {
        return $this->belongsTo('App\PaymentType','payment_type_id');
    }
}
