@extends('layouts.base')

@section('content')
    <div class="profile">
        <div class="row m-b-10">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header">
                            <p><i class="fa fa-user"></i> Profile & Settings</p>
                        </div>
                    </div>
                </div>
                @include('partials.message')

                <form action="{{ route('update.profile') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="avatar-container">
                                @if (\Auth::user()->avatar)
                                    <img src="{{ url('/images/avatars/' . \Auth::user()->avatar) }}" class="avatar profile" id="avatar">
                                @else
                                    <img src="{{ url('/images/avatars/default.png') }}" class="avatar profile" id="avatar">
                                @endif
                                <i class="fa fa-camera"></i>
                                <input type="file" name="avatar_upload" id="avatar-upload">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                {{ Form::label('name', 'Full Name') }}
                                {{ Form::text('name', Auth::user()->name, ['class' => 'form-control', 'required' => true]) }}
                            </div>
                            @if ($errors->first('name'))
                                <p class="message-error">{{ $errors->first('name') }}</p>
                            @endif
                            <div class="form-group">
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email', Auth::user()->email, ['class' => 'form-control', 'required' => true]) }}
                            </div>
                            @if ($errors->first('email'))
                                <p class="message-error">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="col-md-5">
                            @if (\Auth::user()->github_access_token)
                                <p class="secondary-text text-right"><i class="fa fa-check green"></i> Github Linked</p>
                            @else
                                <a href="{{ route('github.access') }}" class="btn">Link GitHub</a>
                            @endif
                        </div>
                    </div>
                    {{ Form::submit('Update', ['class' => 'btn']) }}
                    @if (\Auth::user()->password)
                        {{ Form::button('Change Password', ['class' => 'btn change-password', 'data-toggle' => 'collapse', 'data-target' => '#change-password']) }}
                    @endif
                </form>
            </div>
        </div>

        {{-- Check in case Google OAuth was used --}}
        @if (\Auth::user()->password)
            <div class="collapse" id="change-password">
                <div class="row m-b-10">
                    <div class="col-md-12">
                        <div class="header split">
                            <p><i class="fa fa-lock"></i> Change Password</p>
                        </div>

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
                                        {{ Form::password('password', ['class' => 'form-control', 'required' => true, 'oninput="confirmPassword()"']) }}
                                        <p class="red" id="password-helper"></p>
                                    </div>
                                    @if ($errors->first('password'))
                                        <p class="message-error">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation', 'Confirm New Password') }}
                                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => true, 'oninput="confirmPassword()"']) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit('Update', ['class' => 'btn', 'id' => 'password-btn']) }}
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if (\Auth::user()->is_admin)
            <div class="row">
                <div class="col-md-12">
                    <div class="header split">
                        <p><i class="fa fa-cogs"></i> {{ \Auth::user()->organization->title }} Admin</p>
                    </div>

                    {{-- Content tabs --}}
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a href="#stats" class="nav-link" aria-controls="stats" data-toggle="tab">Stats</a>
                        </li>
                        <li class="nav-item">
                            <a href="#users" class="nav-link" aria-controls="users" data-toggle="tab">Users</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="stats">

                        </div>
                        <div class="tab-pane" role="tabpanel" id="users">
                            <table class="table">
                                <tbody>
                                @forelse (\Auth::user()->organization->users() as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                            @if (! $user->is_verified)
                                                <code>Not Verified</code>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->is_admin ? 'Admin' : 'Developer' }}</td>
                                        <td>
                                            <button data-toggle="modal" data-target="#{{ $user->id }}">
                                                <i class="fa fa-trash action"></i>
                                            </button>
                                            <a href="">
                                                <i class="fa fa-cog secondary-text action"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty">
                                        <td colspan="100">No users found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        $('.avatar-container i').click(function() {
            $('#avatar-upload').click();
        });

        $('[name="avatar_upload"]').change(function() {
            var form_data = new FormData();
            form_data.append('avatar_upload', $('[name="avatar_upload"]').prop('files')[0]);

            $.ajax({
                url: '/profile/update-avatar',
                type: 'POST',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.avatar').attr('src', data);
                }
            });
        });

        function confirmPassword() {
            var $pass = $("[name='password']").val();
            var $pass_confirm = $("[name='password_confirmation']").val();

            if ($pass !== '' && $pass_confirm !== '') {
                if ($pass !== $pass_confirm) {
                    $('#password-helper').html('Passwords do not match');
                    $('#password-btn').prop('disabled', true);
                } else if ($pass.length < 8) {
                    $('#password-helper').html('New passwords must be at least 8 characters');
                    $('#password-btn').prop('disabled', true);
                } else {
                    $('#password-helper').html('');
                    $('#password-btn').prop('disabled', false);
                }
            }
        }
    </script>
@endsection