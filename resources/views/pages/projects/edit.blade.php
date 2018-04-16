@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Update {{ $project->name }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('update.project', compact('project')) }}" method="POST">
            @include('pages.projects._form', compact('project'))
        </form>
    </div>
@endsection