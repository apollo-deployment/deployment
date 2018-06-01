@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <p><i class="fa fa-wrench"></i> Create Deployment Plan</p>
            </div>
        </div>
    </div>
    <form action="{{ route('store.deployment-plan') }}" method="POST">
        @include('pages.deployment_plans._form')
    </form>
@endsection