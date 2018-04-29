
<div class="modal fade" id="delete-repository-{{ $repository->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Delete '{{ $repository->title }}'?</h4>
                <p class="secondary-text">This will remove all attached deployment plans</p>

                <form action="{{ route('delete.repository', compact('repository')) }}" method="POST">
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