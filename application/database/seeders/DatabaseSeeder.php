<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TaskCategory::class);
        $this->call(TaskKind::class);
        $this->call(TaskResolution::class);
        $this->call(TaskStatus::class);

        \App\Models\User::factory(10)
            ->hasProjects(3)
            ->create();

        \App\Models\Task::factory(100)->create();

        \App\Models\TaskComment::factory(200)->create();

        \App\Models\TaskPicture::factory(50)->create();
    }
}
