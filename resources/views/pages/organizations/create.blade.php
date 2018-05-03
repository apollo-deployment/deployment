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
                <div class="col-md-6 col-md-offset-3 panel">
                    <h3 class="text-center">Create an Organization</h3>
                    <p class="secondary-text text-center">Create a new admin account for your new organization</p>

                    @include('partials.message')

                    <form action="{{ route('register.org') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'Full Name') }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => true]) }}
                                </div>
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
                        </div>
                        {{ Form::submit('Create', ['class' => 'btn']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection