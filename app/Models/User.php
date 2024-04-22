<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use HasFactory, HasApiTokens, Notifiable ;

    public $timestamps  = false;


    protected function fullName() : Attribute {
        return Attribute::make(
            get:fn($value, $attributes) => $attributes['firstName'] . ' ' . $attributes['middleName'] . ' ' . $attributes['lastName'],
        );
    }

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'id',
        'firstName',
        'middleName', 
        'lastName', 
        'email', 
        'mobile', 
        'password', 
        'intro', 
        'profile', 
        'registedAt', 
        'lastLogin'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            $user->password = Hash::make($user->password);
        });

        self::updating(function ($user) {
            $user->password = Hash::make($user->password);
        });
    }

    public function posts() : HasMany 
    {
        return $this->hasMany(Post::class, 'authorId');
    } 
}
