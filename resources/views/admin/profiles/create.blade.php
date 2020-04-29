@extends('layouts.main')

@section('title')@if ($profiles->id){{__('Изменить')}}@else{{__('Добавить')}}@endif пользователя@endsection

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
                            <h1>@if ($profiles->id){{__('Изменить')}}@else{{__('Добавить')}}@endif пользователя</h1><br>

                           <form enctype="multipart/form-data" method="POST"
                                  action="@if(!$profiles->id){{ route('admin.profiles.store') }}@else{{ route('admin.profiles.update', $profiles) }}@endif">
                                @csrf
                                @if ($profiles->id) @method('PATCH') @endif

                                @if ($errors->has('name'))
                                    <div class="alert alert-danger"
                                         role="alert">@foreach ($errors->get('name') as $error){{ $error }}@endforeach</div>
                                @endif
                                <div class="form-group">
                                    <label for="name">Имя пользователя</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                           value="{{ old('name') ?? $profiles->name}}">
                                </div>

                               @if ($errors->has('email'))
                                   <div class="alert alert-danger"
                                        role="alert">@foreach ($errors->get('email') as $error){{ $error }}@endforeach</div>
                               @endif
                               <div class="form-group">
                                   <label for="email">Email пользователя</label>
                                   <input name="email" type="email" class="form-control" id="email"
                                          value="{{ old('email') ?? $profiles->email}}">
                               </div>

                               @if ($errors->has('password'))
                                   <div class="alert alert-danger"
                                        role="alert">@foreach ($errors->get('password') as $error){{ $error }}@endforeach</div>
                               @endif
                               <div class="form-group">
                                   <label for="password">Пароль пользователя</label>
                                   <input name="password" type="password" class="form-control" id="password">
                               </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-primary"
                                           value="@if ($profiles->id){{__('Изменить')}}@else{{__('Добавить')}}@endif пользователя"
                                           id="addProfile">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <h2><a href="{{ route('admin.index') }}">Назад</a></h2>
            </div>
        </div>
@endsection