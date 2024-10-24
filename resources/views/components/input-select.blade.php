@props([
    'selected' => null,
    'options' => [],
    'disabled' => false,
    'placeholder' => null
])

<select @disabled($disabled)
        {{ $attributes->merge(['class' => 'form-control-select']) }}
>
    @if($placeholder)
        <option value>{{ (string) $placeholder }}</option>
    @endif
    @foreach($options as $option)
        <option value="{{ $option['id'] }}" {{ $option['id']  == $selected ? 'selected' : '' }}>{{ $option['name'] }}</option>
    @endforeach
</select>
