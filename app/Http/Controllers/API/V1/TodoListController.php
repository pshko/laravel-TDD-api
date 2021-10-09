<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index()
    {
        $todos = TodoList::all();
        return response($todos, Response::HTTP_OK);
    }

    public function show(TodoList $todo_list)
    {
        return response($todo_list, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $list = TodoList::create([
            'name' => $request->name
        ]);
        return response($list, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(TodoList $todo_list, Request $request)
    {
        $request->validate(['name' => 'required']);
        $todo_list->update(['name' => $request->name]);
        return response($todo_list, Response::HTTP_OK);
    }
}
