<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('projects') }}">Show Projects</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('projects') }}">View All Projects</a></li>
            <li><a href="{{ URL::to('projects/create') }}">Create a Project</a>
        </ul>
    </nav>

    <h1>Edit {{ $project->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('repository_url', 'Repository URL') }}
        {{ Form::text('repository_url', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Project!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
</body>
</html>