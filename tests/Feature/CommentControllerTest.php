<?php

namespace Tests\Feature;

use App\Models\todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @Test
     */
    public function 댓글등록(): void
    {
        $user = User::factory()->create();
        $todo = todo::factory()->create();

        $payload = [
            'todo_id'=> $todo->id,
            "body" => "re content",
        ];

        $this->actingAs($user)
            ->post(route('comments.store'),$payload)
            ->assertStatus(302)
            ->assertRedirectToRoute('todos.show', [$todo->id])
            ->assertSee('글쓰기');

        $this->assertDatabaseHas('comments',$payload);
    }
}
