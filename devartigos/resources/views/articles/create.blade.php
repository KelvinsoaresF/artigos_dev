@extends('layouts.main_layout')
@section('content')

    <body class="bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">

            @if ($errors->any())
                <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-3xl font-bold mb-6">Criar Novo Artigo</h1>

            <form action="{{ route('articles.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Título --}}
                <label class="font-semibold">Título</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded mt-1 mb-4" required>
                @error('title')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                {{-- Conteúdo --}}
                <label class="font-semibold">Conteúdo</label>
                <textarea name="content" rows="6" class="w-full border px-3 py-2 rounded mt-1 mb-4" required></textarea>
                @error('content')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                {{-- Data --}}
                {{-- <label class="font-semibold">Data de Publicação (opcional)</label>
            <input type="date" name="published_at" class="w-full border px-3 py-2 rounded mt-1 mb-4"> --}}

                {{-- Imagem --}}
                <label class="font-semibold">Imagem de capa (opcional)</label>
                <input type="file" name="cover_image" class="w-full mb-4">
                @error('cover_image')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                {{-- Desenvolvedores --}}
                <label class="font-semibold">Desenvolvedores</label>
                {{-- <select name="developers[]" multiple class="w-full border px-3 py-2 rounded mt-1 mb-4 h-40" required>
                    @foreach ($developers as $dev)
                        <option value="{{ $dev->id }}">{{ $dev->name }} — {{ $dev->seniority }}</option>
                    @endforeach
                </select> --}}
                @foreach ($developers as $dev)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="developers[]" value="{{ $dev->id }}">
                        {{ $dev->name }} — {{ $dev->seniority }}
                    </label>
                @endforeach
                @error('developers')
                    <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
                @enderror

                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                    Criar Artigo
                </button>
            </form>

        </div>

    </body>
@endsection
