@props([
    'id',
    'name',
    'type' => 'text',
    'value' => ''
])
<input class="account__form--input__field" {{ $attributes }} name="{{ $name }}" value="{{$value}}" id="{{ $id }}" type="{{ $type }}">
