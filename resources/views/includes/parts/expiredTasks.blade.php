<div class="h3">
    Your Expired Tasks
    <span class="btn btn-dark w-25 float-right element-close" data-element=".expired-tasks">X</span>
</div>
<div class="">
    @foreach ($expiredTasks as $task)
        <span class="badge badge-danger hour-task-title" custom-title="{{ $task->title }} End at {{ $task->end_date }}"
            data-task="{{ $task->id }}">
            {{ excerpt($task->title, 5) }}
        </span>
    @endforeach
</div>
