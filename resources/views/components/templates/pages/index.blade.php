@php
    declare(strict_types=1);
@endphp

@props([
    'search' => '',
    'buttons' => '',
    'pagination' => '',
])

<div class="card mb-5 mb-xl-8">
    @if($search || $buttons)
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                @if($search)
                @endif
            </div>

            @if($buttons)
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        {{ $buttons }}
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="card-body py-3">
        <div class="table-responsive">
            {{ $slot }}
        </div>
    </div>
</div>

{{ $pagination }}
