
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', 'Title', ['class' => 'required']) }}
            {{ Form::text('title', isset($environment) ? $environment->title : '', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Production Server']) }}
        </div>
        @if ($errors->first('title'))
            <p class="message-error">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ip_address', 'Host Address', ['class' => 'required']) }}
            {{ Form::text('ip_address', isset($environment) ? $environment->ip_address : '', ['class' => 'form-control', 'required' => true, 'placeholder' => '255.255.255.254']) }}
        </div>
        @if ($errors->first('ip_address'))
            <p class="message-error">{{ $errors->first('ip_address') }}</p>
        @endif
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ssh_port', 'SSH Port', ['class' => 'required']) }}
            {{ Form::number('ssh_port', isset($environment) ? $environment->ssh_port : 22, ['class' => 'form-control', 'required' => true, 'min' => 1, 'max' => 65535]) }}
        </div>
        @if ($errors->first('ssh_port'))
            <p class="message-error">{{ $errors->first('ssh_port') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('authentication_type', 'Authentication Type', ['class' => 'required']) }}
            {{ Form::select('authentication_type', ['password' => 'Password', 'public_key' => 'Public Key'], isset($environment) ? $environment->authenication_type : 'password', ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if ($errors->first('authentication_type'))
            <p class="message-error">{{ $errors->first('authentication_type') }}</p>
        @endif
    </div>
    <div class="col-md-4" id="ssh_password">
        <div class="form-group">
            {{ Form::label('ssh_password', isset($environment) ? 'Update SSH Password' : 'SSH Password', ['class' => 'required']) }}
            {{ Form::password('ssh_password', ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if ($errors->first('ssh_password'))
            <p class="message-error">{{ $errors->first('ssh_password') }}</p>
        @endif
    </div>
    <div class="col-md-8" id="public_key" style="display: {{ $errors->first('public_key') ? 'inline-block' : 'none' }}">
        <div class="form-group">
            <label class="file btn">
                Upload Key
                {{ Form::file('public_key', null, ['class' => 'form-control']) }}
            </label>
        </div>
        <p class="file-uploaded secondary-text"></p>
        @if ($errors->first('public_key'))
            <p class="message-error">{{ $errors->first('public_key') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {{ Form::submit(isset($project) ? 'Update' : 'Create', ['class' => 'btn']) }}
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        // Hide/show section on login selection
        $('[name="authentication_type"]').on('change', function() {
            if (this.value == 'password') {
                $('#ssh_password').show();
                $('[name="ssh_password"]').prop('required', true);
                $('#public_key').hide();
                $('[name="public_key"]').prop('required', false);
            } else {
                $('#public_key').show();
                $('[name="public_key"]').prop('required', true);
                $('#ssh_password').hide();
                $('[name="ssh_password"]').prop('required', false);
            }
        });

        $('[name="public_key"]').change(function(){
            $('.file-uploaded').text($('[name="public_key"]')[0].files[0].name);
        });
    </script>
@endsection
