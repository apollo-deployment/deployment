
@component('mail::layout')
@slot('header')
    <table width="100%">
        <tr>
            <td style="text-align: center;">
                <img src="{{ asset('/images/apollo-logo.png') }}" style="max-width: 50px;display: block;margin: 0 auto;">
            </td>
        </tr>
    </table>
@endslot

<strong>Hello, {{ $user->name }}!</strong>
<p>Welcome to Apollo!</p>
<p>Please verify your account by clicking the button below</p>

<table width="100%">
    <tr>
        <td style="text-align: center;">
            <a href="{{ url('verify', $user->verifyUser->token) }}" class="button" target="_blank" style="background-color: #ff5620;padding: 10px 35px;font-size: 16px;">Verify Email</a>
        </td>
    </tr>
</table>

@slot('footer')
    @component('mail::footer')
        © Copyright {{ date('Y') }} Apollo Deployment
    @endcomponent
@endslot
@endcomponent