@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')

            <table class="table">
                <thead>
                    <tr>
                        <th>Repository</th>
                        <th>Plan</th>
                        <th>Environment</th>
                        <th>Deployed Build</th>
                        <th>Deployed Branch</th>
                        <th>
                            <a href="{{ route('create.deployment-plan') }}" class="btn">Create</a>
                        </th>
                    </tr>
                </thead>
                @forelse($repositories as $repository)
                    <tbody>
                        @forelse($repository->deploymentPlans as $plan)
                            <tr>
                                <td class="repository-name">
                                    {{ $loop->first ? $repository->title : '' }}
                                    <img src="{{ url('/images/building.gif') }}" class="building build-{{ $plan->id }}">
                                </td>
                                <td>{{ $plan->title }}</td>
                                <td>{{ $plan->environment->title }}</td>
                                @if($plan->status === 'ready')
                                    <td class="green" colspan="2">Ready</td>
                                @elseif(isset($plan->deployed_version))
                                    <td>{{ $plan->deployed_version }}</td>
                                    <td>{{ $plan->repository_branch }}</td>
                                @else
                                    <td class="yellow" colspan="2">Not Deployed</td>
                                @endif
                                <td>
                                    <button data-toggle="modal" data-target="#delete-deployment-plan-{{ $plan->id }}">
                                        <i class="fa fa-trash action"></i>
                                    </button>
                                    <a href="{{ route('edit.deployment-plan', compact('plan')) }}">
                                        <i class="fa fa-cog action"></i>
                                    </a>
                                    @if($plan->status === 'ready')
                                        <a href="">
                                            <i class="fa fa-cloud-upload action"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @include('partials.delete-deployment-plan-modal', compact('plan'))
                        @empty
                            <tr>
                                <td class="environment-name">{{ $repository->title }}</td>
                                <td colspan="100">No deployment plans found</td>
                            </tr>
                        @endforelse
                    </tbody>
                @empty
                    <tbody>
                        <tr class="empty">
                            <td colspan="100">No deployment plans found</td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // Listens on organizations build channel
        Echo.channel(@json('deployment-channel.' . \Auth::user()->organization->id)).listen('BuildEvent', (e) => {
            var deployment_plan = e.deployment_plan;

            if (deployment_plan.status === 'in_progress') {
                $(".build-" + deployment_plan.id).show();
            } else {
                $(".build-" + deployment_plan.id).hide();
            }
        });
    </script>
@endsection

