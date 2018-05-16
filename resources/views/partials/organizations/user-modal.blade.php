
<div class="modal fade" id="user-modal{{ isset($org_user) ? ('-' . $org_user->id) : '' }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>{{ isset($org_user) ? ('Update ' . $org_user->name) : 'Create a New User' }}</h4>

                <form action="{{ isset($org_user) ? route('update.user', ['user' => $org_user]) : route('create.user') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name">Name</label>
                                {{ Form::text('user-name', isset($org_user) ? $org_user->name : null, ['class' => 'form-control', 'required' => true]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email">Email</label>
                                {{ Form::text('user-email', isset($org_user) ? $org_user->email : null, ['class' => 'form-control', 'required' => true]) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(! isset($org_user))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="temp-password">Temporary Password</label>
                                    {{ Form::text('temp-password', null, ['class' => 'form-control']) }}
                                    <p class="red">Make sure to copy this down</p>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label class="checkbox-container">Admin Privileges
                                <input type="checkbox" name="is_admin" {{ isset($org_user) && $org_user->is_admin ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::submit(isset($org_user) ? 'Update' : 'Create', ['class' => 'btn']) }}
                            {{ Form::button('Cancel', ['class' => 'btn cancel', 'data-dismiss' => 'modal']) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>