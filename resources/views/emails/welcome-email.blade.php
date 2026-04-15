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

<p>To use the toilet and shower you will need to switch the water pump on, the plug socket is located inside the cabin on the back wall below the fuse board.</p>

<p>The plug for the fridge is located above it.</p>

<p>There is a tap on the outside rear wall of the cabin, this is tank water and can be used for washing up, etc, <strong>please do not drink this water.</strong></p>

<p>Our electric system works on solar charging, which means that the power we generate from the sun in the daytime is stored in batteries so we have electricity to use during the hours of darkness.</p> 

<p>Our system is sufficient and will keep the cabin lights and power working for the fridge during the evening. Still, we advise where possible to charge all batteries for Bait Boats and any other electrical items you may have during the daylight hours thus using the power of the sun and not putting unnecessary strain on the battery backup.</p>

<p>The shower also runs off the solar, so again where possible please use this in the daytime. We are reliant on the sun and can't guarantee it will always shine so any help with reserving the power is greatly appreciated.</p>

<p><strong>Fish Care & Biosecurity</strong></p>


<p>All anglers must use the dip tank provided to dip nets and slings prior to fishing. This is an important measure to protect the health of our fish stock and to help prevent the spread of disease between fisheries. Thank you for your cooperation and for helping us maintain high standards of fish care. 🎣</p>

<p><strong>Rubbish Disposal</strong></p>

<p>All recycling rubbish (bottles, cans, and plastic) must be taken to the recycling bins. These can be found in any of the larger local hamlets.</p>

<p>A general rubbish only bin is located at the entrance at the top of our track. The big silver key for it is in the lodge.</p>

<p><strong>Departure</strong><br>

<p>Please remember to:</p>

<ul>
	<li>Turn the water pump off</li>
	<li>empty the fridge leave the door open, and switch it off at the plug.</li>
	<li>Lock the cabin up and put the key back in the lockbox.</li>
	<li>Ensure the cabin is left tidy</li>
	<li>Lock the gate when you leave</li>
</ul>



<p>We hope you enjoy your trip, any feedback good or bad is greatly appreciated.</p> 


@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/rules', 'color' => 'blue'])
View Rules
@endcomponent

<p>If you have any further questions or queries please contact me by replying to this email.</p>

<p>We hope you enjoy your trip!<br>
Redwood Lake</p>
@endcomponent