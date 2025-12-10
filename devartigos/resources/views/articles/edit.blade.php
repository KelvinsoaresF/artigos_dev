@extends('layouts.main_layout')
@section('content')

    <body class="bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">

            @if (session('error'))
                <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-3xl font-bold mb-6">Editar Artigo</h1>

            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label class="font-semibold">Título</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}"
                    class="w-full border px-3 py-2 rounded mt-1 mb-4">
                @error('title')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                <label class="font-semibold">Conteúdo</label>
                <textarea name="content" rows="6" class="w-full border px-3 py-2 rounded mt-1 mb-4">{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                @if ($article->cover_image)
                    <p class="font-semibold mb-2">Imagem atual:</p>
                    <img src="{{ asset('storage/' . $article->cover_image) }}" class="w-48 mb-4 rounded shadow">
                @endif

                <label class="font-semibold">Trocar imagem de capa (opcional)</label>
                <input type="file" name="cover_image" class="w-full mb-4">
                @error('cover_image')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                <label class="font-semibold">Desenvolvedores</label>
                @foreach ($developers as $dev)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="developers[]" value="{{ $dev->id }}"
                            {{ in_array($dev->id, old('developers', $article->developers->pluck('id')->toArray())) ? 'checked' : '' }}>
                        {{ $dev->name }} — {{ $dev->seniority }}
                    </label>
                @endforeach
                @error('developers')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 mt-4 rounded hover:bg-indigo-700">
                    Atualizar Artigo
                </button>
            </form>

        </div>

    </body>
@endsection
