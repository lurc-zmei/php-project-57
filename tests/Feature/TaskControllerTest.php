<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_index(): void
    {
        Task::factory()->create();
        $response = $this->get(route('tasks'));
        $response->assertOk();
    }

    public function test_create(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function test_store(): void
    {
        $user = User::factory()->create();
        $data = Task::factory()->make(['created_by_id' => $user->id])->toArray();

        $response = $this->actingAs($user)->post(route('tasks.store'), $data);
        $response->assertRedirect(route('tasks'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_show(): void
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task->id));
        $response->assertOk();
    }

    public function test_edit(): void
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.edit', $task));
        $response->assertOk();
    }

    public function test_update(): void
    {
        $task = Task::factory()->create();
        $data = Task::factory()->make()->only('name', 'status_id');

        $response = $this->patch(route('tasks.update', $task), $data);
        $response->assertRedirect(route('tasks'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks'));
        $this->assertDatabaseMissing('tasks', $task->only('id'));
    }
}
