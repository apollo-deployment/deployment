@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p>Create Repository</p>
                </div>
            </div>
        </div>
        <div class="panel">
            <form action="{{ route('store.repository') }}" method="POST">
                @include('pages.repositories._form')
            </form>
        </div>
    </div>
@endsection