@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <p><i class="fa fa-code"></i> Create Repository</p>
            </div>
        </div>
    </div>
    <form action="{{ route('store.repository') }}" method="POST">
        @include('pages.repositories._form')
    </form>
@endsection