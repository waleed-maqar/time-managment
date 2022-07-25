<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;

class CalendarController extends Controller
{

    public function day(Request $request, $date)
    {
        $expiredTasks = User::find(Auth::id())->expiredTasks();
        if ($request->ajax()) {
            return view('includes.pages.day', compact(['date', 'expiredTasks']));
        }
        return view('includes.pages-test.day', compact(['date', 'expiredTasks']));
    }
    public function week($date)
    {

        $date = $date ?? Carbon::now()->format('Y-m-d');
        $weekStart = Carbon::parse($date)->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $weekEnd = Carbon::parse($date)->endOfWeek()->format('Y-m-d');
        $messages = [];
        return view('includes.pages.week', compact(['date', 'weekStart', 'weekEnd', 'messages']));
    }
    public function month($date)
    {


        $daysNumber = Carbon::parse($date)->daysInMonth;
        $month = Carbon::parse($date)->format('Y-m');
        $messages = [];
        return view('includes.pages.month', compact(['date', 'daysNumber', 'month', 'messages']));
    }
    public function year($date)
    {


        $messages = [];
        $year = Carbon::parse($date)->format('Y');
        return view('includes.pages.year', compact(['messages', 'date', 'year']));
    }
}