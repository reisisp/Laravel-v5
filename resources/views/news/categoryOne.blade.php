@extends('layouts.main')

@section('title', 'Новость по категории')

@section ('menu')
    @include('elements.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @forelse($news as $item)
                            <h2>{{ $item->title }}</h2>
                            @if (!$item->is_private)
                                <a href="{{ route('news.show', $item->id) }}">Подробнее...</a>
                                <br>
                            @endif
                            <hr>
                        @empty
                            Нет новостей
                        @endforelse
                        {{ $news->links() }}
                        <a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

