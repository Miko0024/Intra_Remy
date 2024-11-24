@extends('layouts.app')

@section('content')
    <h1>Modifier la tâche</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priorité</label>
            <select name="priority" id="priority" class="form-control" required>
                <option value="haute" {{ $task->priority == 'haute' ? 'selected' : '' }}>Haute</option>
                <option value="moyenne" {{ $task->priority == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                <option value="basse" {{ $task->priority == 'basse' ? 'selected' : '' }}>Basse</option>
            </select>
        </div>
        <div class="form-group">
            <label for="due_date">Date limite</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </form>
@endsection
