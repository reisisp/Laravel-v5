@extends('layouts.main')

@section('title')@if ($resources->id){{__('Изменить')}}@else{{__('Добавить')}}@endif {{__('Rss')}}@endsection

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
                            <h1>@if ($resources->id){{__('Изменить')}}@else{{__('Добавить')}}@endif Rss</h1><br>

                            <form enctype="multipart/form-data" method="POST"
                                  action="@if(!$resources->id){{ route('admin.resources.store') }}@else{{ route('admin.resources.update', $resources) }}@endif">
                                @csrf
                                @if ($resources->id) @method('PATCH') @endif

                                @if ($errors->has('url'))
                                    <div class="alert alert-danger"
                                         role="alert">@foreach ($errors->get('url') as $error){{ $error }}@endforeach</div>
                                @endif
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input name="url" type="text" class="form-control" id="url"
                                           value="{{ old('url') ?? $resources->url}}">
                                </div>

                                @if ($errors->has('source'))
                                    <div class="alert alert-danger"
                                         role="alert">@foreach ($errors->get('source') as $error){{ $error }}@endforeach</div>
                                @endif
                                <div class="form-group">
                                    <label for="source">Название источника</label>
                                    <input name="source" type="text" class="form-control" id="source"
                                           value="{{ old('source') ?? $resources->source}}">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-primary"
                                           value="@if ($resources->id){{__('Изменить')}}@else{{__('Добавить')}}@endif Rss"
                                           id="addRss">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <h2><a href="{{ route('admin.index') }}">Назад</a></h2>
            </div>
        </div>
@endsection