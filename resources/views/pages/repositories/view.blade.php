@extends('layouts.base')

@section('content')
    <div class="repositories">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="header">
                        <p>Repositories</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('create.repository') }}" class="btn">Create</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('partials.message')

                    <table class="table">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Repository URL</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse (\App\Models\Repository::all() as $repository)
                            <tr>
                                <td>{{ $repository->title }}</td>
                                <td>
                                    <a href="{{ $repository->url }}" target="_blank">{{ $repository->url }}</a>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#delete-repository-{{ $repository->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a href="{{ route('edit.repository', compact('repository')) }}">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('partials.delete-repository-modal', compact('repository'))
                        @empty
                            <tr class="empty">
                                <td colspan="100">No repositories found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

