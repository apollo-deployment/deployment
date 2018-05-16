@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <p><i class="fa fa-wrench"></i> Update {{ $plan->title }} <code>{{ $plan->repository_branch }}</code></p>
            </div>
        </div>
    </div>
    <form action="{{ route('update.deployment-plan', compact('plan')) }}" method="POST">
        @include('pages.deployment_plans._form', compact('plan'))
    </form>
@endsection