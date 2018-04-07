
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="project_name">Project Name</label>
            {{ Form::text('project_name', isset($project) ? $project->name : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="repository_url">Repository URL</label>
            {{ Form::text('repository_url', isset($project) ? $project->repository_url : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
</div>

{{ Form::submit(isset($project) ? 'Update' : 'Create', ['class' => 'btn']) }}