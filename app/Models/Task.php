<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id', 'description', 'periority', 'start_date', 'end_date', 'done_date'];
    protected $cats = [
        'start_date' => 'date:Y-m-d H:i',
        'end_date' => 'date:Y-m-d H:i',
        'done_date' => 'date:Y-m-d H:i'
    ];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    public function notDoneSteps()
    {
        $notDone = [];
        foreach ($this->steps()->get() as $step) {
            if (!$step->done) {
                $notDone[] = $step;
            }
        }
        return count($notDone);
    }
    public function allStepsDone()
    {
        if ($this->notDoneSteps() == 0) {
            return true;
        }
        return false;
    }
    public function dateFormat($col, $format)
    {
        return Carbon::parse($this->$col)->format($format);
    }

    public function outOfDate()
    {
        if ($this->done_date == null && $this->end_date <= Carbon::parse(now())->format('Y-m-d H:i')) {
            return true;
        }
    }
    public function status()
    {
        $status = '';
        if ($this->done_date) {
            $status = 'has been done';
        } elseif ($this->outOfDate()) {
            $status = 'is out of date';
        } else {
            $status = 'is still on date';
        }
        return $status;
    }
}