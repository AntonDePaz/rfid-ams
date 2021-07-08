$(document).ready(function() {

    // document.onkeydown = function(e) {
    //     if (event.keyCode == 123) {
    //         return false;
    //     }
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
    //         return false;
    //     }
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
    //         return false;
    //     }
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
    //         return false;
    //     }
    //     if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
    //         return false;
    //     }
    // }

    const admintype = $('.admin_type').val();
    if(admintype != "President") {
        $('.access').hide();
    }

    $(".cdata_students").tooltip({ title: 'Clear all Students Data', placement: 'top' });
    $(".cdata_fees").tooltip({ title: 'Clear all Fee Data', placement: 'top' });
    $(".cdata_events").tooltip({ title: 'Clear all Events Data', placement: 'top' });


});


$('.rfid').on('change', function() {
    data = $(this).val();
    type = "rfid";
    check_duplicate(data, type);

});
$('.id_num').on('change', function() {
    data = $(this).val();
    type = "id_num";
    check_duplicate(data, type);
});
$('.username').on('change', function() {
    data = $(this).val();
    type = "username";
    check_duplicate(data, type);
});



$(document).on('click', '.admin_del', function() {
    var nameadmin = $(this).attr('id');
    //alert(''+nameadmin);
    var adminid = $(this).data('id');
    $('.deladminid').val('' + adminid);
    const myid = $('.adminid').val();
    // alert(nameadmin)
    if (myid == adminid) {
        $('.admin_delete_info1').text('' + nameadmin + ' (you)');
    } else {
        $('.admin_delete_info1').text('' + nameadmin);
    }
    $('#delete_admin_modal').modal('show');

});
$(document).on('click', '.btn_del_admin', function() {
    var adminid = $('.deladminid').val();
    //alert(''+adminid);
    $.ajax({
        type: 'POST',
        url: 'action/admin.php',
        data: { del_admin_id: adminid },
        success: function(response) {

            if (response == 1) {
                //  window.location.href = "setting.php";
                load_account_table();
                $('#delete_admin_modal').modal('hide');
                successnotify('2', 'Successfully Removed Account!');
            } else {
                alert('ERROR: ADEL:Error');
            }

        }
    });
});


$(document).on('click', '.cdata_students', function() {
    var sy_id = $(this).data('sy');
    const sum = $(this).data('sum');
    if (sum != 0) {
        //alert('students:'+sy_id)
        $('#cdtype').val('1');
        $('#sy_id107').val(sy_id);
        $('#data_type107').val('101');
        $('.sy_range_data').text('All Students');
        $('#cleardatamodal').modal('show');
    }
});
$(document).on('click', '.cdata_fees', function() {
    var sy_id = $(this).data('sy');
    const sum = $(this).data('sum');
    if (sum != 0) {
        $('#cdtype').val('1');
        $('#sy_id107').val(sy_id);
        $('#data_type107').val('102');
        $('.sy_range_data').text('All Fees');
        $('#cleardatamodal').modal('show');
    }
});
$(document).on('click', '.cdata_events', function() {
    var sy_id = $(this).data('sy');
    const sum = $(this).data('sum');
    if (sum != 0) {
        $('#cdtype').val('1');
        $('#sy_id107').val(sy_id);
        $('#data_type107').val('103');
        $('.sy_range_data').text('All Events');
        $('#cleardatamodal').modal('show');
    }
});



