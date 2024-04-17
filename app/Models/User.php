<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps  = false;


    protected function fullName() : Attribute {
        return Attribute::make(
            get:fn($value, $attributes) => $attributes['firstName'] . ' ' . $attributes['middleName'] . ' ' . $attributes['lastName'],
        );
    }

    
}
