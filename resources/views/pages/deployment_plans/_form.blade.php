
@include('partials.message')

{{ csrf_field() }}

<div class="row">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('title', 'Title', ['class' => 'required']) }}
                    {{ Form::text('title', isset($plan) ? $plan->title : null, ['class' => 'form-control', 'required' => true, 'autofocus', 'placeholder' => 'ACME Production']) }}
                </div>
                @if($errors->first('title'))
                    <p class="red">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('environment_id', 'Environment', ['class' => 'required']) }}
                    <select name="environment_id" class="form-control" required>
                        @forelse(\App\Models\Environment::all() as $environment)
                            <option value="{{ $environment->id }}" {{ isset($plan) && $environment->id === $plan->environment->id ? 'selected' : '' }}>
                                {{ $environment->title }} - {{ $environment->ip_address }}
                            </option>
                        @empty
                            <option value="">No environments</option>
                        @endforelse
                    </select>
                </div>
                @if($errors->first('environment_id'))
                    <p class="red">{{ $errors->first('environment_id') }}</p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('repository_id', 'Repository', ['class' => 'required']) }}
                    {{ Form::select('repository_id', ['' => ''] + \App\Models\Repository::pluck('title', 'id')->toArray(), isset($plan) ? $plan->repository->id : null, ['class' => 'form-control', 'required' => true]) }}
                </div>
                @if($errors->first('repository_id'))
                    <p class="red">{{ $errors->first('repository_id') }}</p>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('repository_branch', 'Repository Branch', ['class' => 'required']) }}
                    {{ Form::select('repository_branch', ['' => ''], null, ['class' => 'form-control', 'required' => true, 'disabled', 'data-id' => isset($plan) ? $plan->repository_id : null]) }}
                </div>
                @if($errors->first('repository_branch'))
                    <p class="red">{{ $errors->first('repository_branch') }}</p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="checkbox-container">Automatic Deployment
                    <input type="checkbox" name="is_automatic" {{ isset($plan) && $plan->is_automatic ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{ Form::submit(isset($plan) ? 'Update' : 'Create', ['class' => 'btn', 'id' => 'submit']) }}
                <a href="{{ route('view.deployment-plans') }}" class="btn cancel">Cancel</a>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <ul class="nav nav-tabs deployment-tabs">
            <li class="nav-item active">
                <a href="#commands" class="nav-link" aria-controls="commands" data-toggle="tab">Commands</a>
            </li>
            <li class="nav-item">
                <a href="#env" class="nav-link" aria-controls="env" data-toggle="tab">Environment File</a>
            </li>
        </ul>
        <div class="tab-content">
            @php $default = "cd project/path;\n\ndeploy;" @endphp

            <p class="red text-center" style="display: none;" id="command-error">
                Make sure to include command <code>deploy;</code> for deployment
            </p>
            <div class="tab-pane active" role="tabpanel" id="commands">
                {{ Form::textarea('commands', isset($plan) ? $plan->commands : $default, ['id' => 'commands-editor']) }}
            </div>
            <div class="tab-pane" role="tabpanel" id="env">
                {{ Form::textarea('env', isset($plan) ? $plan->env : null, ['id' => 'env-editor']) }}
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">
        var plan_exists = @json(!empty($plan)),
            editor_created = false;

        $(document).ready(function() {
            // Check for new branches on load
            if (plan_exists) {
                getBranches($('[name="repository_branch"]')[0].getAttribute('data-id'));
            }

            // Create code editor
            CodeMirror.fromTextArea(document.getElementById('commands-editor'), {
                lineNumbers: true
            }).on('change', function (field) {
                if (!field.getValue().includes("deploy;")) {
                    $("#submit").prop("disabled", true);
                    $("#command-error").css("display", "block");
                } else {
                    $("#submit").prop("disabled", false);
                    $("#command-error").css("display", "none");
                }
            });
        });

        // Get all repo branches on repo selection
        $('[name="repository_id"]').on('change', function() {
            getBranches(this.value);
        });

        // Fix weird CodeMirror tab issue
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.target.href.includes("env") && !editor_created) {
                CodeMirror.fromTextArea(document.getElementById('env-editor'), {
                    lineNumbers: true
                });
                editor_created = true;
            }
        });

        // Gets all branches for selected repository
        function getBranches(repository_id) {
            if (repository_id) {
                $("#submit").prop("disabled", true);
                $('[name="repository_branch"]').prop('disabled', false).append($('<option>', {
                    text: 'Loading...'
                }).attr('selected', true));

                $.ajax({
                    method: 'GET',
                    url: '/github/branches',
                    data: {'repository_id' : repository_id},
                    success: function(branches) {
                        $("#submit").prop("disabled", false);
                        $('[name="repository_branch"]').empty();

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
                $('[name="repository_branch"]').prop('disabled', true);
            }
        }
    </script>
@endsection