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
                    <form action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => true]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => true]) }}
                        </div>
                        @if ($errors->first('login'))
                            <p class="message-error">{{ $errors->first('login') }}</p>
                        @endif
                        {{ Form::submit('Login', ['class' => 'btn']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection