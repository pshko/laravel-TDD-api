<?php

namespace Tests;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createTodoList($argv = [])
    {
        return TodoList::factory()->create($argv);
    }

    public function createTask($argv = [])
    {
        return Task::factory()->create($argv);
    }
}
