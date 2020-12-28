<header class="main-header bg-dark">
    <div class="container">
        <a class="home-link" href="{{ route('site.home') }}">
            <h1>Football Dashboard</h1>
        </a>
        <nav class="main-nav">
            <li>
                <a href="{{ route('site.leagues') }}" class="@if(request()->routeIs('site.leagues') || request()->routeIs('site.leagues.*')) active @endif">
                    Leagues
                </a>
            </li>
            <li>
                <a href="{{ route('site.teams') }}" class="@if(request()->routeIs('site.teams') || request()->routeIs('site.teams.*')) active @endif">
                    Teams
                </a>
            </li>
        </nav>
    </div>
</header>