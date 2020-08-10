<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $hidden = ['active', 'product_id', 'category_id'];
    protected $guarded = [];
    protected $table = 'product_category';
    protected $primaryKey= 'product_id';
    public $timestamps = false;

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
