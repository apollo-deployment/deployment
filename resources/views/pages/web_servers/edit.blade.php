@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Update {{ $web_server->name }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('update.web_server', compact('web_server')) }}" method="POST">
            @include('pages.web_servers._form', compact('web_server'))
        </form>
    </div>
@endsection