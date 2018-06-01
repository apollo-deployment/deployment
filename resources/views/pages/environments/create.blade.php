@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <p><i class="fa fa-server"></i> Create Environment</p>
            </div>
        </div>
    </div>
    <form action="{{ route('store.environment') }}" method="POST" enctype="multipart/form-data">
        @include('pages.environments._form')
    </form>
@endsection