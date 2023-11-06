@php
    declare(strict_types=1);

    use Illuminate\Database\Eloquent\Collection;
@endphp

@props([
    'form' => '',
    'placeholder' => '...',
    'idAttr' => 'id',
    'labelAttr' => '',
])

@aware([
    'model',
    'attrName',
    'options' => [],

    'disabled',
])

@php
    if (is_a($options, UnitEnum::class, true)) {
        $_options = [];

        foreach ($options::cases() as $option) {
            $_options[$option->value] = $option->label();
        }

        $options = $_options;
    } elseif (is_a($options, Collection::class, true)) {
        $_options = [];

        foreach ($options as $option) {
            if (!$labelAttr) {
                continue;
            }

            $_options[$option->$idAttr] = $option->$labelAttr;
        }

        $options = $_options;
    }

    $attrValue = is_a($model->$attrName, UnitEnum::class, true)
        ? $model->$attrName->value
        : $model->$attrName;

    $attrValue = old($attrName, $attrValue);
    $config = [];

    if ($form) {
        $config['form'] = $form;
        $attrValue = old($attrName, request()->input($attrName));
    }

    if (is_null($attrValue)) {
        $config['data-placeholder'] = $placeholder;
    } else {
        $attrValue = (int) $attrValue;
    }

    $config['disabled'] = $disabled;
@endphp

<select
    id="field-{{ $attrName }}"
    {{ $attributes->merge($config) }}
    name="{{ $attrName }}"
    data-control="select2"
    data-hide-search="true"
>
    <option value="">{{ $placeholder }}</option>
    @foreach($options as $value => $label)
        <option
            value="{{ $value }}"
            @selected($attrValue === $value)
        >{{ $label }}</option>
    @endforeach
</select>

@if($form)
    @push('scripts')
        <script>
            $(function () {
                $('#field-{{ $attrName }}').on('change', function () {
                    $('#{{ $form }}').submit();
                });
            });
        </script>
    @endpush
@endif
