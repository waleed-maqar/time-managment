<form action="{{ route('task.update', $task->id) }}" id="update-task-form" method="POST">
    <h4>
        <b>Update</b>
        <u>{{ $task->title }}</u>
        <span class="btn btn-dark float-right element-close" data-element=".update-task">X</span>
    </h4>
    @csrf @method('PUT')
    <div class="row">

        @if ($messages)
            <ul class="offset-2 col-8">
                @foreach ($messages as $error)
                    @foreach ($error as $message)
                        <li class="list-group-item list-group-item-danger">{{ $message }}</li>
                    @endforeach
                @endforeach
            </ul>
            <div class="offset-2"></div>
        @endif
        <h4 class="col-2">Task</h4>
        <div class="form-group col-4">
            <input type="text" class="form-control" name="title" value="{{ $task->title }}">
        </div>
        <h4 class="col-2">Periority</h4>
        <div class="col-4 form-group">
            <select name="periority" class="form-control">
                <option value="low" {{ $task->periority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="normal" {{ $task->periority == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="high" {{ $task->periority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>
        <h4 class="col-2">From</h4>
        <div class=" col-4 form-group">
            <input type="date" name="start_date"
                value="{{ \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') }}" class="form-control"
                min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
        </div>
        <div class="col-4 form-group" min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
            <input type="time" name="start_time"
                value="{{ \Carbon\Carbon::parse($task->start_date)->format('H:i') }}" class="form-control">
        </div>
        <div class="offset-2"></div>
        <h4 class="col-2">To</h4>
        <div class=" col-4 form-group">
            <input type="date" name="end_date"
                value="{{ \Carbon\Carbon::parse($task->end_date)->format('Y-m-d') }}" class="form-control">
        </div>
        <div class="col-4 form-group">
            <input type="time" name="end_time" value="{{ \Carbon\Carbon::parse($task->end_date)->format('H:i') }}"
                class="form-control">
        </div>
        <div class="offset-2"></div>
        <h4 class="col-2">Discription</h4>
        <div class="form-group col-8">
            <textarea class="form-control" rows="6" name="description">{{ $task->description }}</textarea>
        </div>
        <div class="col-6 form-group">
            <button type="submit" class="form-control btn btn-success" id="update-task-submit"
                data-task="{{ $task->id }}"><strong>Update
                    Task</strong></button>
        </div>
    </div>
</form>
