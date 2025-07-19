@props([
    'type' => 'submit',
    'variant' => 'primary', // primary, secondary
    'icon' => null,
    'fullWidth' => true,
])

@php
    $classes = [
        'primary' =>
            'text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:ring-green-500',
        'secondary' => 'text-gray-700 bg-white border-gray-300 hover:bg-gray-50 focus:ring-green-500',
    ];

    $buttonClass =
        'flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl';

    if ($fullWidth) {
        $buttonClass = 'w-full ' . $buttonClass;
    }

    $buttonClass .= ' ' . $classes[$variant];
@endphp

<button type="{{ $type }}" class="{{ $buttonClass }}" {{ $attributes }}>
    @if ($icon)
        {!! $icon !!}
    @endif
    {{ $slot }}
</button>
