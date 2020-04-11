<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = [ 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'products';
    public $timestamps = true;

    protected $casts = [
        'otherImg' => 'object'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function setOtherImgAttribute($value)
    {
        $this->attributes['otherImg'] = json_encode($value, true);
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'categoryId') ;
    }

    public function featuresItems()
    {
        return $this->hasMany('App\Features', 'product_id', 'id')->where('features.active', 1) ;
    }

}