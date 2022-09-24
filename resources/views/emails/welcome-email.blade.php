@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Important Information</center></h2>
<p>Hello {{ $data['firstName'] }},</p>
<p></p>

@component('mail::panel')

@endcomponent

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/login', 'color' => 'blue'])
Log In
@endcomponent
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent