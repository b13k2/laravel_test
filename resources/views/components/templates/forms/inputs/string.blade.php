@php
    declare(strict_types=1);
@endphp

@props([
    'label',
    'hint' => '',
    'model',
    'attrs',
    'attrName',
    'attrValue' => '',
    'disabled' => false,
    'form' => '',
    'required' => '',
])

@php
    if (!isset($label)) {
        $label = $attrs[$attrName] ?? $attrName;
    }

    $attrError = $errors->has($attrName)
        ? $errors->first($attrName)
        : '';
@endphp

<div class="row fv-row mb-7">
    <div class="col-md-3 text-md-end">
        <label class="fs-6 fw-semibold form-label mt-3">
            <span @class([
                'required' => $required,
            ])>
                 {{ $label }}
            </span>

            @if($hint)
                <i
                    class="fas fa-exclamation-circle ms-1 fs-7"
                    data-bs-toggle="tooltip"
                    title="{{ $hint }}"
                ></i>
            @endif
        </label>
    </div>

    <div class="col-md-9">
        <x-dynamic-component
            component='templates.inputs.input'
            class='form-control form-control-solid'
        />

        @if($attrError)
            <div class="fv-plugins-message-container invalid-feedback">
                {{ $attrError }}
            </div>
        @endif
    </div>
</div>
