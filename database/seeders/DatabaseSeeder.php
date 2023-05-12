<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Grid;
use App\Models\User;
use App\Models\UserAttempt;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory(10)->create();
        Grid::factory(10)->create();
        $grids = Grid::all()->pluck('id')->toArray();
        User::all()->each(function (User $user) use ($grids) {
            UserAttempt::factory(10)->create([
                'user_id' => $user->id,
                'grid_id' => $grids[array_rand($grids)],
            ]);
        });
    }
}
