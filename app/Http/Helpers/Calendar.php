<?php

namespace App\Http\Helpers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Carbon;

class Calendar
{

    public static function tasksStartAt($date, $time = '00:00')
    {
        $date = $date . ' ' . $time;
        $nDate = Carbon::parse($date)->addHour()->format('Y-m-d H:i');
        return  User::find(Auth::id())->tasks()->where('start_date', '>=', $date)->where('start_date', '<', $nDate)->get();
    }
    public static function tasksEndAt($date, $time = '23:59')
    {
        $date = $date . ' ' . $time;
        $nDate = Carbon::parse($date)->addHour()->format('Y-m-d H:i');
        return  User::find(Auth::id())->tasks()->where('end_date', '>=', $date)->where('end_date', '<', $nDate)->get();
    }
    public static function showYears($start, $end)
    {
        $years = [];
        for ($i = $start; $i <= $end; $i++) {
            $years[$i] = [];
            for ($j = 1; $j <= 12; $j++) {
                $years[$i][$j] = Carbon::parse("$i-$j-1")->daysInMonth;
            }
        }
        return $years;
    }
    public static function showHourTasksStart($day, $hour)
    {
        return  User::find(Auth::id())->tasks()->whereDate('start_date', $day)->whereTime('start_time', 'like', '%' . $hour . '%')->get();
    }
    public static function showHourTasksEnd($day, $hour)
    {
        return  User::find(Auth::id())->tasks()->whereDate('end_date', $day)->whereTime('end_time', 'like', '%' . $hour . '%')->get();
    }
    public static function showDayTasks($day)
    {
        return  User::find(Auth::id())->tasks()->whereDate('start_date', '=', $day)->get();
    }
    public function getName()
    {
    }
    public function setHelperSet()
    {
    }
}