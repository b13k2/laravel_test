@php
    declare(strict_types=1);
@endphp

@props([
    'form' => '',
    'placeholder' => '',
    'format',
])

@aware([
    'model',
    'attrName',

    'disabled',
])

@php
    $attrValue = old($attrName, $model->$attrName);

    $config = [
        'class' => 'datepicker',
        'disabled' => $disabled,
    ];

    if ($form) {
        $config['form'] = $form;
        $attrValue = old($attrName, request()->input($attrName));
    }
@endphp

<input
    id="field-{{ $attrName }}"
    {{ $attributes->merge($config) }}
    name="{{ $attrName }}"
    placeholder="{{ $placeholder }}"
    value="{{ $attrValue }}"
>

@pushonce('scripts')
    <script>
        $(function () {
            let currentDateTime = new Date();

            $('.datepicker').flatpickr({
                enableTime: true,
                time_24hr: true,
                dateFormat: '{{ $format }}',
                defaultHour: currentDateTime.getHours(),
                defaultMinute: currentDateTime.getMinutes()
            });
        });
    </script>
@endpushonce

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
