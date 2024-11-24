<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:300',
            'priority' => 'required|in:haute,moyenne,basse',
            'due_date' => 'required|date',
        ]);

        
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->priority = $request->input('priority');
        $task->due_date = $request->input('due_date');
        $task->status = 'ouverte'; 
        $task->user_id = Auth::id(); 
        $task->save();

       
        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès');
    }

    public function edit($id)
    {
        
        $task = Task::findOrFail($id);

      
        if ($task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous ne pouvez pas modifier cette tâche.');
        }

     
        return view('tasks.edit', compact('task'));
    }

    
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:haute,moyenne,basse',
            'due_date' => 'required|date',
        ]);

        
        $task = Task::findOrFail($id);

      
        if ($task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous ne pouvez pas modifier cette tâche.');
        }

       
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->priority = $request->input('priority');
        $task->due_date = $request->input('due_date');
        $task->status = $request->input('status', $task->status); 
        $task->save();

       
        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
    
}

