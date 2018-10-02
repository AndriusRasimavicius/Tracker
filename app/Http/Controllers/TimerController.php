<?php

namespace App\Http\Controllers;

use App\Timer;
use App\Task;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class TimerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tasks = Task::all()->where('user_id', auth()->user()->id);
        $projects = Project::all();
        return view('addTimer', ['tasks' => $tasks , 'projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'task_id' => 'required',
        ],
            [
                'task_id.required' => 'Nebuk molis, pasirink uzduoti'
            ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        if(!ctype_digit($request->task_id)) {
            $task = new Task();
            $task->title = $request->task_id;
            $task->project_id = $request->project_id;
            $task->user_id = Auth()->user()->id;
            $task->save();
            $task = $task->id;
        }else {
            $task = $request->task_id;
        }
            $date_range = $request->datetimes;
            $dates = explode("-", $date_range);

            $timer = New Timer();
            $timer->task_id = $task;
            $timer->project_id = $request->project_id;
            $timer->started_at = $dates[0];
            $timer->stopped_at = $dates[1];
            $timer->save();

            $timers = Timer::find($timer->id);
            $timers->total_time = (new Carbon($timers->started_at))->diffInSeconds(new Carbon($timers->stopped_at));
            $timers->save();


        return redirect()->route('tasks.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showTimer(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'task_id' => 'required',
        ],
            [
                'task_id.required' => 'Nebuk molis, pasirink uzduoti'
            ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }
        if(!ctype_digit($request->task_id)) {
            $task = new Task();
            $task->title = $request->task_id;
            $task->project_id = $request->project_id;
            $task->user_id = Auth()->user()->id;
            $task->save();
            $task = $task->id;
        }else{
            $task = $request->task_id;
        }
            $timer = New Timer();
            $timer->task_id = $task;
            $timer->project_id = $request->project_id;
            $timer->started_at = new Carbon();
            $timer->save();

        $timers = Timer::where('id',$timer->id)->with('task')->get();

        return view('timer', ['timers' => $timers]);
    }

    /**
     * Stop the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function stopTimer($id)
    {
        $timer = Timer::find($id);
        $timer->stopped_at = new Carbon();
        $timer->total_time = (new Carbon($timer->started_at))->diffInSeconds(new Carbon($timer->stopped_at));
        $timer->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function edit(Timer $timer)
    {
        return view('edittimer', ['timer' => $timer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timer $timer)
    {
        $date_range = $request->datetimes;
        $dates = explode("-", $date_range);

        $timer->started_at = $dates[0];
        $timer->stopped_at = $dates[1];
        $timer->save();

        $timers = Timer::find($timer->id);
        $totals = (new Carbon($timers->started_at))->diffInSeconds(new Carbon($timers->stopped_at));
        $timers->total_time = $totals;
        $timers->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timer $timer)
    {
        $timer->delete();

        return redirect()->route('tasks.index');
    }
}
