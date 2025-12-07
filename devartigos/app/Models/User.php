<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'seniority',
        'skills',
        'cep',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'skills' => 'array',
        'published_at' => 'date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_user', 'user_id', 'article_id');
    }

    // garante que todos os artigos criados pelo usuário sejam deletados ao deletar o usuário, evitando dados "orfãos"
    // juntamente limpando a imagem de capa associada a cada artigo no storage
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            foreach ($user->articles as $article) {
                $article->delete();
            }
        });
    }
}
