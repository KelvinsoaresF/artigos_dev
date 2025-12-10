@extends('layouts.main_layout')
@section('content')

    <body class="bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">

            <h1 class="text-3xl font-bold mb-6">Perfil de {{ $user->name }}</h1>

            <div class="flex gap-3 mb-6">

                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                    Artigos criados: {{ $user->createdArticles()->count() }}
                </span>

                <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm">
                    Participando: {{ $user->articles()->count() }}
                </span>

            </div>

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
                <p><strong>Cidade:</strong> {{ $user->city }}</p>
                <p><strong>Estado:</strong> {{ $user->state }}</p>
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Participações em Artigos</h2>

                @if ($associatedArticles->count() === 0)
                    <p class="text-gray-600">Este usuário não está associado a nenhum artigo.</p>
                @else
                    <div class="grid gap-4">
                        @foreach ($associatedArticles as $article)
                            <div class="p-4 border rounded-lg shadow-sm bg-gray-50 hover:shadow-md transition">
                                <a href="{{ route('articles.show', $article->id) }}"
                                    class="text-indigo-600 font-semibold text-lg hover:underline">
                                    {{ $article->title }}
                                </a>

                                <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded ml-2">
                                    Participante
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Artigos Criados</h2>

                @if ($myArticles->count() === 0)
                    <p class="text-gray-600">Este usuário ainda não criou artigos.</p>
                @else
                    <div class="grid gap-4">
                        @foreach ($myArticles as $article)
                            <div class="p-5 bg-white border rounded-xl shadow-sm hover:shadow-md transition">

                                <a href="{{ route('articles.show', $article->id) }}"
                                    class="text-indigo-600 text-lg font-semibold hover:underline">
                                    {{ $article->title }}
                                </a>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </body>
@endsection
