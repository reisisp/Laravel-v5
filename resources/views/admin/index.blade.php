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
                                <a href="{{ route('admin.create') }}">Добавить новую новость</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.category.create') }}">Добавить новую категорию</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.category.index') }}">Изменить или удалить категорию</a>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('admin.json') }}">Выгрузить новости <span>(JSON)</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <h2>Новости</h2>
            @forelse($news as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $item->title }}</h2>
                            <a href="{{ route('admin.edit', $item) }}">
                                <button type="button" class="btn btn-success">Edit</button>
                            </a>
                            <a href="{{ route('admin.destroy', $item) }}">
                                <button type="button" class="btn btn-danger">Delete</button>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Нет новостей</h3>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        {{ $news->links() }}
    </div>
@endsection