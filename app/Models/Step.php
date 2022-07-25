<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Step extends Model
{
    protected $fillable = ['step', 'task_id', 'done'];

    public function task()
    {
        return $this->belongsTo(Task::class)->first();
    }
    public function siblings()
    {
        return $this->task()->steps()->where('id', '!=', $this->id)->get();
    }
    public function lastStep()
    {
        $doneSteps = [];
        foreach ($this->siblings() as $step) {
            if (!$step->done) {
                $doneSteps[] = $step;
            }
        }
        if (empty($doneSteps)) {
            return true;
        }
    }
    public function doneSteps()
    {
        $doneSteps = [];
        foreach ($this->siblings() as $step) {
            if (!$step->done) {
                $doneSteps[] = $step;
            }
        }
        return count($doneSteps);
    }
}