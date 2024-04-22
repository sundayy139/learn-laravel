<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, Sluggable;

    public $timestamps  = false;

    protected $fillable = [
        'id',
        'title',
        'content',
        'metaTitle',
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

    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'tagId', 'postId');
    }
}
