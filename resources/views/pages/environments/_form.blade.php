
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', 'Title', ['class' => 'required']) }}
            {{ Form::text('title', isset($environment) ? $environment->title : '', ['class' => 'form-control', 'required' => true, 'autofocus', 'placeholder' => 'Production Server']) }}
        </div>
        @if($errors->first('title'))
            <p class="red">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ip_address', 'Host Address', ['class' => 'required']) }}
            {{ Form::text('ip_address', isset($environment) ? $environment->ip_address : '', ['class' => 'form-control', 'required' => true, 'placeholder' => '255.255.255.254']) }}
        </div>
        @if($errors->first('ip_address'))
            <p class="red">{{ $errors->first('ip_address') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ssh_port', 'SSH Port', ['class' => 'required']) }}
            {{ Form::number('ssh_port', isset($environment) ? $environment->ssh_port : 22, ['class' => 'form-control', 'required' => true, 'min' => 1, 'max' => 65535]) }}
        </div>
        @if($errors->first('ssh_port'))
            <p class="red">{{ $errors->first('ssh_port') }}</p>
        @endif
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ssh_username', 'SSH Username', ['class' => 'required']) }}
            {{ Form::text('ssh_username', isset($environment) ? $environment->ssh_username : '', ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if($errors->first('ssh_username'))
            <p class="red">{{ $errors->first('ssh_username') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('authentication_type', 'Authentication Type', ['class' => 'required']) }}
            {{ Form::select('authentication_type', ['password' => 'Password', 'private_key' => 'Private Key'], isset($environment) ? $environment->authentication_type : 'password', ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if($errors->first('authentication_type'))
            <p class="red">{{ $errors->first('authentication_type') }}</p>
        @endif
    </div>
    <div class="col-md-4" id="ssh_password">
        <div class="form-group">
            {{ Form::label('ssh_password', isset($environment) ? 'Update SSH Password' : 'SSH Password', ['class' => 'required']) }}
            {{ Form::password('ssh_password', ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if($errors->first('ssh_password'))
            <p class="red">{{ $errors->first('ssh_password') }}</p>
        @endif
    </div>
    <div class="col-md-8" id="private_key" style="display: {{ $errors->first('private_key') ? 'inline-block' : 'none' }}">
        <div class="form-group">
            <label class="file btn">
                Upload Key
                {{ Form::file('private_key') }}
            </label>
        </div>
        <p class="file-uploaded secondary-text">{{ isset($environment) ? 'Change Key' : '' }}</p>
        @if($errors->first('private_key'))
            <p class="red">{{ $errors->first('private_key') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        {{ Form::submit(isset($environment) ? 'Update' : 'Create', ['class' => 'btn']) }}
        <a href="{{ route('view.environments') }}" class="btn cancel">Cancel</a>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">
        if (@json(isset($environment) && $environment->private_key_path)) {
            $('#ssh_password').hide();
            $('#private_key').show();
        }

        // Hide/show section on login selection
        $('[name="authentication_type"]').on('change', function() {
            if (this.value == 'password') {
                $('#ssh_password').show();
                $('[name="ssh_password"]').prop('required', true);
                $('#private_key').hide();
                $('[name="private_key"]').prop('required', false);
            } else {
                $('#private_key').show();
                $('[name="private_key"]').prop('required', true);
                $('#ssh_password').hide();
                $('[name="ssh_password"]').prop('required', false);
            }
        });

        $('[name="private_key"]').change(function() {
            $('.file-uploaded').text($('[name="private_key"]')[0].files[0].name);
        });
    </script>
@endsection
