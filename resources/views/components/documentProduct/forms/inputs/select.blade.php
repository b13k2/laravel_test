@php
    declare(strict_types=1);
@endphp

@props([
    'label',
    'attrs',
    'required' => '',

    'model',
    'attrName',
    'options' => [],

    // не обязательные
    'form' => '',
    'placeholder' => '...',
    'idAttr' => 'id',
    'labelAttr' => '',

    'disabled' => false,
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
        </label>
    </div>

    <div class="col-md-9">
        <div class="w-100">
            <x-dynamic-component
                component='documentProduct.inputs.select'
                class='form-select form-select-solid'
                :form='$form'
                :placeholder='$placeholder'
                :idAttr='$idAttr'
                :labelAttr='$labelAttr'
            />
        </div>

        @if($attrError)
            <div class="fv-plugins-message-container invalid-feedback">
                {{ $attrError }}
            </div>
        @endif
    </div>
</div>
