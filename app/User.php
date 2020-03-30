<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'firstname', 'password', 'ip', 'lastname', 'email_verified', 'first_order', 'registration_date', 'verification_code', 'phone', 'adress', 'adress_2', 'birthday'
    ];

    protected $visible = ['id', 'email', 'firstname', 'lastname', 'email_verified', 'first_order', 'phone', 'adress', 'adress_2', 'birthday'];

    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
