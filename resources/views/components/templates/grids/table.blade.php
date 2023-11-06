@php
    declare(strict_types=1);
@endphp

@props([
    'head' => '',
    'filter' => '',
])

<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
    <thead>
    <tr class="fw-bold text-muted">
        {{ $head }}
        <th class="min-w-100px text-end"></th>
    </tr>

    @if($filter)
        <tr>
            {{ $filter }}
        </tr>
    @endif
    </thead>

    <tbody>
    {{ $slot }}
    </tbody>
</table>
