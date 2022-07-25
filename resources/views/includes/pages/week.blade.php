@extends('includes.pages.pageTemplate')

@section('navigator')
    <span class="btn go-to-date float-left" data-duration="Week"
        data-day="{{ \Carbon\Carbon::parse($date)->subWeek()->format('Y-m-d') }}">
        prev Week
    </span>
    <span class="btn go-to-date today-navigator" data-duration="Week"
        data-day="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}">
        Go to This Week
    </span>
    <span class="btn go-to-date float-right" data-duration="Week"
        data-day="{{ \Carbon\Carbon::parse($date)->addWeek()->format('Y-m-d') }}">
        Next Week
    </span>
@endsection
@section('pageTitle')
    <div class="text-center">
        from: {{ $weekStart }}
        to: {{ $weekEnd }}
    </div>
@endsection
@section('pageContent')
    <div class="p-5 week-tasks-container" id="week-tasks-container">
        <div class="week-tasks-hours">
            <div class=""></div>
            @for ($i = 0; $i <= 23; $i++)
                <div class="px-1">{{ str_repeat(0, 2 - strlen($i)) . $i . ' : 00' }}</div>
            @endfor
        </div>
        <div class="week-tasks-schedule">
            @for ($d = 0; $d < 7; $d++)
                @php
                    $day = \Carbon\Carbon::parse($weekStart)->addDays($d);
                @endphp
                <div
                    class="week-day-tasks
            {{ $day->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d') ? 'week-today' : '' }}">
                    <div class="btn text-center week-day-number go-to-date" data-day="{{ $day->format('Y-m-d') }}"
                        data-duration="Day">
                        {{ $day->format('l') }} <br>
                    </div>
                    @for ($i = 0; $i <= 23; $i++)
                        @php
                            $hourTasks = Auth::user()->tasksStartAt($day->format('Y-m-d'), $i . ':00');
                        @endphp
                        <div class="week-hour-tasks">
                            @foreach ($hourTasks as $task)
                                <span class="badge badge-light hour-task-title"
                                    custom-title="{{ $task->title }} Begins at {{ $task->start_date }}"
                                    data-task="{{ $task->id }}">
                                    {{ excerpt($task->title, 12) }}
                                </span>
                            @endforeach
                        </div>
                    @endfor
                </div>
            @endfor
        </div>
    </div>
@endsection
