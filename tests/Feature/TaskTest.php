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
        $task = $this->createTask();
        $response = $this->getJson(route('tasks.index'))->assertOk()->json();
        $this->assertEquals(1, $this->count($response));
        $this->assertEquals($task->title, $response[0]['title']);
    }

    public function test_store_a_task_for_a_todo_list()
    {
        $task = $this->createTask();
        $this->postJson(route('tasks.store'), ['title' => $task->title])
            ->assertCreated();
        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    public function test_delete_a_task_from_database()
    {
        $task = Task::factory()->create();
        $this->deleteJson(route('tasks.destroy', $task->id))
            ->assertNoContent();
        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }
}
