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
        'Добавление',
    ],
])

@section('content')
    <x-dynamic-component
        component='templates.pages.create'
        :route='route("$route.store")'
    >
        @include('product._form', [
            'buttonLabel' => "Добавить",
        ])
    </x-dynamic-component>
@endsection
