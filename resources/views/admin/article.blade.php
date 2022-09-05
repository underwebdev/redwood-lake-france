@extends('admin')

@section('content')

@livewire('admin.article-dashboard',['article' => $article])

@endsection