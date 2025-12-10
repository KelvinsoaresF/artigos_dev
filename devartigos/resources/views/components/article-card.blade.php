<div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-6 flex flex-col gap-4 border border-gray-100 space-y-4 mb-6">

    <h3 class="text-2xl font-semibold text-indigo-600 leading-tight">
        {{ $title }}
    </h3>

    <p class="text-gray-600">
        {{ $content }}
    </p>

    @if ($author || (isset($developers) && count($developers) > 0))
        <div class="text-sm text-gray-700 bg-gray-100 rounded-xl p-3">
            @if ($author)
                <p>
                    <span class="font-semibold text-indigo-600">Autor:</span>
                    {{ $author }}
                </p>
            @endif

            @if (isset($developers) && count($developers) > 0)
                <p class="mt-1">
                    <span class="font-semibold text-indigo-600">Desenvolvedores:</span>
                    {{ implode(', ', $developers) }}
                </p>
            @endif
        </div>
    @endif

    <div class="flex items-center gap-4 mt-2">
        @if ($showReadMore ?? false)
            <a href="{{ $readMoreUrl }}" class="text-indigo-600 font-semibold hover:underline">
                Ler mais →
            </a>
        @endif

        {{ $actions ?? '' }}
    </div>

</div>
