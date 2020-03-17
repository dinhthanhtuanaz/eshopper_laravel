<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $table = 'products';
    public $primaryKey = 'id';
    //$timestamps=true thì khi insert data mà dùng Model này thì nó sẽ
    //sinh ra create_at,update_at (ORM)
    //còn nếu dùng Query Builder thì sẽ ko sinh
    public $timestamps = true;

    public function category(){
        return $this->belongsTo('App\Model\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Model\Brand');
    }
}
