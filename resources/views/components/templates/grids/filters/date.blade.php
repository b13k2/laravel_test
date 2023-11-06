@php
    declare(strict_types=1);
@endphp

@props([
    'model',
    'attrName',
    'form' => '',
    'placeholder' => '...',
    'format' => 'Y-m-d H:i:S',
])

<x-dynamic-component
    component='templates.inputs.date'
    class='form-control form-control-sm'
    :form='$form'
    :placeholder='$placeholder'
    :format='$format'
/>
