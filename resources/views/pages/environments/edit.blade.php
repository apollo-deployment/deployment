@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <p>Update {{ $environment->title }}</p>
            </div>
        </div>
    </div>
    <form action="{{ route('update.environment', compact('environment')) }}" method="POST">
        @include('pages.environments._form', compact('environmentr'))
    </form>
@endsection