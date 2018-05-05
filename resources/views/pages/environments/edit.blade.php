@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Update {{ $environment->title }}</p>
                </div>
            </div>
        </div>
        <div class="panel">
            <form action="{{ route('update.environment', compact('environment')) }}" method="POST">
                @include('pages.environments._form', compact('environmentr'))
            </form>
        </div>
    </div>
@endsection