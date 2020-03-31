<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'site';
    public $timestamps = true;

    protected $casts = [
        'slider' => 'object',
        'logo' => 'object',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}