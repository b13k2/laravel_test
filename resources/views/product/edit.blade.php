@php
    declare(strict_types=1);

    $route = 'products';
@endphp

@extends('layouts.main', [
    'title' => 'Управление товарами',
    'breadcrumbs' => [
        [
            'label' => 'Товары',
            'url' => route("$route.index"),
        ],
        'Редактирование',
    ],
])

@section('content')
    <x-dynamic-component
        component='templates.pages.edit'
        :route='route("$route.update", $model)'
    >
        @include('product._form', [
            'buttonLabel' => 'Редактировать',
        ])
    </x-dynamic-component>
@endsection
