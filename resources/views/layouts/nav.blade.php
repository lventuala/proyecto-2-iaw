<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/img-head.png') }}" width="50" height="50" alt="">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">@lang('Home')</a>
                </li>

                @if(Auth::user()->hasRol('admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('usuarios') ? 'active' : '' }}" href="{{route('usuarios')}}">@lang('Usuarios')</a>
                    </li>
                @endif

                @if(Auth::user()->estado == 0)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.index') ? 'active' : '' }}" href="{{route('productos.index')}}">@lang('Productos')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('materias-primas.index') ? 'active' : '' }}" href="{{route('materias-primas.index')}}">@lang('Materias Primas')</a>
                    </li>
                @endif
            </ul>
        </div>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nombre }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>


    </div>
</nav>
