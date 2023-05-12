<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grid>
 */
class GridFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grid = $this->createSudeku();
        $resold = $this->getSolutionPuzzel($grid);
        return [
            'grid' => json_encode($grid),
            'solution' => json_encode($resold),
            'difficulty' => 'easy',
        ];
    }

    private function createSudeku()
    {
        $puzzle = new \Xeeeveee\Sudoku\Puzzle();
        $puzzle->generatePuzzle(25);
        return $puzzle->getPuzzle();
    }

    private function getSolutionPuzzel(array $puzzle): array
    {
        $puzzleS = new \Xeeeveee\Sudoku\Puzzle($puzzle);
        $puzzleS->solve();
        return $puzzleS->getSolution();
    }
}
