
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Production Server']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ip_address', 'Host Address') }}
            {{ Form::text('ip_address', null, ['class' => 'form-control', 'required' => true, 'placeholder' => '255.255.255.254']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('ssh_port', 'SSH Port') }}
            {{ Form::number('ssh_port', 22, ['class' => 'form-control', 'required' => true, 'min' => 1, 'max' => 65535]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('authentication_type', 'Authentication Type') }}
            {{ Form::select('authentication_type', ['password' => 'Password', 'private_key' => 'Private Key'], 'password', ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4" id="ssh_password">
        <div class="form-group">
            {{ Form::label('ssh_password', 'SSH Password') }}
            {{ Form::text('ssh_password', null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-8" id="private_key" style="display: none">
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
                $('#private_key').hide();
                $('[name="private_key"]').prop('required', false);
            } else {
                $('#private_key').show();
                $('[name="private_key"]').prop('required', true);
                $('#ssh_password').hide();
                $('[name="ssh_password"]').prop('required', false);
            }
        });

        $('[name="private_key"]').change(function(){
            $('.file-uploaded').text($('[name="private_key"]')[0].files[0].name);
        });
    </script>
@endsection
