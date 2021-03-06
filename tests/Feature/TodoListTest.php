<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $list;

    public function setUp() :void
    {
        parent::setUp();
        $this->list = $this->createTodoList(['name' => 'my list']);
    }

    public function test_fetch_all_todo_list()
    {
        $response = $this->getJson(route('todo-lists.index'));
        $this->assertEquals(1, $this->count($response->json()));
        $this->assertEquals('my list', $response->json()[0]['name']);
    }

    public function test_fetch_single_todo_list()
    {
        $response = $this->getJson(route('todo-lists.show', $this->list->id))
            ->assertOk()
            ->json();
        $this->assertEquals($response['name'], $this->list->name);
    }

    public function test_store_todo_list()
    {
        $list = TodoList::factory()->make();
        $response = $this->postJson(route('todo-lists.store', ['name' => $list->name]))
            ->assertCreated()
            ->json();

        $this->assertEquals($list->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }

    public function test_while_storing_todo_list_name_field_is_required()
    {
        $this->postJson(route('todo-lists.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-lists.destroy', $this->list->id))
        ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);
    }

    public function test_update_todo_list()
    {
        $this->patchJson(route('todo-lists.update',$this->list->id), ['name' => 'update todo list'])
            ->assertOk()
        ;
        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name' => 'update todo list']);
    }

    public function test_while_update_todo_list_name_field_is_required()
    {
        $this->patchJson(route('todo-lists.update', $this->list->id), ['name' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }
}
