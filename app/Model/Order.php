<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="orders";
    protected $primaryKey="id";
    public $timestamps =true;

    public function customer(){
        return $this->belongsTo('App\Model\Customer');
    }

    public function orderDetails(){
        return $this->hasMany('App\Model\OrderDetail');
    }
}
