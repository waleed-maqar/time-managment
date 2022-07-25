@extends('includes.pages.pageTemplate')
@section('pageTitle')
    <div class="text-center">
        My Tasks
        <span class="btn btn-primary float-left task-sortby-year">sort by year</span>
    </div>
@endsection
@section('pageContent')
    <div class="p-5 task-index-container">
        @forelse ($userTasks as $pereority=>$tasks)
            <div class="task-pereority-container" id="tasks-with-{{ $pereority }}-pereority">
                <h1>Tasks with {{ $pereority }} pereority</h1>
                @if (count($tasks->get()) > 3)
                    <span class="btn tasks-periority-paginate tasks-seemore" data-per="{{ $pereority }}" data-pages="6">see
                        more</span>
                @endif
                @forelse ($tasks->paginate(3) as $task)
                    <span class="badge badge-{{ $task->outOfDate() ? 'danger' : 'light' }} hour-task-title"
                        custom-title="{{ $task->title }} Begins at {{ $task->start_date }}"
                        data-task="{{ $task->id }}">
                        {{ excerpt($task->title, 5) }}
                    </span>
                @empty
                    <div class="alert alert-danger text-center">
                        There is No any Tasks yet
                    </div>
                @endforelse
            </div>
        @empty
        @endforelse
    </div>
@endsection
