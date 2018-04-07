@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Create Project</p>
                </div>
            </div>
        </div>
        <form action="{{ route('store.project') }}" method="POST">
            @include('pages.projects._form')
        </form>
    </div>
@endsection