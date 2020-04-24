@extends('layouts.main')

@section('title', 'Новости')

@section ('menu')
    @include('elements.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Все новости</h1><br>
                        @forelse($news as $item)
                            <h2>{{ $item->title }}</h2>
                   {{--         <img src="{{ url($news->image ?? asset('storage/default.jpg')) }}" class="img-fluid" alt="Responsive image">--}}

                            @if (!$item->is_private)
                                <a href="{{ route('news.show', $item) }}">Подробнее...</a><br>
                            @endif
                            <hr>
                        @empty
                            Нет новостей
                        @endforelse
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection