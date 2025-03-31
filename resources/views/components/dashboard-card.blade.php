@props([
    'title',
    'value',
    'icon' => null,
    'color' => 'gray'
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow p-6']) }}>
    <div class="flex items-center gap-3">
        @if($icon)
            <x-icon :name="$icon" class="w-6 h-6 text-{{ $color }}-500" />
        @endif
        <h3 class="text-gray-500 text-sm font-medium">{{ $title }}</h3>
    </div>
    <p @class([
        'text-2xl font-bold mt-2',
        'text-'.$color.'-600' => $color !== 'gray'
    ])>
        {{ $value }}
    </p>
</div>