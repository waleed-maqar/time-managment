<div class="p-3">
    <div class="sidebar-site-name"></div>
    <div class="list-group list-group-flush">
        <a class="btn  sidebar-task-index-link">My
            Tasks</a>
        <a class="btn sidebar-day-tasks-link" data-day="{{ $date }}">Day</a>
        <a class="btn sidebar-week-tasks-link" data-day="{{ $date }}">Week</a>
        <a class="btn sidebar-month-tasks-link" data-day="{{ $date }}">Month</a>
        <a class="btn sidebar-year-tasks-link" data-day="{{ $date }}">Year</a>
        @if (Count($expiredTasks) != 0)
            <a class="btn btn-danger element-show" data-element=".expired-tasks">
                Your expierd Tasks ({{ Count($expiredTasks) }})
            </a>
        @endif
    </div>
</div>
