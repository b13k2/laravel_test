@php
    declare(strict_types=1);

    use App\Models\Product;

    $route = 'products';

    $button = 'templates.buttons';
    $table = 'templates.grids';
    $gridButton = 'templates.grids.buttons';
    $filter = "$table.filters";

    $formId = 'model-search-form';
    $productModel = new Product();
@endphp

@extends('layouts.main', [
    'title' => 'Управление товарами',
    'breadcrumbs' => [
        'Товары',
    ],
])

@section('content')
    <x-dynamic-component component='templates.pages.index'>
        <x-slot:buttons>
            <x-dynamic-component
                :component='"$button.create"'
                :title='trans("Добавить товар")'
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
                    :model='$productModel'
                    :attrs='$attrs'
                    attrName='id'
                />

                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$productModel'
                    :attrs='$attrs'
                    attrName='name'
                />

                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$productModel'
                    :attrs='$attrs'
                    attrName='vendor_code'
                />

                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$productModel'
                    :attrs='$attrs'
                    attrName='quantity'
                />

                <x-dynamic-component
                    :component='"$table.head-item"'
                    :model='$productModel'
                    :attrs='$attrs'
                    attrName='price'
                />
            </x-slot:head>

            <x-slot:filter>
                <x-dynamic-component :component='"$table.filter-item"'>
                    <x-dynamic-component
                        :component='"$filter.int"'
                        :model='$productModel'
                        attrName='id'
                        :form='$formId'
                    />
                </x-dynamic-component>

                <x-dynamic-component :component='"$table.filter-item"'>
                    <x-dynamic-component
                        :component='"$filter.string"'
                        :model='$productModel'
                        attrName='name'
                        :form='$formId'
                    />
                </x-dynamic-component>

                <x-dynamic-component :component='"$table.filter-item"'>
                    <x-dynamic-component
                            :component='"$filter.string"'
                            :model='$productModel'
                            attrName='vendor_code'
                            :form='$formId'
                    />
                </x-dynamic-component>
            </x-slot:filter>

            @foreach($models as $model)
                <tr class="model-data-row">
                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->id }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->name }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->vendor_code }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->quantity }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$table.body-item"'>
                        {{ $model->price }}
                    </x-dynamic-component>

                    <x-dynamic-component :component='"$gridButton.wrapper"'>
                        <x-dynamic-component
                            :component='"$gridButton.edit"'
                            :route='route("$route.edit", $model)'
                        />

                        <x-dynamic-component
                            :component='"$gridButton.delete"'
                            :route='route("$route.destroy", $model)'
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
