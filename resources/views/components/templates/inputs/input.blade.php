@php
    declare(strict_types=1);
@endphp

@aware([
    'model',
    'attrName',
    'attrValue',
    'disabled',
    'form' => '',
])

@php
    $config = [
        'type' => 'text',
        'disabled' => $disabled,
    ];

    $forcedAttrValue = $attrValue;
    $attrValue = old($attrName, $forcedAttrValue ?: $model->$attrName);

    if ($form) {
        $config['form'] = $form;
        $attrValue = old($attrName, $forcedAttrValue ?: request()->input($attrName));
    }
@endphp

<input
    id="field-{{ $attrName }}"
    {{ $attributes->merge($config) }}
    name="{{ $attrName }}"
    value="{{ $attrValue }}"
    @style([
        'background-color: #eef2f7' => $disabled,
    ])
>

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
