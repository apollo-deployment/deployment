<!DOCTYPE html>
<html>
    <head>
        <title>Apollo</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Styles --}}
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('styles')
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="row">
                    @auth
                        <div class="col-md-2">
                            <div class="logo">
                                <a href="{{ route('view.index') }}">
                                    <img src="{{ url('images/apollo.png') }}" alt="Apollo Deployment">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-offset-8">
                            <div class="dropdown">
                                <p class="user" data-toggle="dropdown">{{ \Auth::user()->name }}
                                    @if (\Auth::user()->avatar)
                                        <img src="{{ url('/images/avatars/' . \Auth::user()->avatar) }}" class="avatar">
                                    @else
                                        <img src="{{ url('/images/avatars/default.png') }}" class="avatar">
                                    @endif
                                </p>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('view.profile') }}">
                                        <i class="fa fa-user accent"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fa fa-sign-out accent"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @auth
                    <div class="col-md-2">
                        <div class="sidebar">
                            <p class="sidebar-header">Deployment</p>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="{{ route('view.deployment-plans') }}" class="{{ Route::is('view.deployment-plans') ? 'active' : '' }}">
                                        <i class="fa fa-wrench"></i> Build Plans
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('view.environments') }}" class="{{ Route::is('view.environments') ? 'active' : '' }}">
                                        <i class="fa fa-server"></i> Environments
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('view.repositories') }}" class="{{ Route::is('view.repositories') ? 'active' : '' }}">
                                        <i class="fa fa-code"></i> Repositories
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth
                <div class="col-md-{{ \Auth::check() ? '10' : '12' }}">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')
    </body>
</html>
