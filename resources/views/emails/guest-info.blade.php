@component('mail::message')
<h1><center>Payment Overdue</center></h1>
<p>Hello {{ $booking->angler->firstName }},<br>

<p>Please make sure you have registered all members of your party as per our booking terms and conditions, this will also ensure they receive an email with instructions on how to register on our website to upload their catch reports as per the lake rules.</p>

<p>If anyone has not received this, please reply to this email. Please also make sure all members of the party have read the lake rules, anyone found to be breaking the rules will be asked to leave immediately.</p>

@component('mail::panel')
<h2>Booking #{{ $booking->id }}</h2> 
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($booking->departure)) }}<br>
<strong>Anglers:</strong> {{ $booking->anglers }}</p>
@endcomponent

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/login', 'color' => 'blue'])
Add Guest Information
@endcomponent

<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
