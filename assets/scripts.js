$(document).ready(function() {
    $('.bold').hover(function() {
        var name = $(this).data('id');
        $(this).tooltip({ title: '' + name, placement: 'left' });
    });

});
$(function() {
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});


$(function() {
    $('#example1').DataTable({
        'ordering': false
    });
    $('#masterlistable').DataTable({
        'ordering': false,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });

    $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': true
    })
})

function showNotification(colour, msg) {
    color = colour;


    $.notify({
        icon: "ti-check",
        message: msg

    }, {
        type: type[color],
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
}

function successnotify(colour, msg) {
    color = colour;

    // Please check the row(s) that you want to claim
    $.notify({
        icon: "ti-check-box",
        message: msg

    }, {
        type: type[color],
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
}

function errornotify(colour, msg) {
    color = colour;


    $.notify({
        // icon: "ti-help-alt",
        icon: "ti-fullscreen",
        message: msg

    }, {
        type: type[color],
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
}


$(document).on('click', '.change_password', function(e) {
    e.preventDefault();

    var npass = $('#npassword').val();
    var cpass = $('#cpassword').val();
    var current_password = $('#currentpassword').val();
    if (npass == "") {
        $(".errormssg").css("color", " red");
        $(".errormssg").text("New Password is required!");
        setTimeout(function() {
            $(".errormssg").css("color", " white");
        }, 2000);
    } else if (cpass == "") {
        $(".errormssg").css("color", " red");
        $(".errormssg").text("Confirm Password is required!");
        setTimeout(function() {
            $(".errormssg").css("color", " white");
        }, 2000);
    } else if (npass != cpass) {
        $(".errormssg").css("color", " red");
        $(".errormssg").text("New password and confirm password not match!");
        setTimeout(function() {
            $(".errormssg").css("color", " white");
        }, 3000);
    } else if (current_password == '') {
        $(".errormsssg").css("color", " red");
        $(".errormsssg").text("Current Password is required!");
        setTimeout(function() {
            $(".errormsssg").css("color", " white");
        }, 2000);
    } else {
        $.ajax({
            url: "action/admin.php",
            method: "POST",
            data: { check_password: current_password },
            success: function(data) {
                if (data) {
                    $.ajax({
                        url: "action/admin.php",
                        method: "POST",
                        data: { cpass: cpass },
                        success: function(data) {
                            if (data) {
                                $('#change-pass').modal('hide');
                                successnotify('2', 'Password Successfully Changed.');
                            } else {
                                $('#change-pass').modal('hide');
                                errornotify('4', ' Cannot Change Password. Please Try again later! ');
                            }
                            $('#admin_changepass_form')[0].reset();
                            $("#currentpassword").css("border-color", " gray");
                        }
                    });
                } else {
                    $(".errormsssg").css("color", " red");
                    $(".errormsssg").text("Incorrect Current Password!");
                    setTimeout(function() {
                        $(".errormsssg").css("color", " white");
                    }, 2000);
                    $("#currentpassword").css("border-color", " red");
                    $('#currentpassword').val('');
                }
            }
        });
    }

});