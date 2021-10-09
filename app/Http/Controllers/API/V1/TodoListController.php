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

    public function show(TodoList $todoList)
    {
        return response($todoList, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $list = TodoList::create([
            'name' => $request->name
        ]);
        return response($list, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
