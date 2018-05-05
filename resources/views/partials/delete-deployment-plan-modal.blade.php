
<div class="modal fade" id="delete-deployment-plan-{{ $plan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Delete '{{ $plan->title }}'?</h4>

                <form action="{{ route('delete.deployment-plan', compact('plan')) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::submit('Delete', ['class' => 'btn']) }}
                            {{ Form::button('Cancel', ['class' => 'btn cancel', 'data-dismiss' => 'modal']) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>