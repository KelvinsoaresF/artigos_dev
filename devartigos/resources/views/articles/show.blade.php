@extends('layouts.main_layout')

@section('content')
    <main class="max-w-4xl mx-auto px-4 py-10">

        <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-200">

            <h1 class="text-4xl font-bold text-indigo-700 mb-6">
                {{ $article->title }}
            </h1>

            @if ($article->cover_image)
                <div class="w-full mb-6">
                    <img src="{{ asset('storage/' . $article->cover_image) }}"
                        class="w-full rounded-xl shadow object-cover max-h-[380px]" alt="Imagem de capa do artigo">
                </div>
            @else
                <div class="w-full mb-6 h-48 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                    <p class="text-lg italic">Sem imagem de capa</p>
                </div>
            @endif

            <div class="bg-gray-100 p-4 rounded-xl mb-6">
                <p>
                    <span class="font-semibold text-indigo-600">Autor:</span>
                    <a href="{{ route('profile.public.show', $article->owner->id) }}" class="hover:underline">
                        {{ $article->owner->name }}
                    </a>
                </p>

                @if ($article->developers->count() > 0)
                    <p class="mt-1">
                        <span class="font-semibold text-indigo-600">Desenvolvedores:</span>
                        @foreach ($article->developers as $dev)
                            <a href="{{ route('profile.public.show', $dev->id) }}" class="hover:underline text-indigo-600">
                                {{ $dev->name }}
                            </a>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </p>
                @endif

                <p class="mt-1 text-sm text-gray-600">
                    Publicado em:
                    {{ $article->created_at ? $article->created_at->format('d/m/Y H:i') : '—' }}
                </p>
            </div>

            <div class="prose max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="flex gap-4 mt-10">

                @can('update', $article)
                    <a href="{{ route('articles.edit.view', $article) }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
                        Editar
                    </a>
                @endcan

                @can('delete', $article)
                    <form action="{{ route('articles.delete', $article) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                            Excluir
                        </button>
                    </form>
                @endcan

                <a href="{{ url()->previous() }}" class="px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800">
                    Voltar
                </a>
            </div>

        </div>

    </main>
@endsection
