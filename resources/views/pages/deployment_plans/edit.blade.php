@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <p>Update {{ $plan->title }} <code>{{ $plan->repository_branch }}</code></p>
            </div>
        </div>
    </div>
    <form action="{{ route('update.deployment-plan', compact('plan')) }}" method="POST" enctype="multipart/form-data">
        @include('pages.deployment_plans._form', compact('plan'))
    </form>
@endsection