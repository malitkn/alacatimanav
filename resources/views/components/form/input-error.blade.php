@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text text-warning']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