$(document).on('click', '.sy_range', function() {
    var sy = $(this).data('id');
    var sy_id = $(this).attr('id');
    $('.SY_id').val("" + sy_id);
    $('#cdtype').val('2');
    $('.sy_range_data').text("" + sy + " Academic Year ");
    $('#cleardatamodal').modal('show');

});
$(document).on('click', '.clear_data', function() {
    var cdtype = $('#cdtype').val();
    var sy_id = $('#sy_id107').val();
    var data_type = $('#data_type107').val();
    $('#ccdtype').val(cdtype);
    $('#sy_id109').val(sy_id);
    $('#data_type109').val(data_type);
    $('#cleardatamodal').modal('hide');
    $('#confirm_cleardatamodal').modal('show');

});
$(document).on('click', '.confirm_clear_data', function() {


    //$('#confirm_cleardatamodal').modal('hide');
    // alert('clear data confirm');
    //document.getElementById('cleardatamodal_hide').style.display = 'none';
    var ccdtype = $('#ccdtype').val();
    var sy_id101 = $('#sy_id109').val();
    var datatype = $('#data_type109').val();
    //alert(ccdtype);
    var sy_range_des = $('.sy_range_data').text();
    var table_id = $('.SY_id').val();
    var password = $('#confirm_password').val();

    if (password == '') {
        $(".sy_error").css("color", " red");
        $(".sy_error").text("Empty Field");

        setTimeout(function() {
            $(".sy_error").css("color", "transparent");
        }, 2000);
    } else {

        $.ajax({
            type: 'POST',
            url: 'action/admin.php',
            data: { check_password: password },
            success: function(response) {
                if (response == 1) {

                    if (ccdtype == 1) {

                        //alert('student or else:'+);
                        $.ajax({
                            url: "action/data.php",
                            method: "POST",
                            data: { sy_id101: sy_id101, datatype: datatype },
                            beforeSend: function() {
                                $('.sy_loading').html('<img src="images/loading.gif">');
                                document.getElementById('cleardatamodal_hide').style.display = 'none';
                                $("#ccdbtn201").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...');
                                document.getElementById('ccdbtn202').style.display = 'none';
                            },
                            success: function(data) {
                                if (data == 1) {
                                    addloghistory('CLear', 'All Data', sy_range_des);
                                    window.location.href = "setting.php";
                                } else {
                                    $('#confirm_cleardatamodal').modal('hide');
                                    $('.sy_loading').html('');
                                    //  alert('ERROR: CLDer:408;');

                                }
                            }
                        });
                    }
                    if (ccdtype == 2) {
                        // alert('all data')


                        $.ajax({
                            url: "action/data.php",
                            method: "POST",
                            data: { table_id: table_id },
                            beforeSend: function() {
                                $('.sy_loading').html('<img src="images/loading.gif">');
                                document.getElementById('cleardatamodal_hide').style.display = 'none';
                                $("#ccdbtn201").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...');
                                document.getElementById('ccdbtn202').style.display = 'none';
                            },
                            success: function(data) {
                                // if(data == 1){
                                addloghistory('CLear', 'All Data', sy_range_des);
                                window.location.href = "setting.php";
                            }
                        });
                    }
                } else {
                    $('#confirm_password').val('');
                    $(".sy_error").css("color", " red");
                    $(".sy_error").text("Incorrect Password");

                    setTimeout(function() {
                        $(".sy_error").css("color", "transparent");
                    }, 5000);
                }
            }
        });


    } //else end

});


$(document).on('click', '.cancel_admin_profile', function() {
    window.location.href = "setting.php";

});
$(document).on('click', '.update_admin_profile', function() {

    // <?php// if(isset($_SESSION['imagepath'])){ unset($_SESSION['imagepath']); } ?>
    // $('#uploadimage').val('');
    $('#form_add_admin')[0].reset();


    $.ajax({
        type: 'POST',
        url: 'action/admin.php',
        data: { getinfo: 'get' },
        dataType: 'json',
        success: function(response) {
            $('.admin_id').val(response.admin_id);
            $('.rfid').val(response.rfid);
            $('.id_num').val(response.id_number);
            $('.position').val(response.position);
            $('.firstname').val(response.lastname);
            $('.middlename').val(response.middlename);
            $('.lastname').val(response.lastname);
            $('.username').val(response.username);
            $('.dup_username').val(response.username);


            $('.form-password').html('<label>Current Password</label><input type="password" name="password" class="form-control border-input password" placeholder="Enter Your Password to Save Changes">');
            var photopath = response.photo; //$('.adminphoto').val();
            //  console.log(""+photopath);
            if (photopath != '') {
                $('#uploadedimage').html('<img style="border-radius: 20px; border: 2px solid black;" width="150" height="150" class="avatar border-white" src="images/' + photopath + '"  class="img-thumbnail" />');
                $('.photopath').val('' + photopath);
            }
            $('.adminbtn').html('<button type="button" class="btn btn-primary btn-sm pull-right update_admin"><i class="fa fa-edit"></i> Save Changes</button>');
            //  var preview = document.getElementById('img_view');
            // preview.src = src;

        },
        error: function() {
            alert('Error: L33+ #edit student');
        }
    });


});

