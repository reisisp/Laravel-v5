@extends('layouts.main')

@section('title')@if ($categories->id){{__('Изменить')}}@else{{__('Добавить')}}@endif категорию@endsection

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
                            <h1>@if ($categories->id){{__('Изменить')}}@else{{__('Добавить')}}@endif категорию</h1><br>

                            <form enctype="multipart/form-data" method="POST"
                                  action="@if(!$categories->id){{ route('admin.categories.store') }}@else{{ route('admin.categories.update', $categories) }}@endif">
                                @csrf
                                @if ($categories->id) @method('PATCH') @endif

                                @if ($errors->has('category'))
                                    <div class="alert alert-danger"
                                         role="alert">@foreach ($errors->get('category') as $error){{ $error }}@endforeach</div>
                                @endif
                                <div class="form-group">
                                    <label for="category">Название категории</label>
                                    <input name="category" type="text" class="form-control" id="category"
                                           value="{{ old('category') ?? $categories->category}}">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-primary"
                                           value="@if ($categories->id){{__('Изменить')}}@else{{__('Добавить')}}@endif категорию"
                                           id="addCategory">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <h2><a href="{{ route('admin.index') }}">Назад</a></h2>
            </div>
        </div>
@endsection