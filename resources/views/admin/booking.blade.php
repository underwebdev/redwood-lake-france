@extends('admin')

@section('content')

@livewire('admin.booking-management',['booking' => $booking])

@endsection