@extends('layouts.main')

@section('title', $category->category_ru)

@section ('menu')
    @include('elements.menu')
@endsection

@section('popularCategories')
    @include('news.popularCategories')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $category->category_ru }}</h1><br>
                        @forelse($news as $item)
                            <h2>{{ $item->title }}</h2>
                            @if (!$item->is_private)
                                <a href="{{ route('news.show', [$category->category_en, $item->id]) }}">Подробнее...</a><br>
                            @endif
                            <hr>
                        @empty
                            Нет новостей
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

