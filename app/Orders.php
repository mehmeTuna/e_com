<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $hidden = ['id', 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;
}