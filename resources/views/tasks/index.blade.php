@extends('layouts.app')

@section('content')
    <h1>Liste des Tâches</h1>
    <ul>
        @foreach($tasks as $task)
            <li>
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>
                <p>Priorité : {{ $task->priority }}</p>
                <p>Date limite : {{ $task->due_date }}</p>
                <p>Status : <input type="checkbox" {{ $task->status == 'terminee' ? 'checked' : '' }} disabled></p>
                <a href="{{ route('tasks.show', $task) }}">Détails</a>
                <a href="{{ route('tasks.edit', $task) }}">Modifier</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
