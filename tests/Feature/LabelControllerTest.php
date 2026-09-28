<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelControllerTest extends TestCase
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
        Label::factory()->create();
        $response = $this->get(route('labels'));
        $response->assertOk();
    }

    public function test_create(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function test_store(): void
    {
        $data = Label::factory()->make()->toArray();
        $response = $this->post(route('labels.store'), $data);
        $response->assertRedirect(route('labels'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function test_edit(): void
    {
        $label = Label::factory()->create();
        $response = $this->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function test_update(): void
    {
        $label = Label::factory()->create();
        $data = Label::factory()->make()->only('name', 'description');
        $response = $this->patch(route('labels.update', $label), $data);
        $response->assertRedirect(route('labels'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function test_destroy(): void
    {
        $label = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels'));
        $this->assertDatabaseMissing('labels', $label->only('id'));
    }
}
