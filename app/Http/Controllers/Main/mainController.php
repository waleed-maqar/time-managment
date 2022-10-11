<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;

class mainController extends Controller
{
    public function dateIndexedTasks(Request $request)
    {
        $byYear = function ($task) {
            return Carbon::parse($task->start_date)->format('Y');
        };
        $byMonth = function ($task) {
            return Carbon::parse($task->start_date)->format('M-Y');
        };
        $byDay = function ($task) {
            return Carbon::parse($task->start_date)->format('d-M-Y');
        };
        $userTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->get()->groupBy([$byYear, $byMonth, $byDay]);
        $expiredTasks = User::find(Auth::id())->expiredTasks();
        $date = Carbon::now()->format('Y-m-d');
        return view('index', compact(['date', 'userTasks', 'expiredTasks']));
    }
    //

    public function periorityIndexedTasks()
    {
        $userHighTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', 'high');
        $userNormalTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', 'normal');
        $userLowTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', 'low');
        $userTasks = [
            'high' => $userHighTasks,
            'normal' => $userNormalTasks,
            'low' => $userLowTasks,
        ];
        return view('includes.pages.taskPeriority', compact(['userTasks']));
    }
}