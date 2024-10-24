<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thread::truncate();
        Reply::truncate();
        $threads = Thread::factory(10)->create();;

        foreach ($threads as $thread) {
            Reply::factory(5)->create(['thread_id' => $thread->id]);
        }
    }
}
