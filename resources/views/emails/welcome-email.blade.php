@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Important Information</center></h2>
<p>Hello {{ $data['firstName'] }},</p>
<p>We look forward to welcoming you at Redwood Lake next week, we ask that you contact our bailiff Simon when you are approximately 30 mins away from the lake on 07572021669.</p>

<p>All members of your party will have been sent login details for our website, so that they have the option to upload their catch reports. If anyone has not received this, please reply to this email.</p>

<p>Please make sure all members of the party have read the lake rules, anyone found to be breaking the rules will be asked to leave immediately.</p>

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/rules', 'color' => 'blue'])
View Rules
@endcomponent

<p>If you have any further questions or queries please contact me by replying to this email.</p>

<p>We hope you enjoy your holiday.</p>

@component('mail::panel')
<p class="text-center"><strong>Booking Information</strong><br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($data['arrival'])) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($data['departure'])) }}<br>
@endcomponent

<p>Thanks,<br>
Redwood Lake</p>
@endcomponent