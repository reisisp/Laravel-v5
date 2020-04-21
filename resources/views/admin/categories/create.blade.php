@extends('layouts.main')

@section('title', 'Добавить категорию')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            @dump($categories)
                            <h1>@if ($categories->id){{__('Изменить')}}@else{{__('Добавить')}}@endif категорию</h1><br>

                            <form enctype="multipart/form-data" method="POST"
                                  action="@if(!$categories->id){{ route('admin.categories.store') }}@else{{ route('admin.categories.update', $categories) }}@endif">
                                @csrf

                                @if ($errors->has('category_ru'))
                                    <div class="alert alert-danger" role="alert">@foreach ($errors->get('category_ru') as $error){{ $error }}@endforeach</div>
                                @endif
                                <div class="form-group">
                                    <label for="category_ru">Название категории</label>
                                    <input name="category_ru" type="text" class="form-control" id="category_ru"
                                           value="{{$categories->category_ru ?? old('category_ru') }}">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-primary"
                                           value="@if ($categories->id){{__('Изменить')}}@else{{__('Добавить')}}@endif категорию"
                                           id="addCategory">
                                </div>
                            </form>

                            <a href="{{ Redirect::back()->getTargetUrl() }}">Назад</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection