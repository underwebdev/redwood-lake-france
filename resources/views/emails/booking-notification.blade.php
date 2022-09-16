@component('mail::message')
<h1 class="text-center"><center>Redwood Lake</center></h1>
<h2><center>Booking Notification</center></h2>
@component('mail::panel')
<p><strong>Lead Booking:</strong> {{ $booking->angler->firstName }} {{ $booking->angler->lastName }}<br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($booking->departure)) }}<br>
<strong>Anglers:</strong> {{ $booking->anglers }}<br>
<strong>Total:</strong> £{{ $booking->total / 100 }}<br>
<strong>Payments:</strong> £{{ $booking->payments()->sum('total') / 100 }}</p>
@endcomponent
@endcomponent
