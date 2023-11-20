<?php

namespace Database\Seeders;

use App\Models\BoardReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BoardReply::factory()->count(30)->create();
    }
}
