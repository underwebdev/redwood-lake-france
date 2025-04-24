@component('mail::message')
<h1><center>Payment Reminder</center></h1>
<p>Hello {{ $booking->angler->firstName }},<br>
This is a reminder to let you know that your final balance of £{{ ($booking->total - $booking->payments()->sum('total')) / 100 }} is due by 
{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('d/m/Y') }}. You can make payments through our website via credit/debit card or bank transfer.</p>

@component('mail::panel')
<h2>Booking #{{ $booking->id }}</h2> 
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($booking->departure)) }}<br>
<strong>Balance Due:</strong> £{{ ($booking->total - $booking->payments()->sum('total')) / 100 }}</p>
@endcomponent

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/login', 'color' => 'blue'])
Make Payment
@endcomponent

<p>Thanks,<br>
Redwood Lake</p>
@endcomponent