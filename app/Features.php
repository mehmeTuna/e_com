<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $table = 'features';
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
