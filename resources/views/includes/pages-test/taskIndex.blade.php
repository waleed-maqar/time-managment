@extends('includes.pages.pageTemplate')
@section('pageTitle')
    <div class="text-center">
        My Tasks
        <span class="btn btn-primary float-left task-sortby-periority">sort by periority</span>
    </div>
@endsection
@section('pageContent')<div class="p-5 task-index-container">
        @forelse ($userTasks as $year=>$months)
            <div class="task-index-year-container">
                <div class="mb-1 period-toggle task-index-year-title" data-period="year-{{ $year }}">
                    <h3>{{ $year }}</h3>
                </div>
                <div
                    class="index-year-tasks  task-index-year-{{ $year }} period-aria {{ $year == \Carbon\Carbon::now()->format('Y') ? 'active' : '' }}">
                    @foreach ($months as $month => $days)
                        <div class="task-index-month-container">
                            <h3 class="period-toggle" data-period="month-{{ $month }}">
                                {{ $month }}
                            </h3>
                            <div
                                class="index-month-tasks task-index-month-{{ $month }} period-aria {{ $month == \Carbon\Carbon::now()->format('M-Y') ? 'active' : '' }}">
                                @foreach ($days as $day => $tasks)
                                    <div class="task-index-day-container">
                                        <h3 class="badge badge-succes period-toggle" data-period="day-{{ $day }}">
                                            {{ $day }}</h3>
                                        <div
                                            class="index-day-tasks task-index-day-{{ $day }} period-aria {{ $day == \Carbon\Carbon::now()->format('d-M-Y') ? 'active' : '' }}">
                                            @foreach ($tasks as $task)
                                                <span class="badge badge-light hour-task-title"
                                                    custom-title="{{ $task->title }} Begins at {{ $task->start_date }}"
                                                    data-task="{{ $task->id }}">
                                                    {{ excerpt($task->title, 5) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="alert alert-danger text-center">
                There is No any Tasks yet
            </div>
        @endforelse
    </div>
@endsection
