@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')

            <table class="table">
                <thead>
                    <tr>
                        <th class="min-txt">Name</th>
                        <th class="min-txt">IP Address</th>
                        <th class="min-txt">Authentication Type</th>
                        <th class="min-txt">
                            <a href="{{ route('create.environment') }}" class="btn">Create</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @forelse($environments as $environment)
                    <tr>
                        <td>{{ $environment->title }}</td>
                        <td>{{ $environment->ip_address }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $environment->authentication_type)) }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#delete-environment-{{ $environment->id }}">
                                <i class="fa fa-trash action"></i>
                            </button>
                            <a href="{{ route('edit.environment', compact('environment')) }}">
                                <i class="fa fa-cog action"></i>
                            </a>
                        </td>
                    </tr>
                    @include('partials.delete-environment-modal', compact('environment'))
                @empty
                    <tr class="empty">
                        <td colspan="100">No environments found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if(count($environments) > 0)
                <p class="text-center secondary-dark min-txt">Displaying {{ count($environments) }} {{ count($environments) > 1 ? str_plural('environment') : 'environment' }}</p>
            @endif
        </div>
    </div>
@endsection

