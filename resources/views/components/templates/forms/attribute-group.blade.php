@php
    declare(strict_types=1);
@endphp

@props([
    'title',
    'buttons' => '',
    'imageUploader' => '',
])

<div class="card">
    <div class="card-header">
        <h3 class="card-title align-items-start flex-column">
            {{ $title }}
        </h3>

        {{ $imageUploader }}
    </div>

    <div class="card-body pt-7">
        {{ $slot }}
        {{ $buttons }}
    </div>
</div>
