@php
    declare(strict_types=1);
@endphp

@props([
    'form' => 'templates.forms.form',
    'method' => 'POST',
    'route',
    'file' => false,
])

<x-dynamic-component
    :component='$form'
    :method='$method'
    :url='$route'
    :file='$file'
>
    {{ $slot }}
</x-dynamic-component>
