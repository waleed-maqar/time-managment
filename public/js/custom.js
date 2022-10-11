
$(document).ready(function () {
    /**
     * get the content of the home page based on local storage
     */
    if (localStorage.getItem("period")) {
        let period = localStorage.getItem("period")
        let day = localStorage.getItem("day")
        window[period](day)
    }
    $(document).on("click", '.navbar-brand', function () {
        localStorage.removeItem("period")
    })
    //
    $(document).on('click', '.element-toggle', function () {
        $($(this).data('element')).toggle()
    })
    $(document).on('click', '.element-close', function () {
        $($(this).data('element')).hide(600)
    })
    $(document).on('click', '.element-show', function () {
        $($(this).data('element') + " form").trigger('reset')
        $($(this).data('element')).show(600)
    })
    $(document).on('click', '.go-to-date', function () {
        var duration = $(this).data('duration')
        var day = $(this).data('day')
        eval("goTo" + duration + "(day)")
    })
    $(document).on('submit', '#jump-to-date-form', function (e) {
        e.preventDefault()
        period = $("#jump-to-date-period").val()
        day = $("#jump-to-date-day").val()
        eval("goTo" + period + "('" + day + "')")
        $(this).parent().hide()
    })
    $(document).on('click', '.go-to-day', function () {
        goToDay($(this).data('day'))
        document.title = day
    })
    $(document).on('click', '.sidebar-day-tasks-link', function () {
        goToDay($(this).data('day'))
    })
    //
    $(document).on('click', '.sidebar-task-index-link', function () {
        taskIndex();
    })
    $(document).on('click', '.task-sortby-periority', function () {
        taskPeriority();
    })
    $(document).on('click', '.tasks-periority-paginate', function () {
        let per = $(this).data('per')
        pages = $(this).data('pages')
        periority(per, pages);
    })
    $(document).on('click', '.task-sortby-year', function () {
        taskIndex();
    })
    $(document).on('click', '.sidebar-week-tasks-link', function () {
        goToWeek($(this).data('day'))
    })
    $(document).on('click', '.sidebar-month-tasks-link', function () {
        goToMonth($(this).data('day'))
    })
    $(document).on('click', '.sidebar-year-tasks-link', function () {
        goToYear($(this).data('day'))
    })
    //
    $(document).on('click', '#add-task-submit', function (e) {
        e.preventDefault();
        taskStore()
    })
    //
    $(document).on('click', '.period-toggle', function () {
        let element = $('.task-index-' + $(this).data('period'))
        element.toggleClass('active')
        element.parent().siblings().children().removeClass('active')
    })
    //
    $(document).on('click', '.hour-task-title', function () {
        let task = $(this).data('task')
        taskDetails(task)
    })
    $(document).on('click', '.hour-task-details-close', function () {
        $('.hour-task-details').hide(600)
    })
    //
    $(document).on('click', '.hour-task-edit', function () {
        let task = $(this).data('task')
        taskEdit(task)
    })
    //
    $(document).on('click', '#update-task-submit', function (e) {
        let task = $(this).data('task')
        e.preventDefault();
        taskUpdate(task)
    })
    //
    $(document).on('click', '.hour-task-delete', function (e) {
        e.preventDefault()
        let task = $(this).data('task')
        let day = $(this).data('day')
        taskDelete(task, day)
    })
    //
    $(document).on('click', '.task-done-check', function () {
        let task = $(this).data('task')
        if ($(this).prop('checked')) {
            taskDone(task)
        }
        else {
            taskNotDone(task)
        }
    })
    //
    $(document).on('click', '.step-done-check', function () {
        let step = $(this).data('step')
        let task = $(this).data('task')
        let element = $('.taskcheck-' + task)
        if ($(this).prop('checked')) {
            stepDone(step);
            element.data('donesteps', element.data('donesteps') - 1)
            if (element.data('donesteps') == 0) {
                element.prop('checked', true)
                taskDone(task)
            }
        }
        else {
            stepNotDone(step);
            element.data('donesteps', element.data('donesteps') + 1)
            taskNotDone(task, step)
            element.prop('checked', false)
        }
    })
    //
    $(document).on('click', '.add-step-button', function () {
        $(this).parents('form').addClass('add-step-form')
        $(this).hide()
        $('.new-step-name').attr('type', 'text').focus()
    })

    $(document).on('click', '*', function (e) {
        if ($(e.target).closest(".new-step-form").length === 0) {
            if ($(".new-step-name:text").length) {
                if ($(".new-step-name:text").val()) {
                    addStep($(".new-step-name:text").data('task'))
                }
            }
            $(".new-step-name:text").attr('type', 'hidden');
            $(".add-step-button").show();
        }
    });
    //
    $(document).on('submit', '.step-edit-form, .new-step-form', function (e) {
        e.preventDefault()
    })
    $(document).on('click', '.task-step-name', function () {
        let element = $('#step-' + $(this).data('step'))
        $(this).hide()
        element.attr('type', 'text')
        $(this).parent().siblings().children('input:text').attr('type', 'hidden')
        $(this).parent().siblings().children('.task-step-name').show()
    })

    $(document).on('click', '*', function (e) {
        if ($(e.target).closest(".step-edit-form").length === 0) {
            if ($(".change-step-name:text").length) {
                stepUpdate($(".change-step-name:text").data('step'), $(".change-step-name:text").data('task'))
            }
            $(".change-step-name").attr('type', 'hidden');
            $(".step-edit-form label").show();
        }
    });
    $(document).on('click', '.step-delete-button', function () {
        stepDelete($(this).data('step'), $(this).data('task'))
    })


});