$(document).on('click', '.show_admin', function() {

    //load_account_table();



    $('.row_admin').css('display', 'flex');
    $('.hide_admin').css('display', 'flex');
    $('.show_admin').css('display', 'none');


    //  $(".errormsg").css("color"," white");

});
$(document).on('click', '.hide_admin', function() {
    //load_account_table();
    $('.row_admin').css('display', 'none');
    $('.hide_admin').css('display', 'none');
    $('.show_admin').css('display', 'flex');

    //  $(".errormsg").css("color"," white");

});






function showPreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById('img_view');
        preview.src = src;
        //preview.style.display = "block";
    }
}


$(document).on('click', '.update_admin', function() {

    // alert('update')

    var rfid = $('.rfid').val();
    var admin_id = $('.admin_id').val();
    var id_number = $('.id_num').val();
    var firstname = $('.firstname').val();
    var middlename = $('.middlename').val();
    var lastname = $('.lastname').val();
    var username = $('.username').val();
    var password = $('.password').val();
    var dup_username = $('.dup_username').val();
    // console.log(rfid,firstname,lastname,middlename,username,password,dup_username);



    if ($('.rfid').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("RFID Tag Code is Required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 3000);
    } else if ($('.id_num').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("ID Number is Required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('.firstname').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Firstname is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 3000);
    } else if ($('.lastname').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Lastname is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 3000);
    } else if ($('.username').val() == "") {
        $(".errormsg").css("color", " red");
        $(".username").css("border-color", " red");
        $(".errormsg").text("Username is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 3000);
    } else if ($('.password').val() == "") {
        $(".wrongpass").css("color", " red");
        $(".password").css("border-color", " red");
        $(".password").css("border-color", " red");
        $(".wrongpass").text("Password is required!");

        setTimeout(function() {
            $(".wrongpass").css("color", " white");
        }, 3000);
    } else {
        $.ajax({
            type: 'POST',
            url: 'action/admin.php',
            data: { check_password: password },
            success: function(response) {
                if (response == 1) {

                    console.log(admin_id, id_number, rfid, firstname, middlename, lastname, username)

                    $.ajax({
                        url: "action/admin.php",
                        method: "POST",
                        //  data: fd,

                        //  data: $('#form_add_admin').serialize(),  
                        // data:{rfid:rfid,firstname:firstname,middlename:middlename,lastname:lastname,username:username,password:password}, 
                        data: { admin_id: admin_id, id_number: id_number, rfid: rfid, firstname: firstname, middlename: middlename, lastname: lastname, username: username },
                        //  data : fd,
                        // contentType: false,
                        //  processData: false,
                        beforeSend: function() {
                            // $('.addeventmodal').text("Saving.. Please wait a minute!");  
                            //alert('saved events'); 
                        },
                        success: function(responce) {



                            // alert('success '+responce);

                            if (responce == 2) {
                                $(".errormsg").css("color", " red");
                                $(".errormsg").text("Username Already Used. Try Again!");
                                $(".username").css("border-color", " red");
                                $(".password").css("border-color", " gray");
                                $(".rfid").css("border-color", " gray");
                                setTimeout(function() {
                                    $(".errormsg").css("color", " white");
                                }, 4000);
                            } else if (responce == 3) {
                                $(".errormsg").css("color", " red");
                                $(".username").css("border-color", " gray");
                                $(".password").css("border-color", " gray");
                                $(".rfid").css("border-color", " red");
                                $(".errormsg").text("RFID Tag Already Used!");

                                setTimeout(function() {
                                    $(".errormsg").css("color", " white");
                                }, 4000);
                            } else if (responce == 4) {
                                $(".errormsg").css("color", " red");
                                $(".username").css("border-color", " gray");
                                $(".password").css("border-color", " gray");
                                $(".id_num").css("border-color", " red");
                                $(".errormsg").text("IDnumber Tag Already Used!");

                                setTimeout(function() {
                                    $(".errormsg").css("color", " white");
                                }, 4000);
                            } else {
                                window.location.href = 'setting.php';
                                showNotification('3', 'Account Successfully Updated!');
                                load_account_table();
                                $('#delete_admin_modal').modal('hide');
                                $('#form_add_admin')[0].reset();
                                $('#uploadedimage').html(' <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>');
                                $(".username").css("border-color", " gray");
                                $(".password").css("border-color", " gray");
                                $(".rfid").css("border-color", " gray");
                                $(".id_num").css("border-color", " gray");
                                $(".errormsg").text('');
                            }
                        }
                    });

                } else {
                    $(".wrongpass").css("color", " red");
                    $(".password").css("border-color", " red");
                    $(".password").css("border-color", " red");
                    $(".wrongpass").text("Incorrect Password!");

                    setTimeout(function() {
                        $(".wrongpass").css("color", " white");
                    }, 5000);
                }
            }
        });





    }


});



$(document).on('submit', '#form_add_admin', function(e) {
    e.preventDefault();

    var username = $('.username').val().toLowerCase();

    if ($('.rfid').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("RFID Tag Code is Required!");
        $(".rfid").css("border-color", " red");



        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('.position').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Position is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('.firstname').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Firstname is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('.lastname').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Lastname is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('.username').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Username is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('.password').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Password is required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else {

        // alert('add Successfully');
        $.ajax({
            url: "action/admin.php",
            method: "POST",
            data: $('#form_add_admin').serialize(),
            beforeSend: function() {
                $('.save_admin').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Saving...');
                //alert('saved events'); 
            },
            success: function(responce) {
                if (responce == 2) {
                    $(".errormsg").css("color", " red");
                    $(".errormsg").text("Username Already Used. Try Again!");
                    $(".username").css("border-color", " red");
                    $(".password").css("border-color", " gray");
                    $(".rfid").css("border-color", " gray");
                    setTimeout(function() {
                        $(".errormsg").css("color", " white");
                    }, 4000);
                } else if (responce == 3) {
                    $(".errormsg").css("color", " red");
                    $(".username").css("border-color", " gray");
                    $(".password").css("border-color", " gray");
                    $(".rfid").css("border-color", " red");
                    $(".errormsg").text("RFID Tag Already Used!");

                    setTimeout(function() {
                        $(".errormsg").css("color", " white");
                    }, 4000);
                } else if (responce == 4) {
                    $(".errormsg").css("color", " red");
                    $(".username").css("border-color", " gray");
                    $(".password").css("border-color", " gray");
                    $(".id_num").css("border-color", " red");
                    $(".errormsg").text("ID Number Already Used!");

                    setTimeout(function() {
                        $(".errormsg").css("color", " white");
                    }, 4000);
                } else if(responce == 1) {
                    // window.location.href = "setting.php";

                    $('.save_admin').html('<i class="fa fa-save"></i> Add Admin');
                    load_account_table();
                    $('#delete_admin_modal').modal('hide');
                    $('#form_add_admin')[0].reset();
                    $('#uploadedimage').html(' <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>');
                    $(".username").css("border-color", " gray");
                    $(".password").css("border-color", " gray");
                    $(".rfid").css("border-color", " gray");
                    successnotify('3', 'Account Successfully Added!');

                }
                else{
                 // console.log('not oakaaa')
                  alert('Error409: Adding Account:');
                  $('.save_admin').html('<i class="fa fa-save"></i> Add Admin');
                  load_account_table();
                  $('#delete_admin_modal').modal('hide');
                  $('#form_add_admin')[0].reset();
                  $('#uploadedimage').html(' <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>');
                  $(".username").css("border-color", " gray");
                  $(".password").css("border-color", " gray");
                  $(".rfid").css("border-color", " gray");
                }
                //  $('#form_add_admin')[0].reset();  

                // $('.addeventmodal').modal('hide');



            }
        });
    }

});

var year1 = "";
var year2 = "";
var column_name = "";
var column_value = "";

$(document).on('click', '#year1', function() {
    var year = $(this).data('id');
    $('#chooseyear1').text("" + year);
    $('#l1').text("" + year);
    year1 = year;
});
$(document).on('click', '#year2', function() {

    var year = $(this).data('id');
    $('#chooseyear2').text("" + year);
    $('#l2').text("" + year);
    year2 = year;
});


$(document).on('click', '.saved', function() {
    var course = $('#txtcourse').val();
    var major = $('#txtmajor').val();
    var year = $('#txtyear').val();
    var section = $('#txtsection').val();
    // var ay =  $('#lall').text();


    if (!course == "") {
        column_name = "c_course";
        column_value = course;
        $('#txtcourse').val("");
    }
    if (!major == "") {
        column_name = "c_major";
        column_value = major;
        $('#txtmajor').val("");
    }
    if (!year == "") {
        column_name = "c_year";
        column_value = year;
        $('#txtyear').val("");
    }
    if (!section == "") {
        column_name = "c_section";
        column_value = section;
        $('#txtsection').val("");
    }


    if (!column_name == "" && !column_value == "") {
        $.ajax({
            url: "action/category1.php",
            method: "POST",
            data: { cname: column_name, cvalue: column_value },
            beforeSend: function() {
                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {

                console.log(data);
                if (data == 1) {
                    // $('#tablemain').html(data);
                    load_category_table()
                        // if(data == "success")
                        // showNotification('2',' &nbsp Successfully Added!<br><br>');

                    successnotify('2', 'Successfully Added ');

                } else {
                    errornotify('4', ' Already Exist ');
                }

            }
        });
    } else {
        //showNotification('4',' &nbsp<b>Empty</b>  Field!!<br><br>Please Enter!!');
        errornotify('4', 'Empty Field!!  ');
    }




});




$(document).on('click', '.sy_saved', function() {
    var ay = $('#lall').text();
    var academic_year = ay.trim();
    var found = false;
    //alert(" ay:"+academic_year);
    if (!year1 == "" && !year2 == "") {
        column_name = "c_ay";
        column_value = ay;
        $('#l1').text("");
        $('#l2').text("");
        $('#chooseyear1').text("Select Year");
        $('#chooseyear2').text("Select Year");



        $.ajax({
            url: "action/data.php",
            method: "POST",
            data: { check_academic_year: academic_year },
            beforeSend: function() {
                // document.getElementById('save_sy_hide').style.display = 'none';
                // // id=aybtn103 spin class then Please Wait... id=aybtn104 disable
                // $("#aybtn103").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...');
                // document.getElementById('aybtn104').style.display = 'none';
                // $('.db_loading').html('<img src="images/loading.gif">');

            },
            success: function(data) {

                if (data) {
                    $(".error_sy").css("color", " red");
                    $('.error_sy').text('Academic Year Already Exist!!');

                    setTimeout(function() {
                        $(".error_sy").css("color", " white");
                    }, 2000);
                } else {
                    $.ajax({
                        url: "action/data.php",
                        method: "POST",
                        data: { academic_year: academic_year },
                        beforeSend: function() {
                            document.getElementById('save_sy_hide').style.display = 'none';
                            // id=aybtn103 spin class then Please Wait... id=aybtn104 disable
                            $("#aybtn103").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...');
                            document.getElementById('aybtn104').style.display = 'none';
                            $('.db_loading').html('<img src="images/loading.gif">');

                        },
                        success: function(data) {

                            //  console.log(data);
                            // $('#save_sy_hide').modal('hide');
                            window.location.href = "setting.php";
                            // $('#add_school_year').modal('hide');
                            // load_ay_table();
                            //  $('.database_table').html(data);
                            // successnotify('2',' Success <br> <b>'+getcolumn_name+'</b> Successfully deleted!');
                            // $('.db_loading').html('');
                            // document.getElementById('save_sy_hide').style.display = 'block';

                        }
                    });
                }

            }

        });



        // if (!found) {
        //     // alert(' okay all year:'+ay+"<");







        // }






    } else {
        $(".error_sy").css("color", " red");
        $('.error_sy').text('Please Select Academic Year first..');

        setTimeout(function() {
            $(".error_sy").css("color", " white");
        }, 2000);

        //errornotify('4',' Warning <br><br> Empty Field!!');
    }

});


$(document).on('click', '.del', function() {
    const id = $(this).attr('id');
    const col = $(this).data('id');
    const name = $(this).data('name');
    const type = $(this).data('type');
    $('.data1').val('' + id);
    $('.data2').val('' + col);
    $('.category_delete_info').text(type + " - " + name);
    $('#delete_category_modal').modal('show');

});
$(document).on('click', '.btn_del_category', function() {

    var id = $('.data1').val();
    var col = $('.data2').val();
    var getcolumn_name = "";
    if (col == "c_ay") {
        getcolumn_name = "Academic Year";
    } else if (col == "c_course") {
        getcolumn_name = "Course";
    } else if (col == "c_major") {
        getcolumn_name = "Major";
    } else if (col == "c_year") {
        getcolumn_name = "Year Level";
    } else if (col == "c_section") {
        getcolumn_name = "Section";
    }

    // alert(" id:"+id);
    // alert(" col:"+col);
    $.ajax({
        url: "action/category1.php",
        method: "POST",
        data: { id: id, col: col },
        beforeSend: function() {
            //  $('.addeventmodal').val("Saving...");  
        },
        success: function(data) {

            //console.log(data);
            $('#delete_category_modal').modal('hide');

            // $('#tablemain').html(data);
            load_category_table();
            successnotify('2', ' ' + getcolumn_name + '</b> Successfully deleted!');



        }
    });


});





$(document).ready(function() {
    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 200,
            height: 200
        }
    });
    $('#uploadimage').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                // alert('bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#upload_imageModal').modal('show');
    });

    $('.crop_image').click(function(event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(responce) {
            $.ajax({
                url: 'action/cropimage.php',
                type: 'post',
                data: { 'image': responce },
                success: function(data) {
                    $('#upload_imageModal').modal('hide');
                    $('#uploadedimage').html(data);
                    // alert(''+data);
                }
            });
        });
    });
});


