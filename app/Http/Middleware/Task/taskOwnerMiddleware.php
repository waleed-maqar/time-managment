<?php

namespace App\Http\Middleware\Task;

use App\Models\Task;
use Closure;
use Illuminate\Support\Facades\Auth;

class taskOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $taskId = request()->segment(count(request()->segments()));
        $task = Task::findOrFail($taskId);
        $user = $task->owner();
        if (Auth::user() && Auth::id() == $user->id) {
            return $next($request);
        }
        return redirect(route('homepage'));
    }
}