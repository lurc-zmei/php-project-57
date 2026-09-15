@props([
    'disabled' => false,
    'options' => [],
    'value' => null,
])

@php
    $name = $attributes->get('name', '');
    $baseName = str_replace('[]', '', $name);

    $rawValue = old($baseName, $value);

    if ($rawValue instanceof \Illuminate\Support\Collection) {
        $rawValue = $rawValue->pluck('id')->toArray();
    }

    $selectedValues = array_map('strval', \Illuminate\Support\Arr::wrap($rawValue));
@endphp

<select @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    @if (count($options) > 0)
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(in_array((string) $optionValue, $selectedValues, true))>
                {{ $optionLabel }}
            </option>
        @endforeach
    @else
        {{ $slot }}
    @endif
</select>
