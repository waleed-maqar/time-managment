@extends('includes.mainTemplate')
@section('content')
    <div class="add-task-form w-50 m-auto">
        <form action="{{ route('task.store') }}" method="post">
            @csrf
            <div class="row">
                <h3 class="col-3">Task</h3>
                <div class="form-group col-4">
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="offset-5"></div>
                <h3 class="col-3">Periority</h3>
                <div class="col-3 form-group">
                    <select name="periority" class="form-control">
                        <option value="low">Low</option>
                        <option value="normal" selected>Normal</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="offset-6"></div>
                <h3 class="col-3">Discription</h3>
                <div class="form-group col-6">
                    <textarea class="form-control" rows="6" name="description"></textarea>
                </div>
                <div class="offset-3"></div>
                <h3 class="col-3">From</h3>
                <div class=" col-6 form-group">
                    <input type="date" name="start_date" value="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}"
                        class="form-control" min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
                </div>
                <div class="col-3 form-group" min="{{ \Carbon\Carbon::parse(now())->startOfYear()->format('Y-m-d') }}">
                    <input type="time" name="start_time" value="{{ \Carbon\Carbon::parse(now())->format('H:i') }}"
                        class="form-control">
                </div>
                <h3 class="col-3">To</h3>
                <div class=" col-6 form-group">
                    <input type="date" name="end_date" value="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}"
                        class="form-control">
                </div>
                <div class="col-3 form-group">
                    <input type="time" name="end_time"
                        value="{{ \Carbon\Carbon::parse(now()->addMinutes(30))->format('H:i') }}" class="form-control">
                </div>
                <div class="col-5 form-group">
                    <button type="submit" class="form-control btn btn-secondary"><strong>Add Task</strong></button>
                </div>
            </div>
        </form>
    </div>
@endsection
