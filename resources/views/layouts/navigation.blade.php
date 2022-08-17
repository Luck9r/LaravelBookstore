<nav class="amber darken-2">
    <div class="nav-wrapper">
        <a href="{{ route('store') }}" class="brand-logo center hide-on-med-and-down">
            <i class="material-icons">book</i>{{ config('app.name', 'Laravel') }}
        </a>
        <ul id="nav-mobile" class="left">
            <li @if (Route::currentRouteName() == 'store') class="active"  @endif ><a href="{{ route('store') }}">Store</a></li>
            @if (Route::has('login'))
                @auth
                    @if(Auth::user()->role == 1)
                        <li @if (Route::currentRouteName() == 'dashboard') class="active"  @endif >
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                @endauth
            @endif

            <li><div class="hidden sm:flex sm:items-center sm:ml-6"></div></li>
        </ul>
        <ul id="nav-mobile" class="right">
            <li>
                <a class="green waves-effect waves-light btn" href="{{route('shopping_cart')}}">
                    <i class="material-icons left">shopping_cart</i>
                    Shopping cart
                </a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="mr-1">{{Auth::user()->name}}</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
            @else
                    <li>
                        <a href="{{ route('login') }}" class="nav-link">Log In</a>
                    </li>
                @endauth
            @endif

        </ul>
    </div>
</nav>
