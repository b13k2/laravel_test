@php
    declare(strict_types=1);

    use App\Models\DocumentProduct;

    /**
     * @var DocumentProduct $model
     * @var string $attrName
     * @var string|int $attrValue
     */
@endphp

@aware([
    'model',
    'attrName',
    'attrValue',
])

@php
    $config = [
        'type' => 'text',
    ];
@endphp

<input
    id="field-{{ $model->formName() . "-$attrName" }}"
    {{ $attributes->merge($config) }}
    name="{{ $model->formName() . "[$attrName][]" }}"
    value="{{ $attrValue }}"
/>
