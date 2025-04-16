@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Important information regarding your upcoming trip to Redwood Lake</center></h2>
<p>Hello {{ $data['firstName'] }},</p>

<p><strong>Gate code: 0502</strong></p>
<p>The key for the cabin is in the lock box to the right of the patio doors on the rear wall of the cabin.</p>
<o><strong>Lockbox Code: 5308<br>
Wifi Password: Croxley333</strong></o>

<p>Please note that you will need to switch the water pump on for the shower and toilet. The plug socket is located inside the cabin on the back wall.
The plug for the fridge is located above please make sure the fridge is empty, switched off and the door left open you you leave.
There is a tap on the outside rear wall of the cabin, this is tank water and can be used for washing up, etc, please do not drink this water.</p>

<p>Our electric system works on solar charging, which means that the power we generate from the sun in the daytime is stored in batteries so we have electricity to use during the hours of darkness. Our system is sufficient and will keep the cabin lights and power working for the fridge during the evening. Still, we advise where possible to charge all batteries for Bait Boats and any other electrical items you may have during the daylight hours thus using the power of the sun and not putting unnecessary strain on the battery backup.<br>
The shower also runs off the electricity so again where possible please use this in the daytime. We are reliant on the sun and can't guarantee it will always shine so any help with reserving the power is greatly appreciated.

<p>All members of your party will have been sent login details for our website, so that they have the option to upload their catch reports. If anyone has not received this, please reply to this email.</p>

<p>Please make sure all members of the party have read the lake rules, anyone found to be breaking the rules will be asked to leave immediately.</p>

@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/rules', 'color' => 'blue'])
View Rules
@endcomponent

<p>If you have any further questions or queries please contact me by replying to this email.</p>

@component('mail::panel')
<p class="text-center"><strong>Booking Information</strong><br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($data['arrival'])) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($data['departure'])) }}<br>
@endcomponent

<p>We hope you enjoy your trip!<br>
Redwood Lake</p>
@endcomponent