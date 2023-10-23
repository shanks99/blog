<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    /**
     * @Test
     */
    public function 글쓰기(): void
    {
        $testData = [
            'content' => 'test 글 작성'
        ];

        $user = User::factory()->create();

        $this->post(
            route("todos.store"),
            $testData
        )->assertRedirect(route('todos.index')); // 응답 200

        $this->assertDatabaseHas('todos', $testData);
    }
}
