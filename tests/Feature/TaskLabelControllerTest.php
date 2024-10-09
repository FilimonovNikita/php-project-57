<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\TaskLabel;
use App\Models\Task;

class TaskLabelControllerTest extends TestCase
{
    private User $user;
    private TaskLabel $label;
    private Task $task;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->label = TaskLabel::factory()->create();
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
        $response = $this->get(route('labels.edit', ['labels' => $this->label]));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $data = ['name' => 'NewLabel'];

        $response = $this->patch(route('labels.update', ['labels' => $this->label]), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDelete(): void
    {
        $response = $this->delete(route('labels.destroy', ['labels' => $this->label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
    }

    public function testDeleteIfAssociatedWithTask(): void
    {
        $this->task->taskLabel()->attach(['labels' => $this->label->id]);
        $response = $this->delete(route('labels.destroy', ['labels' => $this->label]));
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response->assertRedirect();
    }
}
