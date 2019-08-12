<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment;
class PaymentRecipient extends Model
{
    protected $fillable = ['payment_id', 'payment_date', 'amount', 'currency','recipient_name','discription','paymentType'];
    public function payment()
    {
        return $this->belongsTo('App\Payment','payment_id');
    }
}
