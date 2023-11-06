@php
    declare(strict_types=1);

    $route = 'documents';
@endphp

@extends('layouts.main', [
    'title' => 'Управление документами',
    'breadcrumbs' => [
        [
            'label' => 'Документы',
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
        @include('document._form', [
            'buttonLabel' => "Создать",
        ])
    </x-dynamic-component>
@endsection
