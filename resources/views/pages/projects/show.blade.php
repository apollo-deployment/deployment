<!DOCTYPE html>
<html>
<head>
    <title>Show</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('projects') }}">Show Project</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('projects') }}">View All Projects</a></li>
            <li><a href="{{ URL::to('projects/create') }}">Create a Project</a>
        </ul>
    </nav>

    <h1>Showing  <small>ID:{{$project->id}} </small> The {{ $project->name }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $project->name }}</h2>

        <p>
            <strong>Repository URL:</strong> {{ $project->repository_url }}<br>
        </p>
        <p>
            <strong>Created at:</strong> {{ \Carbon\Carbon::parse($project->created_at)->toDayDateTimeString()}}<br>
        </p>
        <p>
            <strong>Updated at:</strong> {{ \Carbon\Carbon::parse($project->updated_at)->toDayDateTimeString()}}<br>
        </p>
    </div>

</div>
</body>
</html>