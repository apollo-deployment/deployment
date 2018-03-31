@extends('layouts.base')

@section('content')
    <div class="deployment-plans">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Plan</th>
                            </tr>
                        </thead>
                        @forelse (\App\Models\Project::all() as $project)
                            <tbody>
                                @forelse ($project->deploymentPlans as $plan)
                                    <tr>
                                        <td class="project-name">{{ $loop->first ? $project->name : '&nbsp;' }}</td>
                                        <td>{{ $plan->name }}</td>
                                    </tr>
                                @empty
                                    <tr class="empty">
                                        <td class="project-name">{{ $project->name }}</td>
                                        <td colspan="100">No plans found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        @empty
                            <tbody>
                                <tr>
                                    <td colspan="100">No projects found</td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection