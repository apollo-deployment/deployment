
@if(session()->has('message'))
    <div class="alert message-success">
        {{ session()->get('message') }}
        <a class="close secondary-text" data-dismiss="alert" aria-label="close" title="close">×</a>
    </div>
@elseif ($errors->any())
    <div class="alert message-error">
        {{ $errors->first() }}
        <a class="close secondary-text" data-dismiss="alert" aria-label="close" title="close">×</a>
    </div>
@endif
