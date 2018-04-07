@extends('layouts.base')

@section('content')
    <div class="projects">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="header">
                        <p>Projects</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('create.project') }}" class="btn">Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('partials.message')

                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Repository URL</td>
                                <td>Created At</td>
                                <td>Updated At</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse (\App\Models\Project::all() as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->repository_url }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td>{{ $project->updated_at }}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#delete-project-{{ $project->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a href="{{ route('edit.project', compact('project')) }}">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('partials.delete-project-modal', compact('project'))
                        @empty
                            <tr class="empty">
                                <td colspan="100">You have not created a project yet. <a href="{{ route('create.project') }}">Please create a new project.</a></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

