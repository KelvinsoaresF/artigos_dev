<div class="bg-white p-6 rounded-lg shadow mb-10">
    <h2 class="text-3xl font-semibold mb-6">Buscar Desenvolvedores</h2>

    <form action="{{ route('search.users') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

        {{-- Buscar por nome --}}
        <div>
            <label class="block font-semibold mb-1">Nome</label>
            <input type="text" name="name" value="{{ request('name') }}" class="w-full border rounded px-3 py-2"
                placeholder="Buscar...">
        </div>

        {{-- Skill (campo array no user, lista simples enviada pelo controller) --}}
        <div>
            <label class="block font-semibold mb-1">Skill</label>
            <input type="text" name="skill" value="{{ request('skill') }}" class="w-full border rounded px-3 py-2"
                placeholder="Buscar...">
            {{-- <select name="skill" class="w-full border rounded px-3 py-2">
                <option value="">Todas</option>
                @foreach ($skills as $skill)
                    <option value="{{ $skill }}" {{ request('skill') == $skill ? 'selected' : '' }}>
                        {{ $skill }}
                    </option>
                @endforeach
            </select> --}}
        </div>

        {{-- Senioridade --}}
        <div>
            <label class="block font-semibold mb-1">Senioridade</label>
            <select name="seniority" class="w-full border rounded px-3 py-2">
                <option value="">Todas</option>
                <option value="Jr" {{ request('seniority') == 'Jr' ? 'selected' : '' }}>Junior</option>
                <option value="Pl" {{ request('seniority') == 'Pl' ? 'selected' : '' }}>Pleno</option>
                <option value="Sr" {{ request('seniority') == 'Sr' ? 'selected' : '' }}>Senior</option>
            </select>
        </div>

        {{-- Botão --}}
        <div class="flex items-end">
            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700 transition">
                Buscar
            </button>


        </div>
    </form>
</div>
