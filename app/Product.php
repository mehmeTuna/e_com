<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $visible = ['id', 'active', 'price', 'categoryId', 'trName', 'enName', 'quantity', 'trConternt', 'enContent', 'img', 'otherImg', 'code', 'features', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'active', 'price', 'categoryId', 'trName', 'enName', 'quantity', 'trConternt', 'enContent', 'img', 'otherImg', 'code', 'features', 'created_at', 'updated_at'];
    protected $table = 'products';
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function setOtherImgAttribute($value)
    {
        $this->attributes['otherImg'] = json_encode($value, true);
    }

}