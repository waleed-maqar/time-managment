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
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        return view('includes.pages.taskIndex', compact(['userTasks']));
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param string $pereority
     */
    public function periority(Request $request, $pereority)
    {
        $pages = $request['pages'];
        $tasks = User::find(Auth::id())->tasks()->orderBy('start_date')->where('periority', $pereority);
        return view('includes.parts.periority', compact(['pereority', 'pages', 'tasks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.createTask');
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
            $errors = $request->validator->messages();
            $messages = $errors->messages();
            $showErrors = view('includes.parts.returnMessages', compact(['messages']))->render();
            $data = ['status' => false, 'showErrors' => $showErrors];
            return response()->json($data);
        }
        $request['user_id'] = Auth::id();
        $request['start_date'] .= ' ' . $request['start_time'];
        $request['end_date'] .= ' ' . $request['end_time'];
        $request = $request->except('_token', 'start_time', 'end_time');
        $task = Task::create($request);
        $showTask = view('includes.parts.taskDetails', compact(['task']))->render();
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
        if (!Gate::allows('update', $task->user_id)) {
            abort(403);
        }
        return view('includes.parts.taskDetails', compact(['task']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

        if (!Gate::allows('update', $task->user_id)) {
            abort(403);
        }
        return view('includes.parts.taskUpdate', compact(['task']));
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

        if (!Gate::allows('update', $task->user_id)) {
            abort(403);
        }

        if ($request->validator->fails()) {
            $errors = $request->validator->messages();
            $messages = $errors->messages();
            $showErrors = view('includes.parts.returnMessages', compact(['messages']))->render();
            $data = ['status' => false, 'showErrors' => $showErrors];
            return response()->json($data);
        }
        $request['user_id'] = Auth::id();
        $request['start_date'] .= ' ' . $request['start_time'];
        $request['end_date'] .= ' ' . $request['end_time'];
        $request = $request->except('_token', 'start_time', 'end_time');
        $task->update($request);
        $showTask = view('includes.parts.taskDetails', compact(['task']))->render();
        $data = ['status' => true, 'showTask' => $showTask];
        return response()->json($data);
    }
    //
    public function taskDone(Task $task)
    {

        if (!Gate::allows('update', $task->user_id)) {
            abort(403);
        }

        $task->done_date = Carbon::now()->format('Y-m-d H:i');
        $task->save();
        $task->steps()->update(['done' => true]);
        $tasks = Auth::user()->tasks;
        return view('includes.parts.taskDetails', compact(['tasks', 'task']));
    }
    public function taskNotDone(Task $task, $step)
    {

        if (!Gate::allows('update', $task->user_id)) {
            abort(403);
        }
        $task->done_date = null;
        $task->save();
        if ($step == '0' && $task->allStepsDone()) {
            $task->steps()->update(['done' => 0]);
        }
        $tasks = Auth::user()->tasks;
        return view('includes.parts.taskDetails', compact(['tasks', 'task']));
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

        if (!Gate::allows('update', $task->user_id)) {
            abort(403);
        }
        $task->forceDelete();
        $messages = ['deleted' => ['Task has been DELETED']];
        return view('includes.parts.returnMessages', compact(['messages']));
    }
}