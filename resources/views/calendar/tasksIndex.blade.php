@extends('includes.mainTemplate')
@section('content')
    @foreach ($tasks as $task)
        <div class="tasks-index-single-container">
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
    @endforeach
@endsection
