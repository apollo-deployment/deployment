@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Update {{ $repository->title }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('update.repository', compact('repository')) }}" method="POST">
            @include('pages.repositories._form', compact('repository'))
        </form>
    </div>
@endsection