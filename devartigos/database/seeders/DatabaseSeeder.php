<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTableSeeder::class,
            ArticlesTableSeeder::class,
        ]);

        $users = User::factory(10)->create();

        $articles = Article::factory(20)->create();

        $articles->each(function ($article) use ($users) {
            // cada artigo terá entre 1 e 5 desenvolvedores associados
            $devs = $users->random(rand(1, 5));

            $article->developers()->attach(
                $devs->pluck('id')->toArray()
            );
        });

    }
}
