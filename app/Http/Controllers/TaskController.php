<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return response($tasks, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title
        ]);

        return response($task, Response::HTTP_CREATED);
    }

    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
