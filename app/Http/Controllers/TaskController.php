<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        // Fetch all tasks from the database
        $tasks = Task::all();

        // Return the tasks index view and pass the tasks data
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        // Return the view for creating a new task
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new task and save it to the database
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Redirect to the tasks index page with a success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        // Return the view for a specific task
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        // Return the view to edit a task, passing the task data
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Update the task with the new data
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Redirect to the tasks index page with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the task from the database
        $task->delete();

        // Redirect to the tasks index page with a success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
