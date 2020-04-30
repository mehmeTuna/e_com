<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $hidden = ['updated_at'];
    protected $guarded = ['id'];
    protected $table = 'markalar';
    protected $primaryKey = 'id';
    public $timestamps = true;

}