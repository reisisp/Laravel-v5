@extends('layouts.main')

@section('title', 'Админка')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Админка</h1><br>
                        <h3>{{ $success }}</h3>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.create') }}">Добавить новую новость</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.download') }}">Выгрузить новости <span>(excel)</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection