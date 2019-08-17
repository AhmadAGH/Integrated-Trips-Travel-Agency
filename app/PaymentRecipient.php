<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;
use App\PaymentType;
class PaymentRecipient extends Model
{
    protected $fillable = ['payment_id', 'payment_date', 'amount', 'currency','recipient_name','discription','payment_type_id'];
    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');
    }
    public function payment_type()
    {
        return $this->belongsTo('App\PaymentType','payment_type_id');
    }
}
