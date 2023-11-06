@php
    declare(strict_types=1);
@endphp

@props([
    'url',
    'method',
    'file',
])

@php
    $config = [
        'url' => $url,
        'method' => $method,
    ];

    if ($file) {
        $config['enctype'] = 'multipart/form-data';
    }

    $attrs = ['id', 'class'];

    foreach ($attrs as $attr) {
        if ($attributes->has($attr)) {
            $config[$attr] = $attributes->get($attr);
        }
    }
@endphp

{{ Form::open($config) }}
    <div class="d-flex flex-column gap-7 gap-lg-10">
        {{ $slot }}
    </div>
{{ Form::close() }}
