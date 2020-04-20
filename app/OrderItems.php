<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{

    protected $hidden = ['id', 'productId', 'updated_at', 'order_id', 'selectbox', 'checkbox'];
    protected $guarded = ['id'];
    protected $table = 'orderitems';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'productId');
    }

    public function selectBox()
    {
        return $this->hasMany('App\Features', 'id','selectbox');
    }

    public function checkBox()
    {
        return $this->hasMany('App\Features', 'id', 'checkbox');
    }
}