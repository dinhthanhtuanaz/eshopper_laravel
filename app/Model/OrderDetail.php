<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table="order_details";
    protected $primaryKey="id";
    public $timestamps =true;

    public function order(){
        return $this->belongsTo('App\Model\Order');
    }
}
