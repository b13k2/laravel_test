@php
    declare(strict_types=1);
@endphp

@props([
    'model',
    'attrName',
    'options' => [],

    // не обязательные
    'form' => '',
    'placeholder' => '...',
    'idAttr' => 'id',
    'labelAttr' => '',
])

<x-dynamic-component
    component='templates.inputs.select'
    class='form-select form-select-sm'
    :form='$form'
    :placeholder='$placeholder'
    :idAttr='$idAttr'
    :labelAttr='$labelAttr'
/>
