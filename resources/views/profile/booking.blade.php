@extends('profile')

@section('content')

@livewire('profile.manage-booking',['booking' => $booking])

@endsection