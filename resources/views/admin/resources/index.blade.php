@extends('layouts.main')

@section('title', 'Rss')

@section ('menu')
    @include('elements.adminMenu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Все Rss cсылки</h2>
            @forelse($resources as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ $item->url }}</h2>
                            <p>{{ $item->source }}</p>
                             <div class="container">
                                 <div class="row">
                                     <form action="{{ route('admin.resources.edit', $item) }}" method="GET">
                                         <button type="submit" class="btn btn-success">Edit</button>
                                     </form>
                                     <form action="{{ route('admin.resources.destroy', $item) }}" method="POST">
                                         @method('DELETE')
                                         @csrf
                                         <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Нет Rss</h3>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        {{ $resources->links() }}
        <h2><a href="{{ route('admin.index') }}">Назад</a></h2>
    </div>
@endsection