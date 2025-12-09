<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        // mostra somentes os desenvolvedores que não sejam o próprio usuário logado
        $developers = User::where('id', '!=', $user->id)->get();

        return view('articles.create', compact('developers'));
    }

    public function Create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required|min:10',
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
        try {
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
                'published_at' => Carbon::now(),
                'cover_image' => $imagePath,
                'owner_id' => $user->id,
            ]);

            //Associa os desenvolvedores ao artigo (developers vem atraves da relação many to many feita pelo model Article)
            $article->developers()->sync($request->developers);

            return redirect('/')->with('success', 'Artigo criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar artigo')
                ->withInput();
        }
    }

    public function EditShow(Article $article)
    {
        $user = Auth::user();

        // mostra somentes os desenvolvedores que não sejam o próprio usuário logado
        $developers = User::where('id', '!=', $user->id)->get();

        return view('articles.edit', [
            'article' => $article,
            'developers' => $developers
        ]);
    }

    public function Edit(Request $request, Article $article)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required|min:10',
                // 'published_at' => 'nullable|date',
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

        try {

            $imagePath = null;
            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('cover_images', 'public');
            }

            $article->update([
                'title' => $request->input('title'),
                'slug'  => Str::slug($request->input('title')),
                'content' => $request->input('content'),
                'cover_image' => $imagePath,
            ]);

            $article->developers()->sync($request->developers);

            return redirect('/')->with('success', 'Artigo atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar artigo: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function Delete($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();

            return redirect('/')->with('success', 'Artigo deletado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao deletar artigo')
                ->withInput();
        }
    }
}
