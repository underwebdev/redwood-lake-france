@component('mail::message')
<h1><center>@if($extra->paymethod_id == 1) Payment @else Bank Transfer @endif Confirmation</center></h1>
@if($extra->paymethod_id == 1)
Your payment has been received 
@elseif($extra->paymethod_id == 2)
Your bank transfer payment has been confirmed.</p>
@endif

@component('mail::panel')
<h2>Your Order</h2> 
<strong>Product:</strong> {{ $extra->product->name }}<br>
<strong>Price:</strong> £{{ $extra->price / 100 }}<br>
<strong>Quantity:</strong> {{ $extra->quantity }}<br>
<strong>Total:</strong> £{{ $extra->total / 100 }}</p>
@endcomponent
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
