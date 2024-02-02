@component('mail::message')
# Account Confirmation

Hello {{ $userName }},

Thank you for registering an account with us. Please click the button below to confirm your email address:

@component('mail::button', ['url' => $confirmationUrl])
Confirm Email
@endcomponent

If you did not request this, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
