@extends('layouts.main_layout')
@section('content')
    <div class="w-full flex justify-center items-center">

        <form method="POST" action="{{ route('register') }}" class="bg-white p-10 rounded shadow max-w-xl w-full">
            @if (session('error'))
                <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @csrf

            <h2 class="text-3xl font-bold mb-6 text-center">Criar Conta</h2>

            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full mb-4 px-3 py-2 border rounded">
            @error('name')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full mb-4 px-3 py-2 border rounded">
            @error('email')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Senha</label>
            <input type="password" name="password" class="w-full mb-6 px-3 py-2 border rounded">
            @error('password')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Senioridade</label>
            <select name="seniority" class="w-full mb-4 px-3 py-2 border rounded">
                <option>Jr</option>
                <option>Pl</option>
                <option>Sr</option>
            </select>
            @error('seniority')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Skills (separadas por vírgula)</label>
            <input type="text" name="skills" placeholder="Ex: PHP, Laravel, MySQL, JavaScript" class="w-full mb-6 px-3 py-2 border rounded">
            @error('skills')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <hr class="my-4">

            <h3 class="text-xl font-semibold mb-3">Endereço</h3>

            <label>CEP</label>
            <input id="cep" name="cep" onkeyup="buscarCEP()" class="w-full mb-4 px-3 py-2 border rounded">
            @error('cep')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Rua</label>
            <input id="street" name="street" class="w-full mb-4 px-3 py-2 border rounded">
            @error('street')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Número</label>
            <input name="number" class="w-full mb-4 px-3 py-2 border rounded">
            @error('number')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Complemento</label>
            <input name="complement" class="w-full mb-4 px-3 py-2 border rounded">
            @error('complement')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Bairro</label>
            <input id="neighborhood" name="neighborhood" class="w-full mb-4 px-3 py-2 border rounded">
            @error('neighborhood')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Cidade</label>
            <input id="city" name="city" class="w-full mb-4 px-3 py-2 border rounded">
            @error('city')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <label>Estado</label>
            <input id="state" name="state" class="w-full mb-6 px-3 py-2 border rounded">
            @error('state')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded hover:bg-indigo-700">
                Registrar
            </button>
        </form>
    </div>


    <script>
        async function buscarCEP() {
            const cep = document.getElementById('cep').value;

            if (cep.length < 8) return;

            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);

            const data = await response.json();

            if (data.erro) {
                alert("CEP não encontrado!");
                return;
            }

            document.getElementById('street').value = data.logradouro;
            document.getElementById('neighborhood').value = data.bairro;
            document.getElementById('city').value = data.localidade;
            document.getElementById('state').value = data.uf;
        }
    </script>
@endsection
