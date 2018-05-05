@extends('layouts.base')

@section('content')
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-2">

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 panel">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="header">
                                <p>Update Profile</p>
                            </div>
                            <p class="secondary-text">Basic profile information</p>
                        </div>
                        <div class="col-md-2">
                            @if (\Auth::user()->github_access_token)
                                <p class="secondary-text text-right"><i class="fa fa-check green"></i> Github Linked</p>
                            @else
                                <a href="{{ route('github.access') }}" class="btn">Link GitHub</a>
                            @endif
                        </div>
                    </div>

                    @include('partials.message')

                    <form action="{{ route('update.profile') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'Full Name') }}
                                    {{ Form::text('name', Auth::user()->name, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                                @if ($errors->first('name'))
                                    <p class="message-error">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email', Auth::user()->email, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                                @if ($errors->first('email'))
                                    <p class="message-error">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        {{ Form::submit('Update', ['class' => 'btn']) }}
                    </form>
                </div>
            </div>

            {{-- Check in case Google OAuth was used --}}
            @if (\Auth::user()->password)
                <div class="row">
                    <div class="col-md-12 panel">
                        <div class="header">
                            <p>Change Password</p>
                        </div>
                        <p class="secondary-text">Must be at least 8 characters in length</p>

                        @if (session()->has('message-password'))
                            <div class="message-success">{{ session()->get('message-password') }}</div>
                        @endif

                        <form action="{{ route('update.password') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('current_password', 'Current Password') }}
                                        {{ Form::password('current_password', ['class' => 'form-control', 'required' => true]) }}
                                    </div>
                                    @if ($errors->first('current_password'))
                                        <p class="message-error">{{ $errors->first('current_password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('password', 'New Password') }}
                                        {{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
                                    </div>
                                    @if ($errors->first('password'))
                                        <p class="message-error">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation', 'Confirm Password') }}
                                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit('Update', ['class' => 'btn']) }}
                        </form>
                    </div>
                </div>
            @endif

            @if (\Auth::user()->is_admin)
                <div class="row">
                    <div class="col-md-12 panel">
                        <div class="header">
                            <p>{{ \Auth::user()->organization->title }}</p>
                        </div>
                        <p class="secondary-text">Admin view only</p>

                        {{-- Content tabs --}}
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a href="#admins" class="nav-link" aria-controls="admins" data-toggle="tab">Admins</a>
                            </li>
                            <li class="nav-item">
                                <a href="#users" class="nav-link" aria-controls="users" data-toggle="tab">Users</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="active tab-pane" role="tabpanel" id="admins">
                                <p class="secondary-text">a</p>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="users">
                                <p class="secondary-text">u</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

