<div class="card mx-auto p-3 mt-5 hour-task-details">
    <h4 class="card-title {{ $task->done_date ? 'hour-task-done-title' : '' }}">
        <span class="btn element-toggle" data-element="#steps-of-task-{{ $task->id }}"><i
                class="fa-solid fa-arrow-down-short-wide"></i></span>
        <form class="d-inline taskcheck-{{ $task->id }}" data-doneSteps={{ $task->notDoneSteps() }}>
            <input type="checkbox" data-task="{{ $task->id }}" class="task-done-check"
                {{ $task->done_date ? 'checked' : '' }}>
        </form>
        {{ $task->title }}
        <span class="btn btn-dark w-25 float-right hour-task-details-close">X</span>
        <span class="btn d-inline hour-task-edit" data-task="{{ $task->id }}"><i
                class="fa-solid fa-pen-to-square"></i>
        </span>
        <form method="post" class="d-inline" id="delete-task-form">
            @csrf @method('delete')
            <button type="submit" class="btn btn-danger hour-task-delete" data-task="{{ $task->id }}"
                data-day="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </form>
        @if ($task->outOfDate())
            <span class="badge badge-danger" custom-title="Your task is out of date">Expired</span>
        @endif
    </h4>
    <div>
    </div>
    <div class="mt-4 ml-1 task-steps" id="steps-of-task-{{ $task->id }}">
        @include('includes.parts.taskSteps')
    </div>
    <p class="card-body">{{ $task->description }}</p>
    <div class="position-absolute alert alert-dark ml-auto task-details-dates">
        <small>
            From:
            {{ $task->start_date }}
        </small>
        <small>
            To:
            {{ $task->end_date }}
        </small>
    </div>
</div>
