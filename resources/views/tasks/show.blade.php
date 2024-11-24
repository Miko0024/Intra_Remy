@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>Priorité : {{ $task->priority }}</p>
    <p>Date limite : {{ $task->due_date }}</p>
    <p>Status : {{ $task->status }}</p>
@endsection
