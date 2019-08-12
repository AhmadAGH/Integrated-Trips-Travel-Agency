<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentRecipient;
use App\User;
class Payment extends Model
{
    protected $fillable = ['user_id'];
    public function paymentRecipient()
    {
        return $this->hasMany('App\PaymentRecipient');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}

