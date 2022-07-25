@if (count($task->steps()->get()) != 0)
    <div class="container">
        @foreach ($task->steps()->get() as $step)
            <form action="{{ route('step.update', $step->id) }}" method="POST" class="step-edit-form"
                id="edit-step-{{ $step->id }}">
                @include('includes.parts.singleStep')
            </form>
        @endforeach
    </div>
@endif
<form action="post" class="m-auto new-step-form">
    @csrf
    <div class="row form-group">
        <input type="hidden" name="step" class="offset-1 col-10 mt-3 form-control new-step-name"
            data-task="{{ $task->id }}">
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <button class="offset-2 col-8 mt-3 form-control add-step-button">+add step</button>
    </div>
</form>
