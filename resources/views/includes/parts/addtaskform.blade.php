<form action="{{ route('task.store') }}" class="new-task-form" id="add-task-form" method="POST">
    <h4>
        Add New Task
        <span class="btn btn-dark float-right element-close" data-element=".add-new-task">X</span>
    </h4>
    @csrf
    <div class="row">
        <h4 class="col-2">Task</h4>
        <div class="form-group col-4">
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        </div>
        <h4 class="col-2">Periority</h4>
        <div class="col-4 form-group">
            <select name="periority" class="form-control">
                <option value="low">Low</option>
                <option value="normal" selected>Normal</option>
                <option value="high">High</option>
            </select>
        </div>
        <h4 class="col-2">From</h4>
        <div class=" col-4 form-group">
            <input type="date" name="start_date" value="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}"
                class="form-control" min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
        </div>
        <div class="col-4 form-group" min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
            <input type="time" name="start_time" value="{{ \Carbon\Carbon::parse(now())->format('H:i') }}"
                class="form-control">
        </div>
        <div class="offset-2"></div>
        <h4 class="col-2">To</h4>
        <div class=" col-4 form-group">
            <input type="date" name="end_date" value="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}"
                class="form-control" min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
        </div>
        <div class="col-4 form-group">
            <input type="time" name="end_time"
                value="{{ \Carbon\Carbon::parse(now()->addMinutes(30))->format('H:i') }}" class="form-control">
        </div>
        <div class="offset-2"></div>
        <h4 class="col-2">Discription</h4>
        <div class="form-group col-8">
            <textarea class="form-control" rows="6" name="description"></textarea>
        </div>
        <div class="col-6 form-group">
            <button type="submit" class="form-control btn btn-primary" id="add-task-submit"><strong>Add
                    Task</strong></button>
        </div>
    </div>
</form>
