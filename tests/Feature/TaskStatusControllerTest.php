<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TaskStatus;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = TaskStatus::factory()->make()->toArray();
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect(route('task_statuses'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEdit(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses.edit', [$status]));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $status = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->only('name');
        $response = $this->patch(route('task_statuses.update', $status), $data);
        $response->assertRedirect(route('task_statuses'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->delete(route('task_statuses.destroy', [$status]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses'));
        $this->assertDatabaseMissing('task_statuses', $status->only('id'));
    }
}
