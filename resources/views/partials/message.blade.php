
@if (session()->has('message'))
    <div class="message-success">{{ session()->get('message') }}</div>
@elseif ($errors->any())
    <div class="message-error">{{ $errors->first() }}</div>
@endif
