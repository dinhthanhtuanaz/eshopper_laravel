<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'configurations';
    public $primaryKey = 'id';
    public $timestamps = true;
}
