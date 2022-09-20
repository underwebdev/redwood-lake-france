@component('mail::message')

<h1 class="text-center">Password Reset</h1> 
<p class="text-center">Hello {{ $data['firstName'] }},</p>
		
@component('mail::panel')
<p class="text-center"><strong>Your log in credentials</strong><br>
<strong>Username:</strong> {{ $data['email'] }}<br>
<strong>Password:</strong> {{ $data['password'] }}<br></p>
<p class="text-center">You will be prompted to change your password when you log in.</p>
@endcomponent

@component('mail::button', ['url' => 'https://redwoodlake.co.uk/login'])
Log in to your account
@endcomponent

@endcomponent
