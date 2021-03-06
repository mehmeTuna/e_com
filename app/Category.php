<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'category';
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'categoryId', 'id')->where('products.active', 1);
    }

}