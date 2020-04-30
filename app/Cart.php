<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $hidden = ['uuid', 'user_id', 'product_id', 'created_at', 'updated_at'];
    protected $guarded = [];
    protected $table = 'cart';
    protected $primaryKey = 'uuid';
    public $timestamps = true;

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
