@php
    declare(strict_types=1);

    use App\Dictionaries\DocumentType;

    $form = 'templates.forms';
    $input = "$form.inputs";
    $formButton = "$form.buttons";
@endphp

<x-dynamic-component
    :component='"$form.attribute-group"'
    title='Основные параметры'
>
    <x-dynamic-component
        :component='"$input.date"'
        :model='$model'
        :attrs='$attrs'
        attrName='date'
        format='Y-m-d'
        :disabled="(bool) $model->id"
    />

    <x-dynamic-component
        :component='"$input.select"'
        :model='$model'
        :attrs='$attrs'
        attrName='type_id'
        :options='DocumentType::class'
        required
        :disabled="(bool) $model->id"
    />
</x-dynamic-component>

<x-dynamic-component
    :component='"$form.attribute-group"'
    title='Товары'
>
    {!! $productList !!}

    @if($model->id === null)
        <x-slot:buttons>
            <x-dynamic-component :component='"$formButton.wrapper"'>
                <x-dynamic-component
                    :component='"$formButton.save"'
                    :label='$buttonLabel'
                />
            </x-dynamic-component>
        </x-slot:buttons>
    @endif
</x-dynamic-component>
