@component('mail::message')
<h1><center>Redwood Lake</center></h1>
<h2><center>{{ $mailshot['title'] }}<br>
{{ Carbon\Carbon::now()->englishMonth }} {{ Carbon\Carbon::now()->year }}</center></h2>
<p>Hello {{ $mailshot['name'] }},</p>
<p>{!! nl2br(e($mailshot['body'])) !!}</p>
<p>Thanks,<br>
Redwood Lake</p>
<center><small><a href="https://redwoodlake.co.uk/unsubscribe">Update mail preferences</a></small></center>
@endcomponent
