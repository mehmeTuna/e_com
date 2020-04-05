<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = [ 'updated_at'];
    protected $guarded = ['id'];
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