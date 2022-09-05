@component('mail::message')
<h1 class="text-center">Redwook Lake Admin</h1> 
		
@component('mail::panel')
<p class="text-center"><strong>Your log in credentials</strong><br>
<strong>Password:</strong> {{ $password }}<br></p>
<p class="text-center">Please make sure you change your password when you log in.</p>
@endcomponent

@component('mail::button', ['url' => 'https://redwoodlake.co.uk/login'])
Log in to your account
@endcomponent
@endcomponent
