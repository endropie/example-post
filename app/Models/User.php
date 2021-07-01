<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Endropie\ApiToolkit\Traits\HasFilterable;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, HasFilterable;

    const OPTION_ROLES = ['client', 'manager', 'user', 'vendor'];

    protected $attributes = [
        'ability' => '[]'
    ];

    protected $fillable = [
        'name', 'email', 'mobile', 'ability'
    ];

    protected $casts = [
        'ability' => 'array'
    ];

    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'ability' => $this->ability
        ];
    }
}
