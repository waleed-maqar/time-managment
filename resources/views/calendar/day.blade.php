@extends('includes.mainTemplate')
@section('content')
    <div class="float-right">
        <a href="{{ url('day/') .'/' .\Carbon\Carbon::parse($date)->subDay()->format('Y-m-d') }}">Prev</a>...<a
            href="{{ url('day/') .'/' .\Carbon\Carbon::parse($date)->addDay()->format('Y-m-d') }}">Next</a>
    </div>
    @for ($i = 0; $i <= 23; $i++)
        @php
            $i = strlen($i) == 1 ? "0$i" : $i;
            $hourTasksStart = calendar()->tasksStartAt($date, $i . ':00');
            $hourTasksEnd = calendar()->tasksEndAt($date, $i . ':00');
        @endphp
        <h6>{{ $i }} : 00</h6>
        @foreach ($hourTasksStart as $task)
            <small class="badge badge-primary">Start of:</small>
            <h6><a href="{{ route('task.show', $task->id) }}">{{ $task->title }}</a></h6>
        @endforeach
        @foreach ($hourTasksEnd as $task)
            <small class="badge badge-secondary">Endof:</small>
            <h6><a href="{{ route('task.show', $task->id) }}">{{ $task->title }}</a></h6>
        @endforeach
        <hr>
    @endfor
@endsection
