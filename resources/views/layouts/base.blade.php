<!DOCTYPE html>
<html>
    <head>
        <title>Apollo</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Styles --}}
        <link type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">

        @stack('styles')
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
                                <div class="dropdown-menu pull-right">
                                    <a class="dropdown-item" href="{{ route('view.profile') }}">
                                        <i class="fa fa-cog accent"></i> Settings
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
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @auth
            <script type="text/javascript">
                // Toast notifications config
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "5000",
                    "hideDuration": "5000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                // Listens on organizations build channel
                Echo.channel(@json('deployment-channel.' . \Auth::user()->organization->id)).listen('BuildEvent', (e) => {
                    var deployment_plan = e.deployment_plan;
                    console.log(deployment_plan)

                    if (deployment_plan.status === 'in_progress') {
                        if ($(".build-" + deployment_plan.id).length !== 0) {
                            $(".build-" + deployment_plan.id).show();
                        }
                    } else if (deployment_plan.status === 'ready') {
                        toastr.success(deployment_plan.title + " is ready to deploy");
                    } else {
                        if ($(".build-" + deployment_plan.id).length !== 0) {
                            $(".build-" + deployment_plan.id).hide();
                        }
                        toastr.success(deployment_plan.title + " successfully deployed");
                    }
                });
            </script>
        @endauth

        @stack('scripts')
    </body>
</html>
