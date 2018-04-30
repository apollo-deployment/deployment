@extends('layouts.base')

@section('content')
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-logo">
                        <img src="/images/apollo-logo.png">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 panel">
                    <form action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', null, ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        @if ($errors->any())
                            <p class="red">{{ $errors->first() }}</p>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group checkbox">
                                    <label for="remember_me">
                                        {{ Form::checkbox('remember_me', true, null, ['class' => '']) }} Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{ Form::submit('Login', ['class' => 'btn']) }}
                                <a href="{{ route('login.google') }}" class="btn g-btn">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <a href="" class="secondary-text">Register new organization</a>
                </div>
            </div>
        </div>
    </div>
@endsection