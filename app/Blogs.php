<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Blogs extends Model
{
    protected $hidden = ['updated_at'];
    protected $guarded = ['id'];
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', 1) ;
    }

        /**
     * Set the blog's url name.
     *
     * @param  string  $value
     * @return void
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = Str::slug($value);
    }

}
