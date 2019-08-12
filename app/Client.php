<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reciept;
class Client extends Model
{
    protected $fillable = ['name', 'phone_number'];
    public function receipts()
    {
        return $this->hasMany('App\Receipt');
    }
}
