@extends('payment')

@section('content')

@livewire('pay-deposit',['date' => $date])

@endsection