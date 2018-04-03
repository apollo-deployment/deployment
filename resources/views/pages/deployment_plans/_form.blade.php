
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Name</label>
            {{ Form::text('name', isset($plan) ? $plan->name : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="project_branch">Project Branch</label>
            {{ Form::text('project_branch', isset($plan) ? $plan->project_branch : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        {{-- shows some stats or editing environment file? --}}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="project_id">Project</label>
            {{ Form::select('project_id', \App\Models\Project::pluck('name', 'id'), isset($plan) ? $plan->project->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="web_server_id">Web Server</label>
            {{ Form::select('web_server_id', \App\Models\WebServer::pluck('name', 'id'), isset($plan) ? $plan->webServer->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="storage_path">Code Storage Path</label>
            {{ Form::text('storage_path', isset($plan) ? $plan->storage_path : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="update_seconds">Update Seconds</label>
            {{ Form::number('update_seconds', isset($plan) ? $plan->update_seconds : 60, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

{{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn']) }}