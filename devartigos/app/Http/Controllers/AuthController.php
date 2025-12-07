<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Config\Exception\ValidationException;

class AuthController extends Controller
{
    public function LoginShow()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {

        $validateData = $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ],
            [
                'email.required' => 'O campo email é obrigatório.',
                'email.string' => 'O campo email deve ser uma string.',
                'email.email' => 'O campo email deve ser um email válido.',

                'password.required' => 'O campo senha é obrigatório.',
                'password.string' => 'O campo senha deve ser uma string.',
                'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            ]
        );

        try {
            //code...
            $dev = User::where('email', $validateData['email'])->first();
            $passwordVerify = password_verify($validateData['password'], $dev->password);

            if (!$dev || !$passwordVerify) {
                return back()->with('error', 'Credenciais inválidas');
            }

            Auth::login($dev);
            return redirect('/')->with('success', 'Login realizado com sucesso');
            // } catch (ValidationException $e) {
            //     throw $e;
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao entrar na conta')
                ->withInput();
        }
    }

    public function RegisterShow()
    {
        return view('auth.register');
    }

    public function Register(Request $request)
    {

        $validateData = $request->validate(
            [
                'name'         => 'required|string|max:50',
                'email'        => 'required|string|email|max:255|unique:developers',
                'password'     => 'required|string|min:8|',

                'seniority'    => 'required|string|max:50',
                'skills'       => 'required|string',

                'cep'          => 'required|string|max:9',
                'street'       => 'required|string|max:255',
                'number'       => 'required|string|max:10',
                'complement'   => 'nullable|string|max:100',
                'neighborhood' => 'required|string|max:100',
                'city'         => 'required|string|max:100',
                'state'        => 'required|string|max:2',
            ],
            [

                'name.required' => 'O nome é obrigatório.',
                'name.max'      => 'O nome não pode passar de 50 caracteres.',

                'email.required' => 'O email é obrigatório.',
                'email.email'    => 'Informe um email válido.',
                'email.unique'   => 'Este email já está cadastrado.',
                'email.max'      => 'O email não pode ter mais de 255 caracteres.',

                'password.required' => 'A senha é obrigatória.',
                'password.min'      => 'A senha deve ter no mínimo 8 caracteres.',

                'seniority.required' => 'Selecione sua senioridade.',
                'seniority.in'       => 'Valor inválido. Escolha Jr, Pl ou Sr.',

                'skills.required' => 'Informe suas habilidades.',

                'cep.required' => 'O CEP é obrigatório.',
                'cep.regex'    => 'O CEP deve ter exatamente 8 números (somente números).',

                'street.required' => 'A rua é obrigatória.',
                'street.max'      => 'A rua não pode exceder 255 caracteres.',

                'number.required' => 'O número é obrigatório.',
                'number.max'      => 'O número não pode ter mais de 10 caracteres.',

                'complement.max' => 'O complemento não pode exceder 100 caracteres.',

                'neighborhood.required' => 'O bairro é obrigatório.',
                'neighborhood.max'      => 'O bairro não pode exceder 100 caracteres.',

                'city.required' => 'A cidade é obrigatória.',
                'city.max'      => 'A cidade não pode exceder 100 caracteres.',

                'state.required' => 'O estado é obrigatório.',
                'state.size'     => 'O estado deve ter exatamente 2 letras (ex: SP).',
            ]
        );

        try {
            $dev = User::create([
                'name'         => $validateData['name'],
                'email'        => $validateData['email'],
                'password'     => bcrypt($validateData['password']),

                'seniority'    => $validateData['seniority'],

                // separa a string em partes usando a vírgula como delimitador
                'skills'       => explode(',', $validateData['skills']),

                'cep'          => $validateData['cep'],
                'street'       => $validateData['street'],
                'number'       => $validateData['number'],
                'complement'   => $validateData['complement'] ?? null,
                'neighborhood' => $validateData['neighborhood'],
                'city'         => $validateData['city'],
                'state'        => $validateData['state'],
            ]);

            $dev->save();

            return redirect('/')->with('success', 'Conta criada com sucesso');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar conta' . $e->getMessage())
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout realizado com sucesso');
    }
}
