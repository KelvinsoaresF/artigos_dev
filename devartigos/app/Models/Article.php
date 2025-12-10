<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'cover_image',
        'owner_id',
    ];

    protected $casts = [
    ];

    // relação do artigo com os desenvolvedores (usuários) associados
    public function developers(): BelongsToMany
    {
        // article_user é a tabela pivô que conecta artigos e usuários
        // article_id e user_id são as chaves estrangeiras na tabela pivô
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
