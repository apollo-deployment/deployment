
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', isset($plan) ? $plan->name : null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Production Deployment']) }}
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('project_id', 'Project') }}
            {{ Form::select('project_id', ['' => ''] + \App\Models\Project::pluck('name', 'id')->toArray(), isset($plan) ? $plan->project->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-2">
        {{-- shows some stats or editing environment file? --}}
    </div>
</div>

<div id="hide" style="display: none">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('project_branch', 'Project Branch') }}
                {{ Form::select('project_branch', ['' => ''], isset($plan) ? $plan->project_branch : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('web_server_id', 'Web Server') }}
                {{ Form::select('web_server_id', \App\Models\WebServer::pluck('name', 'id'), isset($plan) ? $plan->webServer->id : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('storage_path', 'Remote Server Path') }}
                {{ Form::text('storage_path', isset($plan) ? $plan->storage_path : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('update_seconds', 'Update Refresh') }}
                {{ Form::number('update_seconds', isset($plan) ? $plan->update_seconds : 15, ['class' => 'form-control', 'min' => 15]) }}
            </div>
        </div>
    </div>
</div>

{{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn']) }}

@section('scripts')
    <script type="text/javascript">
        // Hide/show section on project selection
        $('[name="project_id"]').on('change', function() {
            if (this.value) {
                $('#hide').show();
                $('[name="project_branch"]').empty();

                // Gets all branches for the selected project
                $.ajax({
                    method: 'GET',
                    url: '/github/branches',
                    data: {'project_id' : this.value},
                    success: function(branches) {
                        // Add new option for every branch
                        $.each(branches, function(key, branch) {
                            $('[name="project_branch"]').append($('<option>', {
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