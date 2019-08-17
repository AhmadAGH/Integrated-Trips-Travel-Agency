<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentRecipient;
class PaymentType extends Model
{
    protected $fillable = ['name', 'avl_amount'];
    
    public function paymentRecipient()
    {
        return $this->hasMany('App\PaymentRecipient');
    }
    public function receipt()
    {
        return $this->hasMany('App\Receipt');
    }
}
