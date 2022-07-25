<h1>Tasks with {{ $pereority }} pereority</h1>
@if (count($tasks->get()) > $pages)
    <span class="btn tasks-periority-paginate tasks-seemore" data-per="{{ $pereority }}"
        data-pages="{{ $pages + 3 }}">see more</span>
@endif
@foreach ($tasks->paginate($pages) as $task)
    <span class="badge badge-{{ $task->outOfDate() ? 'danger' : 'light' }} hour-task-title"
        custom-title="{{ $task->title }} Begins at {{ $task->start_date }}" data-task="{{ $task->id }}">
        {{ excerpt($task->title, 5) }}
    </span>
@endforeach
@if (count($tasks->get()) > 3)
    <span class="btn tasks-periority-paginate tasks-seeless" data-per="{{ $pereority }}"
        data-pages="{{ $pages - 3 }}">see less</span>
@endif
