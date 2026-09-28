<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
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
        TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses'));
        $response->assertOk();
    }

    public function test_create(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function test_store(): void
    {
        $data = TaskStatus::factory()->make()->toArray();
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect(route('task_statuses'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function test_edit(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses.edit', [$status]));
        $response->assertOk();
    }

    public function test_update(): void
    {
        $status = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->only('name');
        $response = $this->patch(route('task_statuses.update', $status), $data);
        $response->assertRedirect(route('task_statuses'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function test_destroy(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->delete(route('task_statuses.destroy', [$status]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses'));
        $this->assertDatabaseMissing('task_statuses', $status->only('id'));
    }
}
