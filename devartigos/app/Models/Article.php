<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
        'cover_image',
        'owner_id',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'article_user', 'article_id', 'user_id');
    }

    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}
}
