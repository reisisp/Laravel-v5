<div class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse justify-content-center">
            <ul class="nav">
                @forelse($popularCategories as $item)
                    <li class="nav-item"><a class="nav-link" href="{{ route('categories.show', $item->category_en) }}">{{ $item->category_ru }}</a></li>
                @empty
                    Явно проблема!
                @endforelse
            </ul>
        </div>
    </div>
</div>
