<ul class="navbar-nav mr-auto">
    <li class="nav-item {{ request()->routeIs('news.index')?'active':'' }}">
        <a class="nav-link" href="{{ route('news.index') }}">Главная</a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.news.index')?'active':'' }}">
        <a class="nav-link" href="{{ route('admin.news.index') }}">Админка</a>
    </li>
</ul>