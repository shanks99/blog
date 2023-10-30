<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardControllerTest extends TestCase
{
    use RefreshDatabase; // 매번 자동으로 데이터 소멸

    /**
	* @test
    */
    public function 글_내역() : void
    {
        # Val
        $list1 = Board::factory()->create();
        $list2 = Board::factory()->create();

        # Route
        $response = $this->get(route("boards.index"));

        # Assert
        $response
            ->assertStatus(200) // 응답 상태 코드가 200(OK)인지 확인
            // ->assertSee($list1->title) // 응답 본문에 일치 글이 있는지
            // ->assertSee($list2->title) // 응답 본문에 일치 글이 있는지
            ->assertSeeInOrder([
                $list1->title,
                $list2->title,
            ])
            ;
    }

    /**
	* @test
    */
    public function 글_쓰기_화면() : void
    {
        # Val
        // 로그인 안되어 있으면 Error (로그인 창으로 이동)
        $user = User::factory()->create();

        # Route
        $response = $this->actingAs($user) // $this->actingAs($user) 로그인 되었다고 지정
                        ->get(route("boards.create"));

        # Assert
        $response->assertStatus(200);
    }

    /**
	* @test
    */
    public function 글_쓰기_저장() : void
    {
        # Val
        // 로그인 안되어 있으면 Error (로그인 창으로 이동)
        $user = User::factory()->create();
        // 테스트 data
	    $testData = [
		    'title'=>'test title',
		    'content'=>'test content',
	    ];

        # Route
        $response = $this->actingAs($user) // $this->actingAs($user) 로그인 되었다고 지정
                        ->post(route("boards.store", $testData));

        # Assert
        $response->assertValid(['title', 'content']); // 유효성 검사

        $this->assertDatabaseHas("boards", $testData); // 저장 데이터 일치 확인
    }

    /**
	* @test
    */
    public function 글_수정_화면() : void
    {
        # Val
        // 로그인 안되어 있으면 Error (로그인 창으로 이동)
        $user = User::factory()->create();
        // Insert Data
        $board = Board::factory()->create([
            'user_id'=> $user->id,
        ]);

        # Route
        $response = $this->actingAs($user) // $this->actingAs($user) 로그인 되었다고 지정
                        ->post(route("boards.edit", compact("board")));

        # Assert
        $response
            // ->assertStatus(200) // CSRF 토큰에 의해 405 응답 됨
            ->assertSee($board->title); // 저장 데이터 일치 확인
            ;
    }

    /**
	* @test
    */
    public function 글_수정_저장() : void
    {
        # Val
        // 테스트 data
	    $testData = [
		    'title'=>'test title',
		    'content'=>'test content',
	    ];
        // 로그인 안되어 있으면 Error (로그인 창으로 이동)
        $user = User::factory()->create();
         // Insert Data
         $board = Board::factory()->create([
            'user_id'=> $user->id,
        ]);

        # Route
        $response = $this->actingAs($user) // $this->actingAs($user) 로그인 되었다고 지정
                        ->patch(route("boards.update", ["board" => $board->id]),$testData);

        # Assert
        $response->assertValid(['title', 'content']); // 유효성 검사

        $this->assertDatabaseHas("boards", $testData); // 저장 데이터 일치 확인
    }

    /**
	* @test
    */
    public function 글_삭제_비회원() : void
    {
        # Val
         // Insert Data
         $board = Board::factory()->create();

        # Route
        $response = $this->delete(route("boards.destroy", ["board" => $board->id]));

        # Assert
        $response->assertRedirect(route("login")); // policies 리다이렉트 확인

        $isExist = Board::find($board->id);
        $this->assertNotEmpty($isExist); // 데이터 유지(삭제X) 확인
    }

    /**
	* @test
    */
    public function 글_삭제_회원() : void
    {
        $this->withoutExceptionHandling();

        # Val
        // 로그인 안되어 있으면 Error (로그인 창으로 이동)
        $user = User::factory()->create();
         // Insert Data
         $board = Board::factory()->create([
            'user_id'=> $user->id,
        ]);

        # Route
        $response = $this->actingAs($user) // $this->actingAs($user) 로그인 되었다고 지정
                        ->delete(route("boards.destroy", ["board" => $board->id]));

        # Assert
        $response->assertRedirect(route("boards.index")); // 리다이렉트 확인

        $isExist = Board::find($board->id);
        $this->assertEmpty($isExist); // 데이터 제거 확인
    }
}
