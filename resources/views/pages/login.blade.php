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
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => true]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password', 'required' => true]) }}
                        </div>
                        <button class="btn" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection