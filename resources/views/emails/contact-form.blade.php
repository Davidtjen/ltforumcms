@component('mail::message')

# We have received your message.

Within 12 hours we will contact you.

<strong>Name: </strong>{{ $messageData['name'] }}

<strong>Email: </strong>{{ $messageData['email'] }}

<strong>Message: </strong>
{{ $messageData['message'] }}

Thanks,<br>
<strong> {{ config('app.name') }} </strong>

@endcomponent
