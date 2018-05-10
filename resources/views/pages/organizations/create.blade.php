@extends('layouts.base')

@section('content')
    <div class="register">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-logo">
                        <img src="/images/apollo-logo.png">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h3 class="text-center">Create an Organization</h3>
                    <p class="secondary-text text-center">Create an admin account for your new organization</p>

                    @if (session()->has('message'))
                        <div class="alert message-success">
                            {{ session()->get('message') }}
                            <a class="close secondary-text" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif

                    <form action="{{ route('register.org') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('title', 'Organization Name') }}
                                    {{ Form::text('title', null, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                                @if ($errors->first('title'))
                                    <p class="red">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'Full Name') }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                                @if ($errors->first('name'))
                                    <p class="red">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                                @if ($errors->first('email'))
                                    <p class="red">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('password', 'Admin Password') }}
                                    {{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('password_confirmation', 'Confirm Password') }}
                                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                            @if ($errors->first('password'))
                                <div class="col-md-12">
                                    <p class="red">{{ $errors->first('password') }}</p>
                                </div>
                            @endif
                        </div>
                        {{ Form::submit('Create', ['class' => 'btn']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection