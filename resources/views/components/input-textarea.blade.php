@props([
    'value' => '',
    'disabled' => false,
])

<textarea @disabled($disabled)
          rows="8"
        {{ $attributes->merge(['class' => 'form-control']) }}
>{{ $value }}</textarea>
