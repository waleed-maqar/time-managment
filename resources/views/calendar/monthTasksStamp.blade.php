<div class="mt-5 days-grid-container">
    <div class="pt-3 text-center h2">Sun</div>
    <div class="pt-3 text-center h2">Mon</div>
    <div class="pt-3 text-center h2">Tue</div>
    <div class="pt-3 text-center h2">Wed</div>
    <div class="pt-3 text-center h2">Thu</div>
    <div class="pt-3 text-center h2">Fri</div>
    <div class="pt-3 text-center h2">Sat</div>
    @for ($i = 1; $i <= $daysNumber; $i++)
        @php
            $i = strlen($i) == 1 ? "0$i" : $i;
            $thisDay = $year . '-' . $month . '-' . $i;
            $dayTasks = $helper::showDayTasks($thisDay);
            $weekDay = \Carbon\Carbon::parse($thisDay)->dayOfWeek;
        @endphp
        @if ($i == 1)
            @for ($k = 0; $k < $weekDay; $k++)
                <div></div>
            @endfor
        @endif
        <div
            class="pt-3 day-grid-item {{ "$year-$month-$i" == \Carbon\Carbon::parse(now())->format('Y-m-d') ? 'today-grid-item' : '' }}">
            <a href="{{ url('day/' . $thisDay) }}">
                <h4 class="text-center">{{ $i }}</h4>
                @foreach ($dayTasks as $task)
                    <div class="this-month-task-name"><a
                            href="{{ route('task.show', $task->id) }}">{{ $task->title }}...</a></div>
                @endforeach
            </a>
        </div>
    @endfor
</div>