function load_category_table() {
    var val = 'depaz';
    $.ajax({
        type: 'POST',
        url: 'action/category1.php',
        data: { val: val },
        dataType: 'json',
        success: function(response) {
            $('#tablemain').html(response);
        }
    });
}

function load_account_table() {
    var val = 'depaz';
    $.ajax({
        type: 'POST',
        url: 'action/admin.php',
        data: { showall: val },
        dataType: 'json',
        success: function(response) {

            // console.log(response);
            $('#account_table').html(response);
        }
    });
}

function load_ay_table() {
    var val = 'depaz';
    $.ajax({
        type: 'POST',
        url: 'action/data.php',
        data: { val: val },
        dataType: 'json',
        success: function(response) {
            $('#database_table').html(response);
        }
    });
}

function check_duplicate(data, type) {
    //  var val = data;
    // var found = false;
    var status = $('.admin_id').val();

    if (status == '') {

        $.ajax({
            type: 'POST',
            url: 'action/admin.php',
            data: { check_duplicate: data, type: type },
            dataType: 'json',
            success: function(response) {
                // alert('cd'+response)
                if (response == 2) {
                    $(".errormsg").css("color", " red");
                    $(".username").css("border-color", " red");
                    $(".password").css("border-color", " gray");
                    $(".rfid").css("border-color", " gray");
                    $(".errormsg").text("Username is Already Used!");
                    // $('.update_admin').prop('disabled', true);
                    // found = true;
                } else if (response == 3) {
                    $(".errormsg").css("color", " red");
                    $(".username").css("border-color", " gray");
                    $(".password").css("border-color", " gray");
                    $(".rfid").css("border-color", " red");
                    $(".errormsg").text("Rfid Tag is Already Used!");
                    ////  $('.update_admin').prop('disabled', true);
                    //// found = true;
                } else if (response == 4) {
                    $(".errormsg").css("color", " red");
                    $(".username").css("border-color", " gray");
                    $(".password").css("border-color", " gray");
                    $(".id_num").css("border-color", " red");
                    $(".errormsg").text("ID Number is Already Used!");
                    //  $('.update_admin').prop('disabled', true);
                    // found = true;

                } else {
                    //$(".errormsg").css("color"," red");
                    $(".username").css("border-color", " gray");
                    $(".password").css("border-color", " gray");
                    $(".rfid").css("border-color", " gray");
                    $(".id_num").css("border-color", " gray");
                    $(".errormsg").text("");
                    //   $('.admin_update').prop('disabled', false);
                    // found = false;

                }
                //return found;
                // alert(response)
                //$('#database_table').html(response);
            }
        });
    }
}

function addloghistory(action, action_name, description) {
    $.ajax({
        type: 'POST',
        url: 'action/log_history.php',
        data: { action: action, action_name: action_name, description: description },
        success: function(response) {
            // window.location.href = "events.php";
            // alert('success')
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