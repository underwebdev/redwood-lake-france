<x-mail::message>
<h1><center>Payment Overdue</center></h1>
<p>Hello {{ $booking->angler->firstName }},<br>


@component('mail::panel')
<h2>Booking</h2> 
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($booking->departure)) }}<br>
<strong>Anglers:</strong> {{ $booking->anglers }}</p>
@endcomponent

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/login', 'color' => 'blue'])
Add Guest Information
@endcomponent

<p>Thanks,<br>
Redwood Lake</p>
</x-mail::message>
