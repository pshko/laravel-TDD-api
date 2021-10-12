<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
use RefreshDatabase;
    public function test_fetch_all_tasks_of_a_todo_list()
    {
        $todo = $this->createTodoList();
        $task = $this->createTask();
        $response = $this->getJson(route('todo-list.task.index', $todo->id))->assertOk()->json();
        $this->assertEquals(1, $this->count($response));
        $this->assertEquals($task->title, $response[0]['title']);
    }

    public function test_store_a_task_for_a_todo_list()
    {
        $todo = $this->createTodoList();
        $task = $this->createTask();
        $this->postJson(route('todo-list.task.store', $todo->id), ['title' => $task->title])
            ->assertCreated();
        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    public function test_delete_a_task_from_database()
    {
        $task = $this->createTask();
        $this->deleteJson(route('task.destroy', $task->id))
            ->assertNoContent();
        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }
}
