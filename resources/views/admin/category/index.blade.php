@extends('layouts.main')

@section('title', 'Категории')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Все категории</h2>
            @forelse($categories as $category)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $category->category_ru }}</h2>
                            <a href="{{ route('admin.category.edit', $category) }}">
                                <button type="button" class="btn btn-success">Edit</button>
                            </a>
                            <a href="{{ route('admin.category.destroy', $category) }}">
                                <button type="button" class="btn btn-danger">Delete</button>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Нет категорий</h3>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        {{ $categories->links() }}
        <h2><a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a></h2>
    </div>
@endsection