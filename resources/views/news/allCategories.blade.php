@extends('layouts.main')

@section('title', 'Все категории')

@section ('menu')
    @include('elements.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Категории</h1><br>
                        @forelse($categories as $category)
                            <a href="{{ route('categories.show', $category->category_en) }}">
                                <h2>{{ $category->category_ru }}</h2>
                            </a>
                        @empty
                            Нет категорий
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection