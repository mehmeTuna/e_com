<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $visible = ['id', 'active', 'trName', 'img', '', 'enName', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'active', 'trName', 'img', '', 'enName', 'created_at', 'updated_at'];
    protected $table = 'category';
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}