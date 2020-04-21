@extends('layouts.main')

@section('title', 'Категории')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Все категории</h2>
            @forelse($categories as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $item->category_ru }}</h2>
                            @dump($item)
                            <div class="container">
                                <div class="row">
                                    <form action="{{ route('admin.categories.edit', $item) }}" method="GET">
                                        <button type="submit" class="btn btn-success">Edit</button>
                                    </form>
                                    <form action="{{ route('admin.categories.destroy', $item) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
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