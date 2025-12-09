<div class="bg-white shadow rounded-lg p-5">
    <a href="{{ route('profile.public.show', $user->id) }}">
        <h3 class="text-xl font-semibold hover:text-blue-500">{{ $user->name }}</h3>
    </a>

    <p class="text-gray-600">{{ $user->seniority }}</p>

    <div class="mt-2">
        <p class="text-sm font-semibold text-gray-700">Skills:</p>
        <div class="flex flex-wrap gap-2 mt-1">
            @foreach ($user->skills as $skill)
                <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                    {{ $skill }}
                </span>
            @endforeach
        </div>
    </div>
</div>
