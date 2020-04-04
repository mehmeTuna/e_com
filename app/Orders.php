<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $hidden = ['id', 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'order_items';
    protected $primaryKey = 'order_id';
    public $timestamps = true;
}