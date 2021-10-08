<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_all_todo_list()
    {
        TodoList::factory()->create(['name' => 'my list']);
        $response = $this->getJson(route('todo-list.index'));
        $this->assertEquals(1, $this->count($response->json()));
        $this->assertEquals('my list', $response->json()[0]['name']);
    }
}
