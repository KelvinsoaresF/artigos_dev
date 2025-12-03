<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    public function Show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function CreateShow()
    {
        $user = Auth::user();

        $developers = User::where('id', '!=', $user->id)->get();

        return view('articles.create', compact('developers'));
    }

    public function Create(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required|min:10',
                'published_at' => 'nullable|date',
                'developers' => 'array|required',
                'developers.*' => 'exists:users,id',
                'cover_image' => 'nullable|image'
            ],
            [
                'title.required' => 'O título é obrigatório.',
                'title.min' => 'O título deve ter pelo menos 3 caracteres.',

                'content.required' => 'O conteúdo é obrigatório.',
                'content.min' => 'O conteúdo deve ter pelo menos 10 caracteres.',

                'developers.required' => 'Selecione pelo menos um desenvolvedor.',
                'developers.array' => 'Formato inválido para os desenvolvedores.',
                'developers.*.exists' => 'Um dos desenvolvedores selecionados não existe.',

                'cover_image.image' => 'A imagem enviada não é válida.'
            ]
        );

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('cover_images', 'public');
        }

        $user = Auth::user();

        if (in_array($user->id, $request->developers)) {
            return back()
                ->withErrors(['developers' => 'Você não pode selecionar a si mesmo como desenvolvedor.'])
                ->withInput();
        }

        $article = Article::create([
            'title' => $request->input('title'),
            'slug'  => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'published_at' => Date::now(),
            'cover_image' => $imagePath,
            'owner_id' => $user->id,
        ]);

        $article->developers()->sync($request->developers);

        return redirect('/')->with('success', 'Artigo criado com sucesso!');
    }

    public function EditShow(Article $article)
    {
        return view('articles.edit', [
            'article' => $article,
            'developers' => User::all()
        ]);
    }

    public function Delete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect('/')->with('success', 'Artigo deletado com sucesso!');
    }
}
