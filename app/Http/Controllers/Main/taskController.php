<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Helpers\Helper;
use App\Http\Requests\stepRequest;
use App\Http\Requests\taskRequest;
use App\Models\Task;
use App\Models\Step;
use App\Models\User;

class taskController extends Controller
{
    public function __construct()
    {
        $this->middleware('taskOwner', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        // return view('transit.taskindex', compact(['carbon',  'userTasks']));
        return view('includes.pages.taskIndex', compact(['carbon',  'userTasks']));
    }
    public function taskPeriority()
    {
        $carbon = new Carbon;

        $userHighTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', 'high');
        $userNormalTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', 'normal');
        $userLowTasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', 'low');
        $userTasks = [
            'high' => $userHighTasks,
            'normal' => $userNormalTasks,
            'low' => $userLowTasks,
        ];
        return view('includes.pages.taskPeriority', compact(['carbon',  'userTasks']));
    }
    public function periority(Request $request, $pereority)
    {
        $carbon = new Carbon;

        $pages = $request['pages'];
        $tasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', $pereority);
        return view('includes.parts.periority', compact(['carbon',  'pereority', 'pages', 'tasks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carbon = new Carbon;
        return view('calendar.createTask', compact(['carbon']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(taskRequest $request)
    {
        if ($request->validator->fails()) {
            $carbon = new Carbon;

            $errors = $request->validator->messages();
            $messages = $errors->messages();
            $showErrors = view('includes.parts.returnMessages', compact(['carbon',  'messages']))->render();
            $data = ['status' => false, 'showErrors' => $showErrors];
            return response()->json($data);
        }
        $request['user_id'] = Auth::id();
        $request['start_date'] .= ' ' . $request['start_time'];
        $request['end_date'] .= ' ' . $request['end_time'];
        $request = $request->except('_token', 'start_time', 'end_time');
        $carbon = new Carbon;

        $task = Task::create($request);
        $showTask = view('includes.parts.taskDetails', compact(['carbon',  'task']))->render();
        $data = ['status' => true, 'showTask' => $showTask];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $carbon = new Carbon;

        // return view('transit.taskDetails', compact(['carbon',  'task']));
        return view('includes.parts.taskDetails', compact(['carbon',  'task']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $carbon = new Carbon;

        $messages = [];
        return view('includes.parts.taskUpdate', compact(['carbon',  'task', 'messages']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(taskRequest $request, Task $task)
    {
        $carbon = new Carbon;

        if ($request->validator->fails()) {
            $errors = $request->validator->messages();
            $messages = $errors->messages();
            $showErrors = view('includes.parts.returnMessages', compact(['carbon',  'messages']))->render();
            $data = ['status' => false, 'showErrors' => $showErrors];
            return response()->json($data);
        }
        $request['user_id'] = Auth::id();
        $request['start_date'] .= ' ' . $request['start_time'];
        $request['end_date'] .= ' ' . $request['end_time'];
        $request = $request->except('_token', 'start_time', 'end_time');
        $task->update($request);
        $showTask = view('includes.parts.taskDetails', compact(['carbon',  'task']))->render();
        $data = ['status' => true, 'showTask' => $showTask];
        return response()->json($data);
    }
    //
    public function taskDone(Task $task)
    {
        $carbon = new Carbon;

        $task->done_date = Carbon::now()->format('Y-m-d H:i');
        $task->save();
        $task->steps()->update(['done' => true]);
        $tasks = Auth::user()->tasks;
        return view('includes.parts.taskDetails', compact(['carbon',  'tasks', 'task']));
    }
    public function taskNotDone(Task $task, $step)
    {
        $carbon = new Carbon;

        $task->done_date = null;
        $task->save();
        if ($step == '0' && $task->allStepsDone()) {
            $task->steps()->update(['done' => 0]);
        }
        $tasks = Auth::user()->tasks;
        return view('includes.parts.taskDetails', compact(['carbon',  'tasks', 'task']));
    }
    // for steps


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->forceDelete();
        $messages = ['deleted' => ['Task has been DELETED']];
        return view('includes.parts.returnMessages', compact(['messages']));
    }
}
