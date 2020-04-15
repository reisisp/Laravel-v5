@extends('layouts.main')

@section('title', 'Добавить новость')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- @dump($news)--}}
                        <h1>@if ($news->id)Изменить@elseДобавить@endif новость</h1><br>

                        <form enctype="multipart/form-data" method="POST"
                              action="@if(!$news->id){{ route('admin.create') }}@else{{ route('admin.update', $news) }}@endif">
                            @csrf

                            <div class="form-group">
                                <label for="title">Название новости</label>
                                <input name="title" type="text" class="form-control" id="newsTitle"
                                       value="{{ $news->title ?? old('title') }}">
                            </div>


                            <div class="form-group">

                                <label for="category_id">Категория новости</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    @forelse($categories as $item)
                                        <option @if ($item->id == $news->category_id ?? $item->id == old('category_ru')) selected
                                                @endif value="{{ $item->id }}">{{ $item->category_ru }}</option>
                                    @empty
                                        <h2>Что-то пошло не так</h2>
                                    @endforelse

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="news_text">Текст новости</label>
                                <textarea name="news_text" class="form-control" rows="5"
                                          id="news_text">{{ $news->news_text ?? old('news_text') }}</textarea>
                            </div>

                            <div class="form-check">
                                <input @if ($news->is_private == 1 || old('is_private') == 1) checked
                                       @endif name="is_private"
                                       class="form-check-input" type="checkbox" value="1"
                                       id="newsPrivate">
                                <label class="form-check-label" for="newsPrivate">
                                    Новость скрыта?
                                </label>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"
                                       value=" @if ($news->id)Изменить@elseДобавить@endif новость"
                                       id="addNews">
                            </div>
                        </form>

                        <a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection