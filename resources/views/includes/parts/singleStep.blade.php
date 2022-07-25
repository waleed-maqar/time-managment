@csrf @method('PUT')
<input type="checkbox" class="step-done-check" name="done" data-step="{{ $step->id }}"
    data-task="{{ $task->id }}" {{ $step->done ? 'checked' : '' }}>
<label class="task-step-name {{ $step->done ? 'checked' : '' }}"
    data-step="{{ $step->id }}">{{ $step->step }}</label>
<input type="hidden" class="d-inline form-control change-step-name" name="step" value="{{ $step->step }}"
    id="step-{{ $step->id }}" data-step="{{ $step->id }}" data-task="{{ $task->id }}">
<button class="btn step-delete-button" data-step="{{ $step->id }}" data-task="{{ $task->id }}">X</button>
