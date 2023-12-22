<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function password(): Attribute
    {
        return Attribute::make(set: fn ($value) => password_hash($value, PASSWORD_BCRYPT));
    }
}
