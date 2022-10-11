@extends('includes.pages.pageTemplate')
@section('navigator')
    <span class="btn go-to-date float-left" data-duration="Year"
        data-day="{{ \Carbon\Carbon::parse($date)->subYear()->format('Y-m-d') }}">
        prev Year
    </span>
    <span class="btn go-to-date today-navigator" data-duration="Year"
        data-day="{{ \Carbon\Carbon::parse(now())->format('Y-m-d') }}">
        Go to This Year
    </span>
    <span class="btn go-to-date float-right" data-duration="Year"
        data-day="{{ \Carbon\Carbon::parse($date)->addYear()->format('Y-m-d') }}">
        Next Year
    </span>
@endsection
@section('pageTitle')
    <div class="text-center">{{ \Carbon\Carbon::parse($date)->format('Y') }}
    </div>
@endsection
@section('pageContent')
    <div class="p-5 year-tasks-container" id="year-tasks-container">
        @for ($m = 1; $m <= 12; $m++)
            @php
                $daysNum = \Carbon\Carbon::parse($year . '-' . $m)->daysInMonth;
            @endphp
            <div class="p-2 year-month-container">
                <div class="text-center year-month-name">{{ \Carbon\Carbon::parse($year . '-' . $m)->format('M') }}</div>
                <div>sun</div>
                <div>sun</div>
                <div>sun</div>
                <div>sun</div>
                <div>sun</div>
                <div>sun</div>
                <div>sun</div>
                @for ($d = 1; $d <= $daysNum; $d++)
                    {{-- <div class="btn {{ count(auth()->user()->dayTasks($year . '-' . $m . '-' . $d)) == 0? '': 'badge badge-dark rounded-circle' }} go-to-day"
                        data-day="{{ $year . '-' . $m . '-' . $d }}">
                        {{ str_repeat(0, 2 - strlen($d)) . $d }}</div> --}}
                    <div @class([
                        'btn go-to-day',
                        'year-day-has-tasks' =>
                            count(
                                auth()->user()->dayTasks($year . '-' . $m . '-' . $d)
                            ) != 0,
                    ]) data-day="{{ $year . '-' . $m . '-' . $d }}">
                        {{ str_repeat(0, 2 - strlen($d)) . $d }}</div>
                @endfor
            </div>
        @endfor
    </div>
@endsection
