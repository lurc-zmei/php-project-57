@props(['disabled' => false, 'options' => [], 'value' => null])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    @if(count($options) > 0)
        @foreach($options as $optionValue => $label)
            <option value="{{ $optionValue }}" @selected((string)$optionValue === (string)old($attributes->get('name'), $value))>
                {{ $label }}
            </option>
        @endforeach
    @else
        {{ $slot }}
    @endif
</select>