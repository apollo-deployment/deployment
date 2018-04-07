<!DOCTYPE html>
<html>
<head>
    <title>Create</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('projects') }}">Project Create</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('projects') }}">View All Projects</a></li>
            <li><a href="{{ URL::to('projects/create') }}">Create a Project</a>
        </ul>
    </nav>

    <h1>Create a Project</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::open(array('url' => 'projects')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('repository_url', 'Repository URL') }}
        {{ Form::text('repository_url', old('repository_url'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Project!', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}

</div>
</body>
</html>