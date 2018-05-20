@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Repository Name</th>
                        <th>Connected Webhook</th>
                        <th>
                            <a href="{{ route('create.repository') }}" class="btn">Create</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @forelse($repositories as $repository)
                    <tr>
                        <td>{{ $repository->title }}</td>
                        <td>
                            <a href="{{ $repository->url }}" target="_blank" class="secondary-text">{{ $repository->name }}</a>
                        </td>
                        <td>
                            <i class="fa fa-check green"></i> Linked
                        </td>
                        <td>
                            <button data-toggle="modal" data-target="#delete-repository-{{ $repository->id }}">
                                <i class="fa fa-trash action"></i>
                            </button>
                            <a href="{{ route('edit.repository', compact('repository')) }}">
                                <i class="fa fa-cog action"></i>
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
            <p class="text-center secondary-dark">Displaying {{ count($repositories) }} repositor{{ count($repositories) > 1 ? 'ies' : 'y' }}</p>
        </div>
    </div>
@endsection

