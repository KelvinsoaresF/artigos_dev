<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function Show()
    {
        $user = Auth::user();

        $myArticles = Article::where('owner_id', $user->id)->get();

        $associatedArticles = $user->articles()
            ->where('owner_id', '!=', $user->id)
            ->get();

        return view('profile.show', compact('user', 'myArticles', 'associatedArticles'));
    }

    public function ShowPublic($id)
    {
        $user = User::findOrFail($id);

        $myArticles = Article::where('owner_id', $user->id)->get();

        $associatedArticles = $user->articles()
            ->where('owner_id', '!=', $user->id)
            ->get();

        return view('profile.public', compact('user', 'myArticles', 'associatedArticles'));
    }

    public function EditShow()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function Edit(Request $request)
    {
        $user = Auth::user();

        $validateData = $request->validate([
            'name' => 'nullable|string|min:3',
            'email' => 'nullable|string|email',
            'seniority' => 'nullable|string|in:Jr,Pl,Sr',
            'skills' => 'nullable|string',
            'cep' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
        ],
        [
            // 'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',

            // 'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um email válido.',

            // 'seniority.required' => 'O campo senioridade é obrigatório.',
            'seniority.string' => 'O campo senioridade deve ser uma string.',
            'seniority.in' => 'O campo senioridade deve ser Jr, Pl ou Sr.',

            // 'skills.string' => 'O campo skills deve ser uma string.',

            'cep.string' => 'O campo CEP deve ser uma string.',
            'street.string' => 'O campo rua deve ser uma string.',
            'number.string' => 'O campo número deve ser uma string.',
            'city.string' => 'O campo cidade deve ser uma string.',
            'state.string' => 'O campo estado deve ser uma string.',
        ]);

        $validateData['skills'] = array_map('trim', explode(',', $request->skills));


        try {
            $user->update($validateData);

            return redirect()->route('profile.show')
                ->with('success', 'Perfil atualizado com sucesso.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao editar perfil')
                ->withInput();
        }
    }

    public function Delete()
    {
        $user = Auth::user();

        try {
            
            $user->delete();

            return redirect('/')->with('success', 'Conta deletada com sucesso.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao deletar conta.')
                ->withInput();
        }
    }
}
