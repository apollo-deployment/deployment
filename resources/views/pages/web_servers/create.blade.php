@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Create Web Server</p>
                </div>
            </div>
        </div>
        <form action="{{ route('store.web_server') }}" method="POST">
            @include('pages.web_servers._form')
        </form>
    </div>
@endsection