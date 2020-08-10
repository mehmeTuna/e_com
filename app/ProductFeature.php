<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $hidden = ['active'];
    protected $guarded = [];
    protected $table = 'product_feature';
    protected $primaryKey= 'product_id';
    public $timestamps = false;
}
