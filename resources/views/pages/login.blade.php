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
                            <p class="message-error">{{ $errors->first() }}</p>
                        @endif
                        {{ Form::submit('Login', ['class' => 'btn']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection