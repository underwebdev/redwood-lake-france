@component('mail::message')
<h1><center>Bank Transfer Confirmation</center></h1>
<p>Hello {{ $payment->angler->firstName }},<br>
Your bank transfer payment has been confirmed.</p>

@component('mail::panel')
<h2>Booking</h2> 
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($payment->booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($payment->booking->departure)) }}<br>
<strong>Payment:</strong> £{{ $payment->total / 100 }}<br>
<strong>Balance Due:</strong> £{{ ($payment->booking->total - $payment->booking->payments()->sum('total')) / 100 }}</p>
@endcomponent
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
