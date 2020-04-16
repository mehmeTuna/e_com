<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = ['updated_at', 'password', 'verification_code'];
    protected $guarded = ['id'];
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function orders()
    {
        return $this->hasManyThrough('App\OrderItems','App\Orders', 'user_id', 'order_id');
    }
}