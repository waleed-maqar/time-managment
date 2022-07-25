<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Helpers\Helper;
use App\Mail\testMail;
use App\Models\User;
use App\Notifications\testNote;
use Carbon\CarbonPeriod;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class mainController extends Controller
{
    public function __construct()
    {
        // $this->middleware('verified');
    }

    public function homePage(Request $request)
    {
        $carbon = new Carbon;

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
        return view('index', compact(['carbon',  'date', 'userTasks', 'expiredTasks']));
    }
}