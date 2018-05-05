@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Create Deployment Plan</p>
                </div>
            </div>
        </div>
        <form action="{{ route('store.deployment-plan') }}" method="POST" enctype="multipart/form-data">
            @include('pages.deployment_plans._form')
        </form>
    </div>
@endsection