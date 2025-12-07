<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'owner_id' => 1,
                'title' => 'Introdução ao Laravel',
                'slug' => Str::slug('Introdução ao Laravel'),
                'content' => 'Conteúdo do artigo sobre Laravel.',
                'published_at' => Carbon::now(),
                'cover_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'owner_id' => 2,
                'title' => 'Guia de Vue.js para Iniciantes',
                'slug' => Str::slug('Guia de Vue.js para Iniciantes'),
                'content' => 'Um guia simples sobre Vue.js.',
                'published_at' => Carbon::now(),
                'cover_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'owner_id' => 3,
                'title' => 'Técnicas Avançadas de Docker',
                'slug' => Str::slug('Técnicas Avançadas de Docker'),
                'content' => 'Aprenda a usar Docker como um profissional.',
                'published_at' => null,
                'cover_image' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
