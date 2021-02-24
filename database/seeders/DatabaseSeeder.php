<?php

namespace Database\Seeders;

use \App\Models\{User, Task};
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
        User::factory(5)->create();
        Task::factory(15)->create();
    }
}
