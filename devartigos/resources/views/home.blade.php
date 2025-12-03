@extends('layouts.main_layout')
@section('content')
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full text-center">
            {{ session('error') }}
        </div>
    @endif


    <main class="max-w-6xl mx-auto px-4 mt-10">

        <h2 class="text-3xl font-semibold mb-6">Meus Artigos</h2>

        @auth

            @foreach ($myArticles as $article)
                <x-article-card :title="$article->title" :content="Str::limit($article->content, 120)" :author="$article->owner->name" :developers="$article->developers->pluck('name')->toArray()">
                    <x-slot:actions>
                        @can('update', $article)
                            <a href="{{ route('articles.edit.view', $article) }}" class="text-green-600">
                                Editar
                            </a>
                        @endcan

                        @can('delete', $article)
                            <form action="{{ route('articles.delete', $article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Excluir</button>
                            </form>
                        @endcan
                    </x-slot:actions>
                </x-article-card>
            @endforeach

        @endauth


        <h2 class="text-3xl font-semibold mb-6">Artigos Recentes</h2>

        @if ($allArticles->count() == 0)
            <p class="text-gray-600">Nenhum artigo foi publicado ainda.</p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($allArticles as $article)
                <x-article-card :title="$article->title" :content="Str::limit($article->content, 120)" :author="$article->owner->name" :developers="$article->developers->pluck('name')->toArray()" showReadMore="true"
                    :readMoreUrl="route('articles.show', $article)" />
            @endforeach
        </div>

    </main>
@endsection
