<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('projects') }}">Projects Alert</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('projects') }}">View All Projects</a></li>
            <li><a href="{{ URL::to('projects/create') }}">Create a Project</a>
        </ul>
    </nav>

    <h1>All the Projects</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Repository URL</td>
            <td>Created At</td>
            <td>Updated At</td>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr>
                <td>id: {{ $project->id }}</td>
                <td>name: {{ $project->name }}</td>
                <td>repo url:{{ $project->repository_url }}</td>
                <td>created at: {{ $project->created_at }}</td>
                <td>updated at: {{ $project->updated_at }}</td>

                <td>

                    <!-- delete the project (uses the destroy method DESTROY /projects/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('projects/' . $project->id) }}">Show this
                        Project</a>

                    <!-- edit this nerd (uses the edit method found at GET /projects/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('projects/' . $project->id . '/edit') }}">Edit this
                        Project</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>