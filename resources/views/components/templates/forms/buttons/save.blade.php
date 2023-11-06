@php
    declare(strict_types=1);
@endphp

@props([
    'label',
])

<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
    <span class="indicator-label">
        {{ $label }}
    </span>

    <span class="indicator-progress">
        Отправка...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>
