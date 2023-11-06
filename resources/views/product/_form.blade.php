@php
    declare(strict_types=1);

    $form = 'templates.forms';
    $input = "$form.inputs";
    $formButton = "$form.buttons";
@endphp

<x-dynamic-component
    :component='"$form.attribute-group"'
    title='Основные параметры'
>
    <x-dynamic-component
        :component='"$input.string"'
        :model='$model'
        :attrs='$attrs'
        attrName='name'
        required
    />

    <x-dynamic-component
        :component='"$input.string"'
        :model='$model'
        :attrs='$attrs'
        attrName='vendor_code'
        required
        :disabled="(bool) $model->id"
    />

    <x-dynamic-component
        :component='"$input.string"'
        :model='$model'
        :attrs='$attrs'
        attrName='quantity'
        required
    />

    <x-dynamic-component
        :component='"$input.string"'
        :model='$model'
        :attrs='$attrs'
        attrName='price'
        required
    />

    <x-slot:buttons>
        <x-dynamic-component :component='"$formButton.wrapper"'>
            <x-dynamic-component
                :component='"$formButton.save"'
                :label='$buttonLabel'
            />
        </x-dynamic-component>
    </x-slot:buttons>
</x-dynamic-component>
