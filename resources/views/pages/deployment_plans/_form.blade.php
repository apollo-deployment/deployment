
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', 'Title', ['class' => 'required']) }}
            {{ Form::text('title', isset($plan) ? $plan->title : null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'ACME Production']) }}
        </div>
        @if ($errors->first('title'))
            <p class="message-error">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('repository_id', 'Repository', ['class' => 'required']) }}
            {{ Form::select('repository_id', ['' => ''] + \App\Models\Repository::pluck('name', 'id')->toArray(), isset($plan) ? $plan->repository->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if ($errors->first('repository_id'))
            <p class="message-error">{{ $errors->first('repository_id') }}</p>
        @endif
    </div>
</div>

<div id="hide" style="display: none">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('repository_branch', 'Repository Branch', ['class' => 'required']) }}
                {{ Form::select('repository_branch', ['' => ''], isset($plan) ? $plan->repository_branch : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
            @if ($errors->first('repository_branch'))
                <p class="message-error">{{ $errors->first('repository_branch') }}</p>
            @endif
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('environment_id', 'Environment', ['class' => 'required']) }}
                {{ Form::select('environment_id', \App\Models\Environment::pluck('title', 'id'), isset($plan) ? $plan->environment->id : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
            @if ($errors->first('environment_id'))
                <p class="message-error">{{ $errors->first('environment_id') }}</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('remote_path', 'Remote Server Path', ['class' => 'required']) }}
                {{ Form::text('remote_path', isset($plan) ? $plan->remote_path : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
            @if ($errors->first('remote_path'))
                <p class="message-error">{{ $errors->first('remote_path') }}</p>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn']) }}
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        // Hide/show section on project selection
        $('[name="repository_id"]').on('change', function() {
            if (this.value) {
                $('#hide').show();
                $('[name="repository_branch"]').empty();

                // Gets all branches for the selected project
                $.ajax({
                    method: 'GET',
                    url: '/github/branches',
                    data: {'repository_id' : this.value},
                    success: function(branches) {
                        // Add new option for every branch
                        $.each(branches, function(key, branch) {
                            $('[name="repository_branch"]').append($('<option>', {
                                value: branch.name,
                                text: branch.name
                            }));
                        });
                    }
                });
            } else {
                $('#hide').hide();
            }
        })
    </script>
@endsection