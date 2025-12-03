<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Developer extends Authenticatable
{
    use Notifiable;

    protected $table = 'developers';

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

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'skills' => 'array',
        'published_at' => 'date',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
