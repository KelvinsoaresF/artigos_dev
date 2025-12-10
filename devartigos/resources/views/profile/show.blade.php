@extends('layouts.main_layout')
@section('content')

    <body class="bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">

            <h1 class="text-3xl font-bold mb-6">Meu Perfil</h1>

            <div class="flex gap-3 mb-6">

                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                    Artigos criados: {{ $user->createdArticles()->count() }}
                </span>

                <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm">
                    Participando: {{ $user->articles()->count() }}
                </span>

            </div>

            @if (session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Informações Pessoais</h2>

                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Senioridade:</strong> {{ $user->seniority }}</p>

                <p class="mt-4"><strong>Skills:</strong></p>
                <ul>
                    @foreach ($user->skills as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Endereço</h2>

                <p><strong>CEP:</strong> {{ $user->cep }}</p>
                <p><strong>Rua:</strong> {{ $user->street }}</p>
                <p><strong>Número:</strong> {{ $user->number }}</p>

                @if ($user->complement)
                    <p><strong>Complemento:</strong> {{ $user->complement }}</p>
                @endif

                <p><strong>Bairro:</strong> {{ $user->neighborhood }}</p>
                <p><strong>Cidade:</strong> {{ $user->city }}</p>
                <p><strong>Estado:</strong> {{ $user->state }}</p>
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Artigos onde sou participante</h2>

                @if ($associatedArticles->count() === 0)
                    <p class="text-gray-600">Você não está associado a nenhum artigo.</p>
                @else
                    <div class="grid gap-4">
                        @foreach ($associatedArticles as $article)
                            <div class="p-4 border rounded-lg shadow-sm bg-gray-50 hover:shadow-md transition">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="text-indigo-600 font-semibold text-lg hover:underline">
                                        {{ $article->title }}
                                    </a>

                                    <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded">
                                        Participante
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Meus Artigos Criados</h2>

                @if ($myArticles->count() === 0)
                    <p class="text-gray-600">Você ainda não criou nenhum artigo.</p>
                @else
                    <div class="grid gap-4">
                        @foreach ($myArticles as $article)
                            <div class="p-5 bg-white border rounded-xl shadow-sm hover:shadow-md transition">

                                <div class="flex items-center justify-between">
                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="text-indigo-600 text-lg font-semibold hover:underline">
                                        {{ $article->title }}
                                    </a>
                                </div>

                                <div class="mt-4 flex gap-3">

                                    @can('update', $article)
                                        <a href="{{ route('articles.edit.view', $article->id) }}"
                                            class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                            Editar
                                        </a>
                                    @endcan

                                    <form action="{{ route('articles.delete', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este artigo?');">
                                        @csrf
                                        @method('DELETE')
                                        @can('delete', $article)
                                            <button type="submit"
                                                class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                                Excluir
                                            </button>
                                        @endcan
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex gap-3 mt-6">
                @can('update', $user)
                    <a href="{{ route('profile.edit.view', $user->id) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Editar Perfil
                    </a>
                @endcan

                @can('delete', $user)
                    <form action="{{ route('profile.delete') }}" method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Excluir Conta
                        </button>
                    </form>
                @endcan
            </div>
        </div>

    </body>
@endsection
