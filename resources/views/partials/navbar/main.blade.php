<nav class="navbar has-shadow is-info is-fixed-top">
    <div class="container">
        <div class="navbar-brand">
            <a href="{{ url('/') }}" class="navbar-item">
                <img src="{{asset('images/pokamax-logo.png')}}" alt="PokaMax logo">
            </a>

            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="navbar-menu" id="navMenu">
            <div class="navbar-start">
                @if(auth()->user())
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('companies.index') }}" class="navbar-item">Companies</a>
                    @endif

                    <a href="{{ route('editor') }}" class="navbar-item">Editor</a>
                @endif
            </div>

            <div class="navbar-end">
                @if (auth()->guest())
                    <a class="navbar-item " href="{{ route('login') }}">Login</a>
                    <a class="navbar-item " href="{{ route('register') }}">Register</a>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="#">{{ auth()->user()->name() }}</a>

                        <div class="navbar-dropdown is-right">
                            <a class="navbar-item" href="{{ route('user.profile') }}">
                              <span class="icon has-text-info is-small m-r-10"><i class="fa fa-fw fa-user-o"></i></span>
                              Profile
                            </a>
                            <a class="navbar-item" href="{{route('user.postcards')}}">
                              <span class="icon has-text-info is-small m-r-10"><i class="fa fa-fw fa-picture-o"></i></span>
                              My postcards
                            </a>
                            <a class="navbar-item" href="#">
                              <span class="icon has-text-info is-small m-r-10"><i class="fa fa-fw fa-sliders"></i></span>
                              Settings
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <span class="icon has-text-info is-small m-r-10"><i class="fa fa-fw fa-sign-out"></i></span>
                              Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
