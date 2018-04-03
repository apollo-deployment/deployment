@extends('layouts.base')

@section('content')
    <div class="deployment-plans">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="header">
                        <p>Deployment Plans</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('create.deployment-plan') }}" class="btn">Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('partials.message')

                    <table>
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Plan</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        @forelse (\App\Models\Project::all() as $project)
                            <tbody>
                                @forelse ($project->deploymentPlans as $plan)
                                    <tr>
                                        <td class="project-name">{{ $loop->first ? $project->name : '&nbsp;' }}</td>
                                        <td>{{ $plan->name }}</td>
                                        <td>
                                            <button data-toggle="modal" data-target="#delete-deployment-plan-{{ $plan->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a href="{{ route('edit.deployment-plan', compact('plan')) }}">
                                                <i class="fa fa-cog"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @include('partials.delete-deployment-plan-modal', compact('plan'))
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