<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Label;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        Label::factory()->create();
        $response = $this->get(route('labels'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = Label::factory()->make()->toArray();
        $response = $this->post(route('labels.store'), $data);
        $response->assertRedirect(route('labels'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit(): void
    {
        $label = Label::factory()->create();
        $response = $this->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $label = Label::factory()->create();
        $data = Label::factory()->make()->only('name', 'description');
        $response = $this->patch(route('labels.update', $label), $data);
        $response->assertRedirect(route('labels'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy(): void
    {
        $label = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels'));
        $this->assertDatabaseMissing('labels', $label->only('id'));
    }
}
