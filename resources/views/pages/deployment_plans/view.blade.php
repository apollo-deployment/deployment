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
                        @forelse (\App\Models\Environment::all() as $environment)
                            <tbody>
                                @forelse ($environment->deploymentPlans as $plan)
                                    <tr>
                                        <td class="environment-name">{{ $loop->first ? $environment->title : '&nbsp;' }}</td>
                                        <td>{{ $plan->title }}</td>
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
                                    <tr>
                                        <td class="project-name">{{ $environment->name }}</td>
                                        <td colspan="100">No deployment plans found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        @empty
                            <tbody>
                                <tr class="empty">
                                    <td colspan="100">No environments found</td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection