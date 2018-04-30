
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', 'Title', ['class' => 'required']) }}
            {{ Form::text('title', isset($plan) ? $plan->title : null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'ACME Production']) }}
        </div>
        @if ($errors->first('title'))
            <p class="message-error">{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('environment_id', 'Environment', ['class' => 'required']) }}
            <select name="environment_id" class="form-control" required>
                @forelse (\App\Models\Environment::all() as $environment)
                    <option value="{{ $environment->id }}" {{ isset($plan) && $environment->id === $plan->environment->id ? 'selected' : '' }}>
                        {{ $environment->title }} - {{ $environment->ip_address }}
                    </option>
                @empty
                    <option value="">No environments</option>
                @endforelse
            </select>
        </div>
        @if ($errors->first('environment_id'))
            <p class="message-error">{{ $errors->first('environment_id') }}</p>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('repository_id', 'Repository', ['class' => 'required']) }}
            {{ Form::select('repository_id', ['' => ''] + \App\Models\Repository::pluck('name', 'id')->toArray(), isset($plan) ? $plan->repository->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
        @if ($errors->first('repository_id'))
            <p class="message-error">{{ $errors->first('repository_id') }}</p>
        @endif
    </div>
</div>

<div id="hide" style="display: {{ isset($plan) ? 'block' : 'none' }}">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('repository_branch', 'Repository Branch', ['class' => 'required']) }}
                {{ Form::select('repository_branch', ['' => ''], null, ['class' => 'form-control', 'required' => true, 'data-id' => isset($plan) ? $plan->repository_id : null]) }}
            </div>
            @if ($errors->first('repository_branch'))
                <p class="message-error">{{ $errors->first('repository_branch') }}</p>
            @endif
        </div>
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('remote_path', 'Remote Project Path', ['class' => 'required']) }}
                {{ Form::text('remote_path', isset($plan) ? $plan->remote_path : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
            @if ($errors->first('remote_path'))
                <p class="message-error">{{ $errors->first('remote_path') }}</p>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn']) }}
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        var plan_exists = {!! json_encode(!empty($plan)) !!};

        $(document).ready(function() {
            // Check for new branches on load
            if (plan_exists) {
                getBranches($('[name="repository_branch"]').getAttribute('data-id'));
            }
        });

        $('[name="repository_id"]').on('change', function() {
            getBranches(this.value);
        });

        /**
         * Gets all branches for selected repository
         */
        function getBranches(repository_id) {
            if (repository_id) {
                $('#hide').show();
                $('[name="repository_branch"]').empty();

                $.ajax({
                    method: 'GET',
                    url: '/github/branches',
                    data: {'repository_id' : repository_id},
                    success: function(branches) {
                        // Add new option for every branch
                        $.each(branches, function(key, branch) {
                            if (plan_exists && branch.name === repository_id) {
                                $('[name="repository_branch"]').append($('<option>', {
                                    value: branch.name,
                                    text: branch.name
                                }).attr('selected', true));
                            } else {
                                $('[name="repository_branch"]').append($('<option>', {
                                    value: branch.name,
                                    text: branch.name
                                }));
                            }
                        });
                    }
                });
            } else {
                $('#hide').hide();
            }
        }
    </script>
@endsection