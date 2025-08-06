@component('mail::message')
<h1><center>New Order</center></h1>

@component('mail::panel')
<p><strong>Lead Booking:</strong> {{ $extra->booking->angler->firstName }} {{ $extra->booking->angler->lastName }}<br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($extra->booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($extra->booking->departure)) }}<br>
<strong>Anglers:</strong> {{ $extra->booking->anglers }}<br>
<strong>Total:</strong> £{{ $extra->booking->total / 100 }}<br>
<strong>Payments:</strong> £{{ $extra->booking->payments()->sum('total') / 100 }}</p>
@endcomponent

@component('mail::panel')
<h2>Order Details</h2> 
<strong>Product:</strong> {{ $extra->product->name }}<br>
<strong>Price:</strong> £{{ $extra->price / 100 }}<br>
<strong>Quantity:</strong> {{ $extra->quantity }}<br>
<strong>Total:</strong> £{{ $extra->total / 100 }}<br>
<strong>Payment Method:</strong> @if($extra->paymethod_id == 1) Credit/Debit @elseif($extra->paymethod_id == 2) Brank Transfer @endif
@endcomponent
</p>
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
