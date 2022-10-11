<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;

class CalendarController extends Controller
{

    public function day($date)
    {
        return view('includes.pages.day', compact(['date']));
    }
    //
    public function week($date)
    {
        $weekStart = Carbon::parse($date)->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $weekEnd = Carbon::parse($date)->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');
        return view('includes.pages.week', compact(['date', 'weekStart', 'weekEnd']));
    }
    //
    public function month($date)
    {
        $month = Carbon::parse($date)->format('Y-m');
        $daysNumber = Carbon::parse($date)->daysInMonth;
        return view('includes.pages.month', compact(['date', 'month', 'daysNumber']));
    }
    //
    public function year($date)
    {
        $year = Carbon::parse($date)->format('Y');
        return view('includes.pages.year', compact(['date', 'year']));
    }
}