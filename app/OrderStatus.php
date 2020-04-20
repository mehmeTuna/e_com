<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $hidden = ['id', 'updated_at', 'created_at'];
    protected $guarded = ['id'];
    protected $table = 'orderstatus';
    public $timestamps = true;

}
