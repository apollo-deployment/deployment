<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Apollo</title>

        {{-- Styles --}}
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        @yield('styles')
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="logo">
                            <a href="{{ route('view.index') }}">Apollo</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('view.deployment-plans') }}">Deployment</a>
                            </li>
                            <li>
                                <a href="{{ route('view.web-servers') }}">Web Servers</a>
                            </li>
                            <li>
                                <a href="{{ route('view.projects') }}">Projects</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')
    </body>
</html>
