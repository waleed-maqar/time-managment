<div class="d-inline">
    <form>
        <div class="form-check">
            <input class="form-check-input single-step-check" type="checkbox" id="flexCheckDefault"
                data-step="{{ $step->id }}" data-last="{{ $step->lastStep() ? true : false }}"
                data-task="{{ $task->id }}" {{ $step->done ? 'checked' : '' }}>
        </div>
    </form>
</div>
<div class="ml-3" id="single-task-step-{{ $step->id }}">
    @include('includes.loops.singleStep')
</div>
