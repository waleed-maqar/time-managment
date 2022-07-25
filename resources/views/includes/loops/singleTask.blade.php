<div class="{{ $task->done_date ? 'task-done' : '' }} position-absolute">
    <h6 class="single-task-{{ $task->id }} single-task-title" data-doneSteps={{ $task->notDoneSteps() }}>
        <a href="{{ route('task.show', $task->id) }}">{{ $task->title }}</a>
        <small class="{{ $task->outOfDate() ? 'out-of-date' : '' }} task-end-date"
            task-title="Your task {{ $task->status() }}">
            {{ $task->dateFormat('end_date', 'Y-m-d') }}
        </small>
        <div class="delete-task">
            <form action=" {{ route('task.destroy', $task->id) }}" method="post" class="">
                @csrf @method('Delete')
                <button type=" submit" class="btn btn-danger">X</button>
            </form>
        </div>
    </h6>
    <div class="single-task-steps">
        @foreach ($task->steps()->get() as $step)
            <div class="d-inline">
                <form action="" class="">
                    <div class="form-check">
                        <input class="form-check-input single-step-check" type="checkbox" id="flexCheckDefault"
                            data-step="{{ $step->id }}" data-last="{{ $step->lastStep() ? true : false }}"
                            data-task="{{ $task->id }}" {{ $step->done ? 'checked' : '' }}>
                    </div>
                </form>
            </div>
            <div class="ml-3 d-inline" id="single-task-step-{{ $step->id }}">
                @include('includes.loops.singleStep')
            </div>
            <div class="d-inline">
                <a href="{{ route('delStep', $step->id) }}" class="btn btn-danger btn-sm">x</a>
            </div>
        @endforeach
        @error('step')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="add-new-step">
            <div class="alert alert-light btn show-add-step">+Add Step</div>
            <form method="POST" action="{{ route('addStep') }}" style="display: none;" class="mt-5 add-step-form">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <div class="row">
                    <span class="btn col-1 add-step-form-close">x</span>
                    <div class="col-9 form-group">
                        <input type="text" name="step" class="form-control" placeholder="Add Step">
                    </div>
                    <div class="form-group col-2">
                        <button type="submit" class="form-group btn btn-info">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
