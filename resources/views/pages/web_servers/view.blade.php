@extends('layouts.base')

@section('content')
    <div class="projects">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="header">
                        <p>Web Servers</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('create.web_server') }}" class="btn">Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('partials.message')

                    <table>
                        <thead>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse (\App\Models\WebServer::all() as $web_server)
                            <tr>

                            </tr>
                            @include('partials.delete-webserver-modal', compact('web_server'))
                        @empty
                            <tr class="empty">
                                <td colspan="100">No web servers found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

