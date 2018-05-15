
<div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Create a New User</h4>

                <form action="{{ route('create.user') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('user-name', 'Name') }}
                                {{ Form::text('user-name', null, ['class' => 'form-control', 'required' => true]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('user-email', 'Email') }}
                                {{ Form::text('user-email', null, ['class' => 'form-control', 'required' => true]) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('temp-password', 'Temporary Password') }}
                                {{ Form::text('temp-password', null, ['class' => 'form-control', 'required' => true]) }}
                                <p class="red">Make sure to copy this down</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="checkbox-container">Admin Privileges
                                <input type="checkbox" name="is_admin">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::submit('Create', ['class' => 'btn']) }}
                            {{ Form::button('Cancel', ['class' => 'btn cancel', 'data-dismiss' => 'modal']) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>