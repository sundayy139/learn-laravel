<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Date;

class Post extends Model
{
    use HasFactory, Sluggable;

    public $timestamps  = false;

    protected $fillable = [
        'id',
        'authorId',
        'title',
        'slug',
        'sumary',
        'content',
        'metaTitle',
        'metaDescription',
        'publishedAt',
        'createdAt',
        'updatedAt',
    ];

    public function Sluggable():array
    {
        return [
           'slug' => [
               'source' => 'title',
               'onUpdate' => true,
            ]
        ];
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($post) {
            $post -> createdAt = Date::now();
            $post -> updatedAt = Date::now();
            $post -> publishedAt = Date::now();
        });

        self::updating(function ($post) {
            $post -> updatedAt = Date::now();
        });
    }

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class , 'id');
    }

    public static function booted()
    {
        if(Auth::check()){
            static::addGlobalScope('author', function(Builder $builder){
                $builder -> where('authorId', Auth::id());
            });
        }
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'postId', 'tagId');
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_categories', 'postId', 'categoryId');
    }
}
