@component('mail::message')
<h1 class="text-center"><center>Redwood Lake</center></h1>
<h2><center>Payment Notification</center></h2>
@component('mail::panel')
<p><strong>Lead Booking:</strong> {{ $payment->booking->angler->firstName }} {{ $payment->booking->angler->lastName }}<br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($payment->booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($payment->booking->departure)) }}<br>
<strong>Anglers:</strong> {{ $payment->booking->anglers }}<br>
<strong>Total:</strong> £{{ $payment->booking->total / 100 }}<br>
<strong>Payment:</strong> £{{ $payment->total / 100 }}</p>
<strong>Total Payments:</strong> £{{ $payment->booking->payments->sum('total') / 100 }}</p>
@endcomponent
@endcomponent
