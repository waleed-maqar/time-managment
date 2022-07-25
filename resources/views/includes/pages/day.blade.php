@extends('includes.pages.pageTemplate')
@section('navigator')
    <span class="btn go-to-date float-left" data-duration="Day"
        data-day="{{ \Carbon\Carbon::parse($date)->subDay()->format('Y-m-d') }}">
        prev Day
    </span>
    <span class="btn go-to-date today-navigator" data-duration="Day"
        data-day="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}">
        Go to Today
    </span>
    <span class="btn go-to-date float-right" data-duration="Day"
        data-day="{{ \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d') }}">
        Next Day
    </span>
@endsection
@section('pageTitle')
    <div class="text-center">{{ \Carbon\Carbon::parse($date)->format('l') . ': ' . $date }}
    </div>
@endsection
@section('pageContent')
    <div class="p-5 day-tasks-container" id="day-tasks-container">
        <div class="day-tasks-hours">
            @for ($i = 0; $i <= 23; $i++)
                <div class="px-1">{{ str_repeat(0, 2 - strlen($i)) . $i . ' : 00' }}</div>
            @endfor
        </div>
        <div class="day-tasks-schedule">

            @for ($i = 0; $i <= 23; $i++)
                @php
                    $hourTasksStart = Auth::User()->tasksStartAt($date, $i . ':00');
                    $hourTasksEnd = Auth::User()->tasksEndAt($date, $i . ':00');
                @endphp
                <div class="px-1 day-task">

                    <div class="hour-tasks">
                        <div class="hour-tasks-start">
                            @foreach ($hourTasksStart as $task)
                                <span class="badge badge-light hour-task-title"
                                    custom-title="{{ $task->title }} Begins at {{ $task->start_date }}"
                                    data-task="{{ $task->id }}">
                                    {{ excerpt($task->title, 12) }}
                                </span>
                            @endforeach
                        </div>
                        <div class="hour-tasks-end">
                            @foreach ($hourTasksEnd as $task)
                                <span class="badge badge-dark hour-task-title"
                                    custom-title="{{ $task->title }} Ends at {{ $task->end_date }}"
                                    data-task="{{ $task->id }}">
                                    {{ excerpt($task->title, 12) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
