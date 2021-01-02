<header class="main-header bg-dark">
    <div class="container">
        <a class="home-link" href="{{ route('site.home') }}">
            <h1>Football Dashboard</h1>
        </a>
        <nav class="main-nav @auth auth-nav @endauth">
            @auth
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
                <li class="ml-auto">
                    Logged in as {{ Auth::user()->name }}, 
                    <a class="text-danger d-inline" href="{{ route('site.logout') }}">
                        Logout
                    </a>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('site.register') }}" @if(request()->routeIs('site.register'))class="active"@endif>
                        Register
                    </a>
                </li>
                <li>
                    <a href="{{ route('site.login') }}" @if(request()->routeIs('site.login'))class="active"@endif>
                        Login
                    </a>
                </li>
            @endguest
        </nav>   
    </div>
</header>