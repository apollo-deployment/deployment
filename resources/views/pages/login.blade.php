@extends('layouts.base')

@section('content')
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-logo">
                        <img src="/images/apollo-logo.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                        <button class="btn" type="submit">Login</button>
                        <a class="btn g-login" href="{{ route('login.google') }}">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection