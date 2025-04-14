@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Leave Your Feedback</center></h2>
<p>Hello {{ $data['firstName'] }}</p>
<p>Angler feedback is greatly appreciated, we kindly ask if you could take a moment to share your experience on our Google profile using the link below.</p>

@component('mail::button', ['url' => 'https://g.page/r/CQrw4Ty25etNEAE/review', 'color' => 'blue'])
Leave Review
@endcomponent
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
