
@if (session()->has('message'))
    <div class="message-success">{{ session()->get('message') }}</div>

@elseif (session()->has('error'))
    <div class="message-error">{{ session()->get('error') }}</div>
@endif
