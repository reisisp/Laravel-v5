@extends('layouts.main')

@section('title', 'Админка')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card">
                <h2>Изменение учетных данных пользователя</h2>
                <form action="{{ route('admin.profile.update') }}" method="post">
                    @csrf

                    @if($errors->has('name'))
                        <div class="alert alert-danger">
                            @foreach($errors->get('name') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input class="form-control" name="name" placeholder="E-Mail" value="{{ $user->name }}"><br>

                    @if($errors->has('email'))
                        <div class="alert alert-danger">
                            @foreach($errors->get('email') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input class="form-control" name="email" placeholder="E-Mail" value="{{ $user->email }}"><br>

                    @if($errors->has('password'))
                        <div class="alert alert-danger">
                            @foreach($errors->get('password') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input class="form-control" name="password" type="password" placeholder="Текущий пароль"><br>

                    @if($errors->has('newPassword'))
                        <div class="alert alert-danger">
                            @foreach($errors->get('newPassword') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input class="form-control" name="newPassword" type="password" placeholder="Новый пароль"><br>

                    <button class="form-control" type="submit">Изменить</button>
                </form>
            </div>
        </div>
    </div>

@endsection