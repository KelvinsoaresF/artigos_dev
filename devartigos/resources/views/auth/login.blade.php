@extends('layouts.main_layout')
@section('content')
    <div class="w-full flex justify-center items-center">
        <form method="POST" action="{{ route('login') }}" class="bg-white p-8 rounded shadow w-96">
            @csrf

            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

            @if (session('error'))
                <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <label>Email</label>
            <input type="text" name="email" value="{{ old('email') }}"  class="w-full mb-4 px-3 py-2 border rounded">
            @error('email')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Senha</label>
            <input type="password" name="password" class="w-full mb-6 px-3 py-2 border rounded">
            @error('password')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                Entrar
            </button>
            <div class="mt-2 flex flex-col items-center">
                <a class="text-blue-500" href="{{ route('register.view') }}">Não tem uma conta? Crie agora mesmo!</a>
            </div>
        </form>
    </div>
@endsection
