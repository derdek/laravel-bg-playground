<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTasks()
    {
        $tasks = Task::paginate(10);
        return response()->json(['tasks' => $tasks]);
    }

    public function getTask(Task $task)
    {
        return response()->json(['task' => $task]);
    }

    public function createTask(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return response()->json(['task' => $task]);
    }

    public function updateTask(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return response()->json(['task' => $task]);
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
