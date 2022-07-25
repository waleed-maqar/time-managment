<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\Step;
use App\Models\Task;
use Carbon\Carbon;
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
        $carbon = new Carbon;

        $task = Task::find($request['task']);
        return view('includes.parts.taskSteps', compact(['carbon',  'task']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $carbon = new Carbon;

        $task = Task::find($request['task_id']);
        return view('includes.parts.taskSteps', compact(['carbon',  'task']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $carbon = new Carbon;

        $task = $step->task();
        $step->step = $request['step'];
        $step->save();
        return view('includes.parts.singleStep', compact(['carbon',  'task', 'step']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Step $step)
    {
        $carbon = new Carbon;

        $step->forceDelete();
        $task = $step->task();
        return view('includes.parts.taskSteps', compact(['carbon',  'task']));
    }
    //
    public function stepDone(Step $step)
    {
        $step->done = 1;
        $step->save();
        $carbon = new Carbon;

        $task = $step->task();
        return view('includes.parts.singleStep', compact(['carbon',  'task', 'step']));
    }
    public function stepNotDone(Step $step)
    {
        $step->done = 0;
        $step->save();
        $step->task()->update(['done_date' => null]);
        $carbon = new Carbon;

        $task = $step->task();
        return view('includes.parts.singleStep', compact(['carbon',  'task', 'step']));
    }
}
