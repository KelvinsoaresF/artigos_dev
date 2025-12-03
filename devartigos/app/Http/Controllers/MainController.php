<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function Index()
    {
        $user = Auth::user();

        if ($user === null) {
            return view('home', [
                'myArticles' => collect(), // lista vazia
                'allArticles' => Article::all(),
            ]);
        }

        $myArticles = Article::where('owner_id', $user->id)
            ->orWhereHas('developers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        $allArticles = Article::all();


        return view('home', compact('myArticles', 'allArticles'));
    }
}
