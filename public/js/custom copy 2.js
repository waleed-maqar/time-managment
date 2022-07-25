
$(document).ready(function () {

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
        console.log(duration)
        eval("goTo" + duration + "(day)")
        // goToDay($(this).data('day'))
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
        // taskStore()
        data = $('#add-task-form').serialize()
        console.log(data)
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
    //

    /* Start Ajax work*/
    function goToDay(day) {
        $.ajax({
            url: "/day/" + day,
        }).done(function (html) {
            $("#main-tasks-container").html(html);
        })
    }
    function goToWeek(date) {
        $.ajax({
            url: "/week/" + date,
        }).done(function (html) {
            $("#main-tasks-container").html(html);
        })
    }
    function goToMonth(date) {
        $.ajax({
            url: '/month/' + date,
        }).done(function (html) {
            $("#main-tasks-container").html(html);
        })
    }
    function goToYear(date) {
        $.ajax({
            url: '/year/' + date,
        }).done(function (html) {
            $("#main-tasks-container").html(html);
        })
    }
    //
    function taskIndex() {
        $.ajax({
            url: '/task'
        }).done(function (html) {
            $('#main-tasks-container').html(html)
        })
    }
    //
    function taskStore() {
        let day = $('input[name=start_date]').val()
        $.ajax({
            method: "POST",
            data: $('#add-task-form').serialize(),
            url: "/task"
        }).done(function (data) {
            if (data.status == true) {
                function showTask() {
                    $('#hour-task-details').html(data.showTask).show(500)
                }
                goToDay(day)
                $('.add-new-task').hide()
                window.setTimeout(showTask, 500)
            }
            else {
                $('.return-messages').html(data.showErrors).show(500)
            }
        })
    }
    //
    function taskDetails(task) {
        $('#hour-task-details').hide()
        $.ajax({
            url: "/task/" + task
        }).done(function (html) {
            $('#hour-task-details').html(html).show()
        })
    }
    //
    function taskEdit(task) {
        $.ajax({
            url: '/task/' + task + '/edit'
        }).done(function (html) {
            $('#hour-task-details').html(html).hide()
            $('.update-task').html(html).show(500)
        })
    }
    //
    function taskUpdate(task) {
        let day = $('input[name=start_date]').val()
        data = $('#update-task-form').serialize();
        console.log(data)
        $.ajax({
            method: "POSt",
            data: $('#update-task-form').serialize(),
            url: "/task/" + task,
        }).done(function (data) {
            $('#update-task-form').hide()
            if (data.status == true) {
                function showTask() {
                    $('#hour-task-details').html(data.showTask).show(500)
                }
                goToDay(day)
                $('#update-task-form').hide()
                window.setTimeout(showTask, 500)
            }
            else {
                $('.return-messages').html(data.showErrors).show(500)
            }
        })
    }
    //
    function taskDelete(task, day) {
        $.ajax({
            method: "POST",
            url: 'task/' + task,
            data: $('#delete-task-form').serialize()
        }).done(function (html) {
            function taskDeleted() {
                $('.return-messages').html(html).show()
                setTimeout(function () { $('.return-messages').hide() }, 2000)

            }
            window.setTimeout(taskDeleted, 500)
            $('.hour-task-title[data-task=' + task + ']').hide()
            $('.hour-task-details').hide()
        })
    }
    //
    function taskDone(task) {
        $.ajax({
            url: "/taskdone/" + task,
        }).done(function (html) {
            $("#hour-task-details").html(html);
            $('#steps-of-task-' + task).show()
        })
    }
    function taskNotDone(task, step = 0) {
        $.ajax({
            url: "/tasknotdone/" + task + '/' + step,
        }).done(function (html) {
            $("#hour-task-details").html(html);
            $('#steps-of-task-' + task).show()

        })
    }
    //
    function addStep(task) {
        $.ajax({
            method: "POST",
            data: $('.add-step-form').serialize(),
            url: '/step'
        }).done(function (html) {
            $('#steps-of-task-' + task).html(html)
            taskNotDone(task)
        })
    }
    function stepDone(step) {
        $.ajax({
            url: "/stepdone/" + step,
        }).done(function (html) {
            $("#edit-step-" + step).html(html);
        })
    }
    function stepNotDone(step) {
        $.ajax({
            url: "/stepnotdone/" + step,
        }).done(function (html) {
            $("#edit-step-" + step).html(html);
        })
    }
    function stepUpdate(step, task) {
        $.ajax({
            method: "POST",
            url: '/step/' + step,
            data: $('#edit-step-' + step).serialize()
        }).done(function (html) {
            $('#edit-step-' + step).html(html)
        })
    }
    function stepDelete(step, task) {
        // let token = $('#edit-step-' + step).serializeArray()[0].value
        let token = $('#edit-step-' + step).serializeArray().find(obj => obj.name == '_token').value
        $.ajax({
            method: "POST",
            data: {
                '_method': 'DELETE',
                '_token': token
            },
            url: '/step/' + step
        }).done(function (html) {
            $('#steps-of-task-' + task).html(html)
        })
    }
    //
    /* End ajax work */

});

