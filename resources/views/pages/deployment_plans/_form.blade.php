
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', isset($plan) ? $plan->title : null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'ACME Production']) }}
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('repository_id', 'Repository') }}
            {{ Form::select('repository_id', ['' => ''] + \App\Models\Repository::pluck('name', 'id')->toArray(), isset($plan) ? $plan->repository->id : null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>
    <div class="col-md-2">
        {{-- shows some stats or editing environment file? --}}
    </div>
</div>

<div id="hide" style="display: none">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('repository_branch', 'Repository Branch') }}
                {{ Form::select('repository_branch', ['' => ''], isset($plan) ? $plan->repository_branch : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('environment_id', 'Environment') }}
                {{ Form::select('environment_id', \App\Models\Environment::pluck('title', 'id'), isset($plan) ? $plan->environment->id : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('remote_path', 'Remote Server Path') }}
                {{ Form::text('remote_path', isset($plan) ? $plan->remote_path : null, ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
    </div>
</div>

{{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn']) }}

@section('scripts')
    <script type="text/javascript">
        // Hide/show section on project selection
        $('[name="repository_id"]').on('change', function() {
            if (this.value) {
                $('#hide').show();
                $('[name="repository_branch"]').empty();

                // Gets all branches for the selected project
                $.ajax({
                    method: 'GET',
                    url: '/github/branches',
                    data: {'repository_id' : this.value},
                    success: function(branches) {
                        // Add new option for every branch
                        $.each(branches, function(key, branch) {
                            $('[name="repository_branch"]').append($('<option>', {
                                value: branch.name,
                                text: branch.name
                            }));
                        });
                    }
                });
            } else {
                $('#hide').hide();
            }
        })
    </script>
@endsection