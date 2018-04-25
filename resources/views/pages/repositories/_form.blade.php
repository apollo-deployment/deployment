
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Project Name') }}
            {{ Form::text('name', isset($repository) ? $repository->name : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('url', 'Repository URL') }}
            {{ Form::text('url', isset($repository) ? $repository->url : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
</div>

{{ Form::submit(isset($repository) ? 'Update' : 'Create', ['class' => 'btn']) }}

