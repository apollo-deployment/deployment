@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Create Environment</p>
                </div>
            </div>
        </div>
        <form action="{{ route('store.environment') }}" method="POST">
            @include('pages.environments._form')
        </form>
    </div>
@endsection