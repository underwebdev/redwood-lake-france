@component('mail::message')
<h1><center>Payment Overdue</center></h1>
<p>Hello {{ $booking->angler->firstName }},<br>
This is a reminder to let you know that your final balance of £{{ ($booking->total - $booking->payments()->sum('total')) / 100 }} is now overdue. To ensure you do not lose your booking and deposit, please make payment today. Payments can be made through our website via credit/debit or bank transfer.</p>

@component('mail::panel')
<h2>Booking</h2> 
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