@extends('profile')

@section('content')

@livewire('profile.report-update', ['report' => $report])

@endsection