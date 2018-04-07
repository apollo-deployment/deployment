@extends('layouts.base')

@section('content')
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('projects') }}">Projects</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('projects') }}">View All Projects</a></li>
                <li><a href="{{ URL::to('projects/create') }}">Create a Project</a>
            </ul>
        </nav>

        <h1>All Projects</h1>

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
                @forelse(\App\Models\Project::all() as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->repository_url }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>
                            <!-- delete the project (uses the destroy method DESTROY /projects/{id} -->
                        {{ Form::open(array('url' => 'projects/' . $project->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete this Project', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}

                        <!-- show the project (uses the show method found at GET /projects/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('projects/' . $project->id) }}">Show this
                                project</a>

                            <!-- edit this project (uses the edit method found at GET /projects/{id}/edit -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('projects/' . $project->id . '/edit') }}">Edit
                                this project</a>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-warning">
                        You have not created a project yet. <a href="{{ URL::to('projects/create') }}">Please Create a New Project.</a>
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

