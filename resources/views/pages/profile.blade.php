@extends('layouts.base')

@section('content')
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="header">
                        <p>Update Profile</p>
                    </div>
                </div>
                <div class="col-md-2">
                    @if (Auth::user()->access_token)
                        <p class="accent text-right">Github Linked</p>
                    @else
                        <a href="{{ route('github.access') }}" class="btn">Link GitHub</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('partials.message')

                    <form action="" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('name', 'Name') }}
                                    {{ Form::text('name', Auth::user()->name, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email', Auth::user()->email, ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('password', 'Current Password') }}
                                    {{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('new_password', 'New Password') }}
                                    {{ Form::password('new_password', ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('confirm_password', 'Confirm Password') }}
                                    {{ Form::password('confirm_password', ['class' => 'form-control', 'required' => true]) }}
                                </div>
                            </div>
                        </div>
                        {{ Form::submit('Update', ['class' => 'btn']) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

