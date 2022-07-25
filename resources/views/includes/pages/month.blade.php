@extends('includes.pages.pageTemplate')
@section('navigator')
    <span class="btn go-to-date float-left" data-duration="Month"
        data-day="{{ \Carbon\Carbon::parse($date)->subMonth()->format('Y-m-d') }}">
        prev Month
    </span>
    <span class="btn go-to-date today-navigator" data-duration="Month"
        data-day="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}">
        Go to This month
    </span>
    <span class="btn go-to-date float-right" data-duration="Month"
        data-day="{{ \Carbon\Carbon::parse($date)->addMonth()->format('Y-m-d') }}">
        Next Month
    </span>
@endsection
@section('pageTitle')
    <div class="text-center">{{ \Carbon\Carbon::parse($date)->format('M, Y') }}
    </div>
@endsection
@section('pageContent')
    <div class="p-5 month-tasks-container" id="month-tasks-container">
        @for ($d = 1; $d <= $daysNumber; $d++)
            @php
                $day = $month . '-' . $d;
                $dayTasks = Auth::User()->dayTasks($day);
            @endphp
            <div class="text-center pt-1 month-day-tasks">
                <h3>{{ str_repeat('0', 2 - strlen($d)) . $d }}</h3>
                @foreach ($dayTasks as $task)
                    <span class="badge badge-light hour-task-title"
                        custom-title="{{ $task->title }} Begins at {{ $task->start_date }}"
                        data-task="{{ $task->id }}">
                        {{ excerpt($task->title, 7) }}
                    </span>
                @endforeach
            </div>
        @endfor
    </div>
@endsection
