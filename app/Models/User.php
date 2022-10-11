<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function expiredTasks()
    {
        return $this->tasks()->whereDate('end_date', '<=', Carbon::parse(now())->format('Y-m-d H:i'))->where('done_date', '=', null)->get();
    }
    public function dayTasks($day)
    {
        return $this->tasks()->whereDate('start_date', '=', $day)->get();
    }
    public function tasksStartAt($date, $time = '00:00')
    {
        $date = $date . ' ' . $time;
        $nDate = Carbon::parse($date)->addHour()->format('Y-m-d H:i');
        return  $this->tasks()->where('start_date', '>=', $date)->where('start_date', '<', $nDate)->get();
    }
    public function tasksEndAt($date, $time = '23:59')
    {
        $date = $date . ' ' . $time;
        $nDate = Carbon::parse($date)->addHour()->format('Y-m-d H:i');
        return  $this->tasks()->where('end_date', '>=', $date)->where('end_date', '<', $nDate)->get();
    }
}