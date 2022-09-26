@component('mail::message')
<h1><center>@if($payment->paymethod_id == 1) Payment @else Bank Transfer @endif Confirmation</center></h1>
<p>Hello {{ $payment->angler->firstName }},<br>
@if($payment->paymethod_id == 1)
Your payment has been received 
@elseif($payment->paymethod_id == 2)
Your bank transfer payment has been confirmed.</p>
@endif

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
