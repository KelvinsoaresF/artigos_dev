<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
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
            })->get();

        $allArticles = Article::all();

        return view('home', compact('myArticles', 'allArticles'));
    }

    public function Search(Request $request)
    {
        $user = Auth::user();
        $query = User::query();

        if ($user === null) {
            return view('auth.login');
        }

        //usando filled para verificar se o campo foi preenchido ou não, caso tenha sido preenchido, adiciona a condição na query,caso contrario ignora
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // vai procurar o valor da skill dentro do array json
        if ($request->filled('skill')) {
            $query->whereJsonContains('skills', $request->skill);
        }

        if ($request->filled('seniority')) {
            $query->where('seniority', $request->seniority);
        }

        //após as verificações executa a query e buscar os usuarios de acordo com os filtros obtidos pela query
        $searchResult = $query->get();

        $myArticles = Article::where('owner_id', $user->id)
            ->orWhereHas('developers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        $allArticles = Article::all();

        return view('home', compact('searchResult', 'myArticles', 'allArticles'));
    }
}
