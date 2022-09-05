@component('mail::message')
<h1 class="text-center"><center>Redwood Lake</center></h1>
<h2><center>Booking Receipt</center></h2>

<p class="text-center">Hello {{ $booking->angler->firstName }},<br>
Thank you for making a booking at Redwood Lake. Please find below details of your booking.</p>
@component('mail::panel')
<p class="text-center"><strong>Booking Information</strong><br>
<strong>Lead Booking:</strong> {{ $booking->angler->firstName }} {{ $booking->angler->lastName }}<br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($booking->departure)) }}<br>
<strong>Anglers:</strong> {{ $booking->anglers }}<br>
<strong>Total:</strong> £{{ $booking->total / 100 }}<br>
<strong>Payments:</strong> £{{ $booking->payments()->sum('total') / 100 }}</p>
@endcomponent
@if($booking->payments()->sum('total') < $booking->total)
<strong>Your final balance of £{{ $booking->total - $booking->payments()->sum('total') / 100 }} is due by 
	{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('d/m/Y') }}.</strong> Payments can be made through our website via credit/debit or bank transfer.
@endif
@endcomponent
