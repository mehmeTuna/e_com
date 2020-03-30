<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['username','password', 'active'];
    protected $visible = ['username', 'password', 'active'];
    public $timestamps = true ;
    protected $table = 'admin';
}
