@extends('includes.mainTemplate')
@section('content')
    <div class="card p-4 task-show-card">
        <div class="row">
            <div class="col-4">
                <div class="d-inline">
                    <form action="" class="">
                        <div class="form-check">
                            <input class="form-check-input single-task-check taskCheck-{{ $task->id }}" type="checkbox"
                                id="flexCheckDefault" data-task="{{ $task->id }}" data-done="{{ $task->done_date }}"
                                {{ $task->done_date ? 'checked' : '' }}>
                        </div>
                    </form>
                </div>
                <div class="d-inline-block ml-3" id="task-index-single-{{ $task->id }}">
                    @include('includes.loops.singleTask')
                </div>
            </div>
            <div class="col-8 card-body">
                <p>{{ $task->description }}</p>
            </div>
        </div>
    </div>
@endsection
