@extends('admin')

@section('content')

@livewire('admin.payment-management',['payment' => $payment])

@endsection