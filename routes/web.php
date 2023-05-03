<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


function generateSudokuGrid()
{
    // Créer un tableau vide pour représenter la grille
    $grid = array_fill(0, 9, array_fill(0, 9, 0));

    // Remplir la première ligne de la grille avec neuf nombres aléatoires
    $numbers = range(1, 9);
    shuffle($numbers);
    for ($i = 0; $i < 9; $i++) {
        $grid[0][$i] = $numbers[$i];
    }

    // Remplir le reste de la grille
    for ($row = 1; $row < 9; $row++) {
        for ($col = 0; $col < 9; $col++) {
            // Décaler les nombres vers la droite
            for ($i = 8; $i > 0; $i--) {
                $grid[$row][$i] = $grid[$row][$i - 1];
            }
            $grid[$row][0] = $grid[$row - 1][6];
            $grid[$row][1] = $grid[$row - 1][7];
            $grid[$row][2] = $grid[$row - 1][8];

            // Échanger les colonnes 1-3, 4-6 et 7-9 aléatoirement
            for ($i = 0; $i < 3; $i++) {
                $col1 = $i * 3 + rand(0, 2);
                $col2 = $i * 3 + rand(0, 2);
                while ($col2 == $col1) {
                    $col2 = $i * 3 + rand(0, 2);
                }
                $temp = $grid[$row][$col1];
                $grid[$row][$col1] = $grid[$row][$col2];
                $grid[$row][$col2] = $temp;
            }
        }
    }

    // Échanger les rangées et les colonnes pour mélanger la grille
    for ($i = 0; $i < 20; $i++) {
        $row1 = rand(0, 2) * 3 + rand(0, 2);
        $row2 = rand(0, 2) * 3 + rand(0, 2);
        while ($row2 == $row1) {
            $row2 = rand(0, 2) * 3 + rand(0, 2);
        }
        $col1 = rand(0, 2) * 3 + rand(0, 2);
        $col2 = rand(0, 2) * 3 + rand(0, 2);
        while ($col2 == $col1) {
            $col2 = rand(0, 2) * 3 + rand(0, 2);
        }
        $temp = $grid[$row1][$col1];
        $grid[$row1][$col1] = $grid[$row2][$col2];
        $grid[$row2][$col2] = $temp;
    }

    return $grid;
}

Route::get('/', function () {
    // $grids = generateSudokuGrid();
    $puzzle = new Xeeeveee\Sudoku\Puzzle();
    $puzzle->generatePuzzle();
    $puzzle = $puzzle->getPuzzle();
    // dd($puzzle);
    return view('welcome', [
        'sudokuGrid' => $puzzle,
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
