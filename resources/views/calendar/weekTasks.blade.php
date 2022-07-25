@extends('includes.mainTemplate')
@section('page-name', 'Home')
@section('content')
    <div class="mx-5 p-5 week-tasks-container">
        <div class="week-tasks-hours">
            <div class="px-1">xxxx</div>
            @for ($i = 0; $i <= 23; $i++)
                <div class="px-1">{{ str_repeat(0, 2 - strlen($i)) . $i . ' : 00' }}</div>
            @endfor
        </div>
        @for ($i = $monDay; $i <= $monDay + 6; $i++)
            <div class="week-day">
                <div class="week-day-number text-center">{{ $days[$i - $monDay] }}<br>
                    {{ $i }}
                </div>
                @for ($j = 1; $j <= 24; $j++)
                    <div class="p-1 week-day-task">
                        Lorem ipsum..
                    </div>
                @endfor
            </div>
        @endfor
    </div>
@endsection
