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
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.news.create') }}">Добавить новую новость</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.news.index') }}">Изменить или удалить новости</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.categories.create') }}">Добавить новую категорию</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.categories.index') }}">Изменить или удалить категории</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.profiles.create') }}">Добавить нового пользователя</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.profiles.index') }}">Изменить или удалить пользователя</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.json') }}">Выгрузить новости <span>(JSON)</span></a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.resources.create') }}">Добавить RSS</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.resources.index') }}">Изменить или удалить RSS</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.parser') }}">Спарсить новости</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection