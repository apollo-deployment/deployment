
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', isset($environment) ? $environment->name : '', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Production Server']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ip_address', 'Host Address') }}
            {{ Form::text('ip_address', isset($environment) ? $environment->ip_address : '', ['class' => 'form-control', 'required' => true, 'placeholder' => '255.255.255.254']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ssh_port', 'SSH Port') }}
            {{ Form::number('ssh_port', isset($environment) ? $environment->ssh_port : 22, ['class' => 'form-control', 'required' => true, 'min' => 1, 'max' => 65535]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('authentication_type', 'Authentication Type') }}
            {{ Form::select('authentication_type', ['password' => 'Password', 'private_key' => 'Private Key'], isset($environment) ? $environment->authenication_type : 'password', ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4" id="ssh_password">
        <div class="form-group">
            {{ Form::label('ssh_password', isset($environment) ? 'Update SSH Password' : 'SSH Password') }}
            {{ Form::password('ssh_password', ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-8" id="public_key" style="display: none">
        <div class="form-group">
            <label class="file btn">
                Upload Key
                {{ Form::file('private_key', null, ['class' => 'form-control']) }}
            </label>
        </div>
        <p class="file-uploaded"></p>
    </div>
</div>

{{ Form::submit(isset($project) ? 'Update' : 'Create', ['class' => 'btn']) }}

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
                $('#private_key').show();
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
