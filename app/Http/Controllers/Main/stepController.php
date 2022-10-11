<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\Task;
use Illuminate\Http\Request;

class stepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $task = Task::find($request['task']);
        return view('includes.parts.taskSteps', compact(['task']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->except('_token');
        Step::create($request);
        $task = Task::find($request['task_id']);
        return view('includes.parts.taskSteps', compact(['task']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Step $step)
    {
        $task = $step->task();
        $step->step = $request['step'];
        $step->save();
        return view('includes.parts.singleStep', compact(['task', 'step']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Step $step)
    {
        $step->forceDelete();
        $task = $step->task();
        return view('includes.parts.taskSteps', compact(['task']));
    }
    //
    public function stepDone(Step $step)
    {
        $step->done = 1;
        $step->save();
        $task = $step->task();
        return view('includes.parts.singleStep', compact(['task', 'step']));
    }
    public function stepNotDone(Step $step)
    {
        $step->done = 0;
        $step->save();
        $step->task()->update(['done_date' => null]);

        $task = $step->task();
        return view('includes.parts.singleStep', compact(['task', 'step']));
    }
}