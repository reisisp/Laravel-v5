@extends('layouts.main')

@section('title', 'Профили')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Профили пользователей</h2>
            @forelse($profiles as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $item->name }}</h2>
                            <p>{{ $item->email }}</p>
                            <div class="container">
                                <div class="row">
                                    <form action="{{ route('admin.profiles.edit', $item) }}" method="GET">
                                        <button type="submit" class="btn btn-success">Edit</button>
                                    </form>
                                    <form action="{{ route('admin.profiles.destroy', $item) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @if ($item->is_admin)
                                        <a href="{{route('admin.toggleAdmin', $item)}}"><button type="button" class="btn btn-danger">{{__('to User')}}</button></a>
                                    @else
                                        <a href="{{route('admin.toggleAdmin', $item)}}"> <button type="button" class="btn btn-success">{{__('to Master')}}</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Упс, пользователей больше не осталось!</h3>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        {{ $profiles->links() }}
        <h2><a href="{{ route('admin.index') }}">Назад</a></h2>
    </div>
@endsection