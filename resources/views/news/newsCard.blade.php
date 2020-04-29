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
                        @if (!$news->is_private)
                            <h2>{{ $news->title }}</h2>
                           {{-- <img src="{{ url($news->image ?? asset('storage/default.jpg')) }}" class="img-fluid" alt="Responsive image">--}}
                            <p>{!! $news->news_text !!}</p>
                        @else
                            Новость приватная, зарегистрируйтесь для просмотра.
                        @endif
                        <a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection