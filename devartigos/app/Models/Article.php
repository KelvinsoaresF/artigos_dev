<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

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


    // relação do artigo com os desenvolvedores (usuários) associados
    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'article_user', 'article_id', 'user_id');
    }

    // relação do artigo com o autor do artigo
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    //garante que sempre que um artigo seja deletado, sua imagem de capa também seja removida do armazenamento
    // evitando sobrecarga desnecessária no storage
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
        });
    }
}
