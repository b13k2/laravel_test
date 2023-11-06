@php
    declare(strict_types=1);

    use App\Models\DocumentProduct;

    /**
     * @var DocumentProduct $model
     * @var string $attrName
     * @var bool $required
     */
@endphp

@props([
    'model',
    'attrs',
    'attrName',
    'attrValue',
    'required' => false,
])

@php
    $label = $attrs[$attrName] ?? $attrName;
@endphp

<div class="row fv-row mb-7">
    <div class="col-md-3 text-md-end">
        <label class="fs-6 fw-semibold form-label mt-3">
            <span @class([
                'required' => $required,
            ])>{{ $label }}</span>
        </label>
    </div>

    <div class="col-md-9">
        <x-dynamic-component
            component='documentProduct.inputs.input'
            class='form-control form-control-solid'
        />

        @error($attrName)
            <div class="fv-plugins-message-container invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
