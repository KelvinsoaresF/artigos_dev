<header class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

        <a href="/">
            <h1 class="text-2xl font-bold text-indigo-600">DevArticles</h1>

        </a>

        <div class="flex space-x-4">
            {{-- Se o usuário estiver logado --}}
            @auth
            <a href="{{ route('profile.show') }}" class="px-4 py-2 hover:bg-gray-300 rounded">
                <span class="text-gray-700 ">Olá, {{ auth()->user()->name }}</span>
            </a>

                <a href="{{ route('articles.create.view') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Criar Artigo
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Sair
                    </button>
                </form>
            @endauth

            {{-- Se o usuário NÃO estiver logado --}}
            @guest
                <a href="{{ route('login.view') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                <a href="{{ route('register.view') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Registrar</a>
            @endguest
        </div>
    </div>
</header>
