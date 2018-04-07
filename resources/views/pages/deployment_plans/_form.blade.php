
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', isset($plan) ? $plan->name : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('project_branch', 'Project Branch') }}
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
            {{ Form::label('project_id', 'Project') }}
            {{ Form::select('project_id', \App\Models\Project::pluck('name', 'id'), isset($plan) ? $plan->project->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('web_server_id', 'Web Server') }}
            {{ Form::select('web_server_id', \App\Models\WebServer::pluck('name', 'id'), isset($plan) ? $plan->webServer->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('storage_path', 'Code Storage Path') }}
            {{ Form::text('storage_path', isset($plan) ? $plan->storage_path : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('update_seconds', 'Update Seconds') }}
            {{ Form::number('update_seconds', isset($plan) ? $plan->update_seconds : 60, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

{{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn']) }}