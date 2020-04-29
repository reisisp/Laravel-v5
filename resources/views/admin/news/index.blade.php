@extends('layouts.main')

@section('title', 'Новости')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Новости</h2>
            @forelse($news as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $item->title }}</h2>
                            <div class="container">
                                <div class="row">
                                    <form action="{{ route('admin.news.edit', $item) }}" method="GET">
                                        <button type="submit" class="btn btn-success">Edit</button>
                                    </form>
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST">
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
                            <h3>Нет новостей</h3>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        {{ $news->links() }}
        <h2><a href="{{ route('admin.index') }}">Назад</a></h2>
    </div>
@endsection