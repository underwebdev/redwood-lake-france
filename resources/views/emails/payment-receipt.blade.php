@component('mail::message')
<h1><center>Bank Transfer Confirmation</center></h1>
<p>Hello {{ $payment->angler->firstName }},<br>
Your bank transfer payment has been confirmed.</p>

@component('mail::panel')
<h2>Booking</h2> 
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($payment->booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($payment->booking->departure)) }}<br>
<strong>Payment:</strong> £{{ payment->total / 100 }}</p>
@endcomponent
<p>Please ensure you and your guest have read the rules prior to fishing, members are responsible for their guests behavior whilst fishing.</p>

<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
