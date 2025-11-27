<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tasks = Task::whereNull('deleted_at')->whereNull('completed_at')->get();
        $manageTask = Task::all();
        $tasks = Task::whereNull('completed_at')->get();
        $trashedTasks = Task::onlyTrashed()->get();
        $completedTasks = Task::whereNotNull('completed_at')->get();
        return view('home', compact('tasks', 'manageTask', 'trashedTasks', 'completedTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'priority'  => 'required|in:High,Medium,Low',
            'deadline'  => 'required|date|after:today',
        ]);
        Task::create($validated);
        return back()->with('success', 'Task added successfully!');
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return back()
        ->with('success', 'Task restored successfully!')
        ->with('activeTab', 'trash');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function complete($id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'completed_at' => now()
        ]);

        return back()
        ->with('success', 'Task marked as completed!')
        ->with('activeTab', 'pending');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|in:High,Medium,Low',
            'deadline' => 'required|date|after:today',
        ]);

        $task->update($validated);

        return back()
        ->with('success', 'Task updated successfully!')
        ->with('activeTab', 'manage-task');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back()
        ->with('success', 'Task deleted successfully!')
        ->with('activeTab', 'manage-task');
    }
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();

        return back()
        ->with('success', 'Task permanently deleted!')
        ->with('activeTab', 'trash');
    }
}
