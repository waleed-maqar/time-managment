/**
 *
 * @param {string} day
 */
function goToDay(day) {
    localStorage.setItem("period", "goToDay");
    localStorage.setItem("day", day);
    $.ajax({
        url: "/day/" + day,
    }).done(function (html) {
        mainContainerContent(html);
    })
}
/**
 *
 * @param {string} date
 */
function goToWeek(date) {
    localStorage.setItem("period", "goToWeek");
    localStorage.setItem("day", date);
    $.ajax({
        url: "/week/" + date,
    }).done(function (html) {
        mainContainerContent(html)
    })
}
/**
 *
 * @param {string} date
 */
function goToMonth(date) {
    localStorage.setItem("period", "goToMonth");
    localStorage.setItem("day", date);
    $.ajax({
        url: '/month/' + date,
    }).done(function (html) {
        mainContainerContent(html)
    })
}
function goToYear(date) {
    localStorage.setItem("period", "goToYear");
    localStorage.setItem("day", date);
    $.ajax({
        url: '/year/' + date,
    }).done(function (html) {
        mainContainerContent(html)
    })
}
//
function taskIndex(day = null) {
    localStorage.setItem("period", "taskIndex");
    localStorage.setItem("day", day);
    $.ajax({
        url: '/task'
    }).done(function (html) {
        mainContainerContent(html)
    })
}
function taskPeriority(day = null) {
    localStorage.setItem("period", "taskPeriority");
    localStorage.setItem("day", day);
    $.ajax({
        url: '/taskPeriority'
    }).done(function (html) {
        mainContainerContent(html)
    })
}
function periority(per, pages) {
    $.ajax({
        url: '/periority/' + per,
        data: { pages: pages }
    }).done(function (html) {
        $('#tasks-with-' + per + '-pereority').html(html)
    })
}

function taskStore() {
    let day = $('input[name=start_date]').val()
    $.ajax({
        method: "POST",
        data: $('.new-task-form').serialize(),
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
            setTimeout(function () { $('.return-messages').hide() }, 3000)
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
    $.ajax({
        method: "POSt",
        data: $('.update-task-form').serialize(),
        url: "/task/" + task,
    }).done(function (data) {
        if (data.status == true) {
            function showTask() {
                $('#hour-task-details').html(data.showTask).show(500)
                $('.update-task').hide()
            }
            window.setTimeout(showTask, 500)
        }
        else {
            $('.return-messages').html(data.showErrors).show(500)
            setTimeout(function () { $('.return-messages').hide() }, 3000)
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
            setTimeout(function () { $('.return-messages').hide() }, 3000)
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
