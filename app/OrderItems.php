<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $hidden = ['id', 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'orderitems';
    protected $primaryKey = 'id';
    public $timestamps = true;
}