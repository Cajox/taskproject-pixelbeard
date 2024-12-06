<?php

namespace Tests\Feature\Controllers\Task;

use App\Entities\Task\Task;
use App\Entities\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @return void
     */
    public function test_index_returns_all_tasks(): void
    {
        $this->actingAs($this->user);

        [$task1, $task2, $task3] = Task::factory()
                ->count(3)
                ->create(['user_id' => $this->user->id]);

        $response = $this->getJson(route('tasks.index'));

        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('data', 3) // Check for 3 tasks in 'data'
                ->has('data.0', fn (AssertableJson $json) =>
                $json
                    ->where('id', $task1->id)
                    ->where('title', $task1->title)
                    ->where('description', $task1->description)
                    ->where('completed', $task1->completed)
                    ->where('user.id', $task1->user->id)
                    ->where('user.name', $task1->user->name)
                    ->etc()
                )
                ->has('data.1', fn (AssertableJson $json) =>
                $json
                    ->where('id', $task2->id)
                    ->where('title', $task2->title)
                    ->where('description', $task2->description)
                    ->where('completed', $task2->completed)
                    ->where('user.id', $task2->user->id)
                    ->where('user.name', $task2->user->name)
                    ->etc()
                )
                ->has('data.2', fn (AssertableJson $json) =>
                $json
                    ->where('id', $task3->id)
                    ->where('title', $task3->title)
                    ->where('description', $task3->description)
                    ->where('completed', $task3->completed)
                    ->where('user.id', $task3->user->id)
                    ->where('user.name', $task3->user->name)
                    ->etc()
                )
            );
    }

    /**
     * @return void
     */
    public function test_show_returns_specific_task(): void
    {
        $this->actingAs($this->user);

        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->getJson(route('tasks.show', $task->id));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' =>
                    [
                        'id',
                        'title',
                        'description',
                        'completed',
                        'user' => [
                            'id',
                            'name'
                        ]
                    ]
            ])
            ->assertJson(['data' => ['id' => $task->id]]);
    }

    /**
     * @return void
     */
    public function test_store_creates_a_task(): void
    {
        $this->actingAs($this->user);

        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description.',
        ];

        $response = $this->postJson(route('tasks.store'), $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'completed',
                ]
            ])
            ->assertJson(['data' => ['title' => $data['title']]]);

        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * @return void
     */
    public function test_store_fails_validation_without_required_fields(): void
    {
        $this->actingAs($this->user);

        $response = $this->postJson(route('tasks.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'description']);
    }

    /**
     * @return void
     */
    public function test_update_modifies_task(): void
    {
        $this->actingAs($this->user);

        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $updatedData = ['title' => 'Updated Task'];

        $response = $this->putJson(route('tasks.update', $task->id), $updatedData);

        $response->assertStatus(200)
            ->assertJson(['data' => ['title' => $updatedData['title']]]);

        $this->assertDatabaseHas('tasks', $updatedData);
    }

    /**
     * @return void
     */
    public function test_destroy_deletes_task(): void
    {
        $this->actingAs($this->user);

        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson(route('tasks.destroy', $task->id));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * @return void
     */
    public function test_title_is_required_without_description_or_completed(): void
    {
        $this->actingAs($this->user);

        $task = Task::factory()->create(['user_id' => $this->user->id]);

        // Test when neither description nor completed are present, title must be provided
        $response = $this->putJson(route('tasks.update', $task->id), [
            'description' => null,
            'completed'   => null,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }
}
