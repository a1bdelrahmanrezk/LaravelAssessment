<?php

namespace Database\Seeders;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->pluck('id')->toArray();
        for($i = 0; $i < 10; $i++) {
            Task::create([
                'title' => fake()->name(),
                'status' => TaskStatus::cases()[rand(0, count(TaskStatus::cases()) - 1)]->value,
                'user_id' => $users[rand(0, count($users) - 1)],
            ]);
        }
    }
}
