    @extends('includes.mainTemplate')
    @section('page-name', 'Home')
    @section('content')
        <div class="ml-5 p-3 row return-messages"></div>
        <span class="btn element-show add-task" custom-title="Add New Task" data-element=".add-new-task">
            <i class="fa-solid fa-plus"></i>
        </span>
        <div class="jump-to-date">
            @include('includes.parts.gotodate')
        </div>
        <div class="ml-5 p-3 add-new-task">
            @include('includes.parts.addtaskform')
        </div>
        <div id="hour-task-details">
        </div>
        <div class="p-3 update-task">
        </div>
        @if (Count($expiredTasks) != 0)
            <div class="ml-5 p-3 expired-tasks">
                @include('includes.parts.expiredTasks')
            </div>
        @endif
        <div class="main-tasks-container" id="main-tasks-container">
            @include('includes.pages.taskIndex')
        </div>
    @endsection
