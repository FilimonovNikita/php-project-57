<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Label;
use App\Models\Task;

class TaskLabelControllerTest extends TestCase
{
    private User $user;
    private Label $label;
    private Task $task;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->label = Label::factory()->create();
        $this->task = Task::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = ['name' => 'Label'];

        $response = $this->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit(): void
    {
        $this->actingAs($this->user);
        $response = $this->get(route('labels.edit', ['label' => $this->label]));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $this->actingAs($this->user);
        $data = ['name' => 'NewLabel'];

        $response = $this->patch(route('labels.update', ['label' => $this->label]), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('labels.destroy', ['label' => $this->label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
    }

    public function testDeleteIfAssociatedWithTask(): void
    {
        $this->task->taskLabel()->attach(['label' => $this->label->id]);
        $response = $this->delete(route('labels.destroy', ['label' => $this->label]));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response->assertRedirect();
    }
}
