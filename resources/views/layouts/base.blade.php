<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Apollo</title>

        {{-- Styles --}}
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('styles')
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="logo">
                            <a href="{{ route('view.index') }}">
                                <img src="/images/apollo.png">
                            </a>
                        </div>
                    </div>
                    @auth
                        <div class="col-md-8">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="{{ route('view.deployment-plans') }}" class="{{ Route::is('view.deployment-plans') ? 'active' : '' }}">Deployment</a>
                                </li>
                                <li>
                                    <a href="{{ route('view.environments') }}" class="{{ Route::is('view.environments') ? 'active' : '' }}">Environments</a>
                                </li>
                                <li>
                                    <a href="{{ route('view.repositories') }}" class="{{ Route::is('view.repositories') ? 'active' : '' }}">Repositories</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <div class="dropdown">
                                <p class="user" data-toggle="dropdown" >{{ Auth::user()->name }}</p>
                                <div class="dropdown-menu pull-right">
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

        <div class="content">
            @yield('content')
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center secondary-text">&copy; Copyright {{ date('Y') }} Apollo Deployment</p>
                    </div>
                </div>
            </div>
        </footer>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')
    </body>
</html>
