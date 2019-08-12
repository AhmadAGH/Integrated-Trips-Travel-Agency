<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Client;
class Receipt extends Model
{
    protected $fillable = ['user_id', 'client_id', 'amount', 'remainder','currency','receipt_date','discription','payment_type'];
    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
