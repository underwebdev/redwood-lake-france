@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>Account Created</center></h2>
<p>Hello {{ $data['firstName'] }},</p>
<p>Your account has now been created to manage your booking at Redwood Lake. When logging in for the first time you will be prompted to change your password before continuing.</p>
@component('mail::panel')
<p class="text-center"><strong>Your log in credentials</strong><br>
<strong>Username:</strong> {{ $data['email'] }}<br>
<strong>Password:</strong> {{ $data['password'] }}</p>
@endcomponent
@component('mail::button', ['url' => 'https://www.redwoodlake.co.uk/login', 'color' => 'blue'])
Log In
@endcomponent
<p>Thanks,<br>
Redwood Lake</p>
@endcomponent
