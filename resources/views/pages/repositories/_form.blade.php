
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', 'Name', ['class' => 'required']) }}
            {{ Form::text('title', isset($repository) ? $repository->title : null, ['class' => 'form-control', 'required' => true, 'autofocus']) }}
        </div>
        @if($errors->first('title'))
            <p class="red">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('url', 'Repository URL', ['class' => 'required']) }}
            {{ Form::text('url', isset($repository) ? $repository->url : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if($errors->first('url'))
            <p class="red">{{ $errors->first('url') }}</p>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {{ Form::submit(isset($repository) ? 'Update' : 'Create', ['class' => 'btn']) }}
    </div>
</div>
