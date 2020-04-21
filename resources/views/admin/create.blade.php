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
                        @dump($news)
                        <h1>@if ($news->id){{__('Изменить')}}@else{{__('Добавить')}}@endif новость</h1><br>

                        <form enctype="multipart/form-data" method="POST"
                              action="@if(!$news->id){{ route('admin.news.store') }}@else{{ route('admin.news.update', $news) }}@endif">
                            @csrf
                            @if ($news->id) @method('PATCH') @endif

                            <div class="form-group">
                                <label for="title">Название новости</label>
                                @if ($errors->has('title'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('title') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input name="title" type="text" class="form-control" id="title"
                                       value="{{ old('title') ?? $news->title }}">
                            </div>


                            <div class="form-group">
                                <label for="category_id">Категория новости</label>
                                @if ($errors->has('category_id'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('category_id') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <select name="category_id" class="form-control" id="category_id">
                                    @forelse($categories as $item)
                                        <option @if ($item->id == old('category_id') ?? $item->id == $news->category_id) selected
                                                @endif value="{{ $item['id'] }}">{{ $item['category_ru'] }}</option>
                                    @empty
                                        <h2>Что-то пошло не так</h2>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="news_text">Текст новости</label>
                                @if ($errors->has('news_text'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('news_text') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <textarea name="news_text" class="form-control" rows="5"
                                          id="news_text">{{ old('news_text') ?? $news->news_text ?? "" }}</textarea>
                            </div>

                            @if ($errors->has('is_private'))
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->get('is_private') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-check">
                                <input @if (old('is_private') == 1 || $news->is_private == 1) checked
                                       @endif name="is_private" value="1"
                                       class="form-check-input" type="checkbox"
                                       id="is_private">
                                <label class="form-check-label" for="is_private">Новость скрыта?</label>
                            </div>

                            <div class="form-group">
                                <button type="submit"
                                        class="form-control">@if ($news->id){{__('Изменить')}}@else{{__('Добавить')}}@endif</button>
                            </div>
                        </form>

                        <a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection