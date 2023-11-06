@php
    declare(strict_types=1);

    use App\Dictionaries\DocumentType;
    use App\Models\Document;

    $route = 'documents';

    $button = 'templates.buttons';
    $table = 'templates.grids';
    $gridButton = 'templates.grids.buttons';
    $filter = "$table.filters";

    $formId = 'model-search-form';
    $documentModel = new Document();
@endphp

@extends('layouts.main', [
    'title' => 'Управление документами',
    'breadcrumbs' => [
        'Документы',
    ],
])

@section('content')
    <x-dynamic-component component='templates.pages.index'>
        <x-slot:buttons>
            <x-dynamic-component
                :component='"$button.create"'
                :title='trans("Создать документ")'
                :route='route("$route.create")'
            />
        </x-slot:buttons>

        {{ Form::open([
            'id' => $formId,
            'method' => 'GET',
            'url' => route("$route.index"),
        ]) }}
        {{ Form::close() }}

        <x-dynamic-component component='templates.grids.table'>
            <x-slot:head>
                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$documentModel'
                    :attrs='$attrs'
                    attrName='id'
                />

                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$documentModel'
                    :attrs='$attrs'
                    attrName='date'
                />

                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$documentModel'
                    :attrs='$attrs'
                    attrName='type_id'
                />
            </x-slot:head>

            <x-slot:filter>
                <x-dynamic-component :component='"$table.filter-item"'>
                    <x-dynamic-component
                        :component='"$filter.int"'
                        :model='$documentModel'
                        attrName='id'
                        :form='$formId'
                    />
                </x-dynamic-component>

                <x-dynamic-component :component='"$table.filter-item"'>
                    <x-dynamic-component
                        :component='"$filter.date"'
                        :model='$documentModel'
                        attrName='date'
                        :form='$formId'
                        format='Y-m-d'
                    />
                </x-dynamic-component>

                <x-dynamic-component :component='"$table.filter-item"'>
                    <x-dynamic-component
                        :component='"$filter.select"'
                        :model='$documentModel'
                        attrName='type_id'
                        :form='$formId'
                        :options='DocumentType::class'
                    />
                </x-dynamic-component>
            </x-slot:filter>

            @foreach($models as $model)
                <tr class="model-data-row">
                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->id }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->date->format('Y-m-d') }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->type_id->label() }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$gridButton.wrapper"'>
                        <x-dynamic-component
                            :component='"$gridButton.view"'
                            :route='route("$route.edit", $model)'
                        />
                    </x-dynamic-component>
                </tr>
            @endforeach
        </x-dynamic-component>

        <x-slot:pagination>
            {{ $models->withQueryString()->onEachSide(2)->links() }}
        </x-slot:pagination>
    </x-dynamic-component>
@endsection
