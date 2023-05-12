<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAttempt;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): View
    {

        $records = UserAttempt::query()
            ->with(['user'])
            ->orderByRaw('time');
        //"select * from `user_attempts` order by `time` desc"
        return view('welcome', [
            'users' => $records->get(),
        ]);
    }


    public function history(Request $request): View
    {

        $histories = UserAttempt::query()
            ->with(['user'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('history', [
            'histories' => $histories,
        ]);
    }
}
