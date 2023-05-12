<?php

namespace App\Http\Controllers;

use App\Models\Grid;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GameController extends Controller
{
    private function getSolutionPuzzel(array $puzzle): array
    {
        $puzzleS = new \Xeeeveee\Sudoku\Puzzle($puzzle);
        $puzzleS->solve();
        return $puzzleS->getSolution();
    }

    private function soldPuzzel(array $sudokuGrid): bool
    {
        $puzzle = new \Xeeeveee\Sudoku\Puzzle();
        $puzzle->setPuzzle($sudokuGrid);
        return $puzzle->isSolved();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Http\RedirectResponse|View
    {

        $puzzle = new \Xeeeveee\Sudoku\Puzzle();
        $difficulty = $request->has('level');
        if ($request->has('level')) {
            match ($difficulty) {
                'easy' => $puzzle->generatePuzzle(25),
                'medium' => $puzzle->generatePuzzle(50),
                'hard' => $puzzle->generatePuzzle(60),
                default => $puzzle->generatePuzzle(40),
            };
        } else {
            $puzzle->generatePuzzle(40);
        }
        $myPuzzle = $puzzle->getPuzzle();

        // Vérifier qu'un puzzle est résoluble
        $puzzleCheck = new \Xeeeveee\Sudoku\Puzzle();
        $puzzleCheck->setPuzzle($myPuzzle);
        if ($puzzleCheck->isSolvable()) {
            //save the puzzle in the database
            $grid = Grid::create([
                'grid' => json_encode($myPuzzle),
                'solution' => json_encode($this->getSolutionPuzzel($myPuzzle)),
                'difficulty' => $difficulty,
            ]);
            return view('game', [
                'sudokuGrid' => $myPuzzle,
                'gridId' => $grid->id,
            ]);
        } else {
            return redirect()->route('game.index');
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'sudokuGrid' => 'required',
            'timer' => 'required',
            'gridId' => 'required',
            'check' => 'required',
        ]);
        $sudokuGrid = (array)json_encode($request->get('sudokuGrid'));
        $timer = Carbon::createFromFormat('H:i:s', $request->get('timer'));
        $gridId = $request->get('gridId');
        //dd($timer->timestamp, $timer->format('s'), $timer->diffInSeconds(Carbon::createFromFormat('H:i:s', '00:00:00')));


        if ($request->check == 'finish') {
            $grid = Grid::find($gridId);
            $grid->attempts()->create([
                'user_id' => auth()->user()->id,
                'attempt' => $sudokuGrid,
                'time' => $timer->diffInSeconds(Carbon::createFromFormat('H:i:s', '00:00:00')),
                'is_solved' => true,
                'is_finished' => false,
            ]);

            if ($this->soldPuzzel($sudokuGrid)) {
                return redirect()->route('history.get')
                    ->with('success', 'Vous avez terminé le sudoku en ' . $timer->format('i:s') . ' !');
            } else {
                return redirect()->route('history.get')
                    ->with('error', 'Vous n\'avez pas pu résoudre le sudoku en ' . $timer->format('i:s') . ' !');
            }

        }

        if ($request->check == 'check') {
            if ($this->soldPuzzel($sudokuGrid)) {
                return back()
                    ->with('success', 'Vous avez terminé le sudoku, en ' . $timer->format('i:s') . ' !, vous pouvez le valider !');
            } else {
                return back()
                    ->with('error', 'Vous n\'avez pas pu résoudre le sudoku, continuez !');
            }
        }

        if ($request->check == 'solve') {
            $grid = Grid::find($gridId);
            return view('game', [
                'sudokuGrid' => json_decode($grid->solution),
                'gridId' => $grid->id,
            ])->with('success', 'Nous vous avons donné la solution !');
        }

        return response()->json([
            'success' => false,
        ]);
    }

    //TODO: A implémenter
//    public function play(Request $request, string $id): \Illuminate\Http\JsonResponse
//    {
//        $puzzle = new \Xeeeveee\Sudoku\Puzzle();
//        $puzzle->generatePuzzle();
//        $puzzle = $puzzle->getPuzzle();
//        return response()->json([
//            'success' => true,
//            'sudokuGrid' => $puzzle,
//        ]);
//    }
}
