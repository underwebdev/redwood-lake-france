@component('mail::message')
<p><strong>From:</strong> {{ $contact->name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Telephone:</strong> {{ $contact->telephone}}</p>
<p>{!! nl2br(e($contact->message)) !!}</p>
@endcomponent
