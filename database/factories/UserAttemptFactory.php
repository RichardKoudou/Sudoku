<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAttempt>
 */
class UserAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grid = $this->createSudeku();
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'grid_id' => $this->faker->numberBetween(1, 10),
            'attempt' => json_encode($grid),
            'time' => $this->faker->numberBetween(0, 1000),
            'is_finished' => $this->faker->boolean,
            'is_solved' => $this->faker->boolean,
        ];
    }

    private function createSudeku()
    {
        $puzzle = new \Xeeeveee\Sudoku\Puzzle();
        $puzzle->generatePuzzle(25);
        return $puzzle->getPuzzle();
    }
}
