<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\BoardReply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardReply>
 */
class BoardReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $this->call('BoardSeeder');
        $board_id = Board::all()->pluck("id")->random();

        $board_reply = BoardReply::where("board_id", $board_id)->first();

        $b_re_deep = 0;
        $b_re_sort = 1;

        if( !is_null($board_reply)) {
            $b_re_deep = (int)$board_reply->deep + 1;
            $b_re_sort = (int)$board_reply->re_sort + 1;
        }

        return [
            "user_id"=> User::all()->pluck('id')->random(),
            "board_id"=> $board_id,
            // 'deep'=> 1,
            'deep'=> $b_re_deep,
            're_sort'=> $b_re_sort,
            // 're_sort'=> (int)$board_reply->re_sort++,
            'comment'=> $this->faker->realText(),
        ];
    }
}
