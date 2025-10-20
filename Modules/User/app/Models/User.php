<?php

namespace Modules\User\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // protected static function newFactory(): UserFactory
    // {
    //     // return UserFactory::new();
    // }

}
