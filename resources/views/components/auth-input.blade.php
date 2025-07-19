@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'readonly' => false,
    'autofocus' => false,
    'value' => '',
    'icon' => null,
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <div class="relative">
        @if ($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {!! $icon !!}
            </div>
        @endif
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }}
            {{ $autofocus ? 'autofocus' : '' }} placeholder="{{ $placeholder }}"
            class="block w-full {{ $icon ? 'pl-10' : 'pl-3' }} pr-3 py-3 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors {{ $readonly ? 'bg-gray-50 text-gray-600 cursor-not-allowed' : '' }}"
            {{ $attributes }}>
    </div>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
