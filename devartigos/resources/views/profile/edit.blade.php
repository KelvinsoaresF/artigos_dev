@extends('layouts.main_layout')
@section('content')

    <body class="bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

            <h1 class="text-3xl font-bold mb-6">Editar Perfil</h1>

            {{-- MENSAGENS --}}
            @if (session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Informações Pessoais --}}
                <div>
                    <h2 class="text-xl font-semibold mb-2">Informações Pessoais</h2>

                    <label class="block mb-2 font-medium">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Senioridade</label>
                    <select name="seniority" class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">
                        <option {{ $user->seniority == 'Jr' ? 'selected' : '' }}>Jr</option>
                        <option {{ $user->seniority == 'Pl' ? 'selected' : '' }}>Pl</option>
                        <option {{ $user->seniority == 'Sr' ? 'selected' : '' }}>Sr</option>
                    </select>
                </div>

                {{-- Skills --}}
                <div>
                    <h2 class="text-xl font-semibold mb-2">Skills</h2>

                    <label class="block mb-2 font-medium">Skills (separadas por vírgula)</label>
                    <input type="text" name="skills" value="{{ old('skills', implode(', ', $user->skills ?? [])) }}"
                        class="w-full px-3 py-2 border rounded focus:ring focus:ring-indigo-200"
                        placeholder="Ex: PHP, Laravel, MySQL, JavaScript">
                </div>


                {{-- Endereço --}}
                <div>
                    <h2 class="text-xl font-semibold mb-2">Endereço</h2>

                    <label class="block mb-2 font-medium">CEP</label>
                    <input type="text" id="cep" value="{{ old('cep', $user->cep) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Rua</label>
                    <input type="text" name="street" value="{{ old('street', $user->street) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Número</label>
                    <input type="text" name="number" value="{{ old('number', $user->number) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Complemento</label>
                    <input type="text" name="complement" value="{{ old('complement', $user->complement) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Bairro</label>
                    <input type="text" name="neighborhood" value="{{ old('neighborhood', $user->neighborhood) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Cidade</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">

                    <label class="block mt-4 mb-2 font-medium">Estado</label>
                    <input type="text" name="state" value="{{ old('state', $user->state) }}"
                        class="w-full p-2 border rounded focus:ring focus:ring-indigo-200">
                </div>

                {{-- Botões --}}
                <div class="flex justify-between mt-6">
                    <a href="{{ route('profile.show') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                        Voltar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Salvar Alterações
                    </button>
                </div>

            </form>

        </div>

    </body>

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
