
$(document).ready(function () {
    function taskDone(task) {
        $.ajax({
            url: "/taskdone/" + task,
        }).done(function (html) {
            $("#task-index-single-" + task).html(html);
        })
    }
    function taskNotDone(task, step = 0) {
        $.ajax({
            url: "/tasknotdone/" + task + '/' + step,
        }).done(function (html) {
            $("#task-index-single-" + task).html(html);
        })
    }
    function stepDone(step) {
        $.ajax({
            url: "/stepdone/" + step,
        }).done(function (html) {
            $("#single-task-step-" + step).html(html);
        })
    }
    function stepNotDone(step) {
        $.ajax({
            url: "/stepnotdone/" + step,
        }).done(function (html) {
            $("#single-task-step-" + step).html(html);
        })
    }
    $(document).on('click', '.single-task-check', function () {
        let task = $(this).data('task')
        if ($(this).prop('checked')) {
            taskDone(task)
        }
        else {
            taskNotDone(task)
        }
    })
    //
    $(document).on('click', '.single-step-check', function () {
        let step = $(this).data('step')
        let task = $(this).data('task')
        let element = $('.single-task-' + task)
        if ($(this).prop('checked')) {
            stepDone(step);
            element.data('donesteps', element.data('donesteps') - 1)
            if (element.data('donesteps') == 0) {
                $('.taskCheck-' + task).prop('checked', true)
                taskDone(task)
            }
        }
        else {
            stepNotDone(step);
            element.data('donesteps', element.data('donesteps') + 1)
            taskNotDone(task, step)
            $('.taskCheck-' + task).prop('checked', false)
        }
    })

    $(document).on('click', '.show-add-step', function () {
        $('.add-step-form').show(200)
        $(this).hide(200)
    })
    $(document).on('click', '.add-step-form-close', function () {
        $('.add-step-form').hide(200)
        $('.show-add-step').show(200)
    })
});

