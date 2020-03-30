<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $visible = ['id', 'active', 'logo', 'address', 'email', 'phone', 'slider', 'gallery', 'about', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'active', 'logo', 'address', 'email', 'phone', 'slider', 'gallery', 'about', 'created_at', 'updated_at'];
    protected $table = 'site';
    public $timestamps = true;

    protected $casts = [
        'gallery' => 'object',
        'slider' => 'object',
        'logo' => 'object',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}