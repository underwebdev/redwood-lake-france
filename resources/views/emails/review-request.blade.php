@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Leave Your Feedback</center></h2>
<p>Hello {{ $angler->firstName }}</p>
<p>We hope you enjoyed your recent trip to Redwood Lake. Any feedback from our guests, good or bad is greatly appreciated, we kindly ask if you could take a moment to share your experience on our Google profile using the link below.</p>

@component('mail::button', ['url' => 'https://g.page/r/CQrw4Ty25etNEAE/review', 'color' => 'blue'])
Leave Review
@endcomponent

<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
