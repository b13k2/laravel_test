@php
    declare(strict_types=1);
@endphp

@props([
    'model',
    'attrName',
    'attrValue' => '',
    'disabled' => false,
    'form' => '',
])

<x-dynamic-component
    component='templates.inputs.input'
    class='form-control form-control-sm'
/>
