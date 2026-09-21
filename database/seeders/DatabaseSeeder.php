<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\Label;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test1',
            'email' => 'test1@email.com',
        ]);

        TaskStatus::create(['name' => 'новый']);
        TaskStatus::create(['name' => 'в работе']);
        TaskStatus::create(['name' => 'на тестировании']);
        TaskStatus::create(['name' => 'завершен']);

        Label::create(['name' => 'ошибка']);
        Label::create(['name' => 'доработка']);
        Label::create(['name' => 'срочно']);
    }
}
