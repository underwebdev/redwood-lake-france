@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Leave Your Feedback</center></h2>
<p>Hello {{ $data['firstName'] }},</p>
<p>Angler feedback is greatly appreciated blah blah blah </p>

@component('mail::panel')

@endcomponent

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/login', 'color' => 'blue'])
Log In
@endcomponent
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
