<ul class="navbar-nav mr-auto">
    <li class="nav-item {{ request()->routeIs('news.index')?'active':'' }}">
        <a class="nav-link" href="{{ route('news.index') }}">Главная</a>
    </li>
    <li class="nav-item {{ request()->routeIs('categories.index')?'active':'' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">Все категории</a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.index')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
    </li>
</ul>