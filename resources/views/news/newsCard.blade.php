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
                        @if (!$newsOne->is_private)
                            <h2>{{ $newsOne->title }}</h2>
                            <p>{{ $newsOne->news_text }}</p>
                            <a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a>
                        @else
                            Новость приватная, зарегистрируйтесь для просмотра.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection