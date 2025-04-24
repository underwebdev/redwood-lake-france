@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Important information regarding your upcoming trip to Redwood Lake</center></h2>

<p>Hello {{ $booking->angler->firstName }},<br>
Please read the important information below regarding your upcoming trip to Redwood Lake.</p>

@component('mail::panel')
<p class="text-center"><strong>Booking Information</strong><br>
<strong>Arrival:</strong> {{ date('j/m/y H:i', strtotime ($booking->arrival)) }}<br>
<strong>Departure:</strong> {{ date('j/m/y H:i', strtotime ($booking->departure)) }}<br>
@endcomponent

<p><strong>Gate code: 0502</strong></p>
<p>The key for the cabin is in the lock box to the right of the patio doors on the rear wall of the cabin.</p>
<p><strong>Lockbox Code: 5308</strong></p>

<p>We have Starlink Internet which works ok down to peg 5<br> 
	<strong>Wifi Password: Croxley333</strong></p>

<p>To use the toilet and shower you will need to switch the water pump on, the plug socket is located inside the cabin on the back wall below the fuse board.</p>

<p>The plug for the fridge is located above it.</p>

<p>There is a tap on the outside rear wall of the cabin, this is tank water and can be used for washing up, etc, please do not drink this water.</p>

<p>Our electric system works on solar charging, which means that the power we generate from the sun in the daytime is stored in batteries so we have electricity to use during the hours of darkness.</p> 

<p>Our system is sufficient and will keep the cabin lights and power working for the fridge during the evening. Still, we advise where possible to charge all batteries for Bait Boats and any other electrical items you may have during the daylight hours thus using the power of the sun and not putting unnecessary strain on the battery backup.</p>

<p>The shower also runs off the electricity so again where possible please use this in the daytime. We are reliant on the sun and can't guarantee it will always shine so any help with reserving the power is greatly appreciated.</p>

<p><strong>Departure</strong><br>

11 am</p>

<p>Please remember to turn the pump off, empty the fridge leave the door open, and switch it off at the plug.<br>

Lock the cabin up and put the key back in the lockbox.<br>

All rubbish must be taken away there are recycling bins located a short drive away in either direction.<br>

Please remember to lock the gate when you leave.<br>

We hope you enjoyed your trip, any feedback good or bad is greatly appreciated.</p> 


@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/rules', 'color' => 'blue'])
View Rules
@endcomponent

<p>If you have any further questions or queries please contact me by replying to this email.</p>

<p>We hope you enjoy your trip!<br>
Redwood Lake</p>
@endcomponent