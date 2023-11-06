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
        'Редактирование',
    ],
])

@section('content')
    <x-dynamic-component
        component='templates.pages.edit'
        route=''
    >
        @include('document._form', [
            'buttonLabel' => 'Редактировать',
        ])
    </x-dynamic-component>
@endsection
