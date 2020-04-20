<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $hidden = ['updated_at', 'm_status', 'user_id'];
    protected $guarded = ['id'];
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function items()
    {
        return $this->hasMany('App\OrderItems', 'order_id', 'id')->orderBy('productId', 'ASC');
    }

    public function status()
    {
        return $this->hasOne('App\OrderStatus', 'type', 'm_status');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}