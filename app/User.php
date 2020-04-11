<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = [ 'updated_at', 'password', 'verification_code'];
    protected $guarded = ['id'];
    protected $table = 'users';
    protected $primaryKey = 'id';
}
