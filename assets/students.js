$(document).ready(function() {

    $('#print_option_model').on('hidden.bs.modal', function(e) {
        activeprint();
    });

    // $(function () {
    // table.ajax.reload();
    // }); 
    //load_students_table();
    activeprint();
    // $(function () {
    // function load_students_table(){
    var dtable = $('#students_table').DataTable({

        'ordering': false,
        "processing": false,
        "serveSide": true,
        "async": true,
        "responsive": true,
        ajax: {
            type: "POST",
            url: "action/student.php",
            data: {
                "alldata": 'success'
            },
            error: function() {
                alert('Something Error for Getting Data From Student(s)! Please Again Later.')
            }
        },
        lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
            //       dom: 'lBfrtip',
            //  buttons: [ 'excel', 'csv', 'pdf', 'copy','print' ],
            //
            // "columnDefs":[{ },],
            // "columns" : [
            //   {"data": "id" },
            //   {"data":"id_number"},
            //   {"data":"firstname"},
            //   {"data":"middlename"},
            //   {"data":"lastname"},
            //   {"data":"year"},
            //   {"data":"section"},
            //   {"data":"course"},
            //   {"data":"major"}
            // ] 
    });
    // table.ajax.reload();
    // table.ajax.reload();
    //     setInterval( function () {
    //       dtable.ajax.reload();
    // }, 21000 );

    //$('#students_table').DataTable().ajax.reload();

    // Uncheck
    function activeprint() {


        $("#chkall_course").prop("checked", true);
        $("#rcourse").prop("checked", true);

        $(':checkbox').each(function() {
            this.checked = true;
        });
        $("#chkall_year").prop("checked", true);
        $("#ryear").prop("checked", true);

        $(':checkbox').each(function() {
            this.checked = true;
        });
        document.getElementById("panel_course").style.display = "none";
        document.getElementById("panel_year").style.display = "block";
        // document.getElementById("panel_body").style.display = "none";

    }



    $('#rcourse').click(function() {
        // $("#chkall_course").prop("checked", true);
        //       $(':checkbox').each(function() {
        //           this.checked = true;                        
        //       });
        document.getElementById("panel_year").style.display = "none";
        document.getElementById("panel_course").style.display = "block";
        // if ($(this).is(':checked'))  
        // alert('course');
    });
    $('#ryear').click(function() {
        // $("#chkall_year").prop("checked", true);
        //       $(':checkbox').each(function() {
        //           this.checked = true;                        
        //       });
        document.getElementById("panel_course").style.display = "none";
        document.getElementById("panel_year").style.display = "block";
        // if ($(this).is(':checked'))  
        //alert('year');
    });

    // if ($("input[name='inlineRadioOptions']").is(':checked')) {
    //    alert('Nothing is checked!');
    // }

    // if($('#rcourse').is(':checked')) 
    // { alert("it's course"); }
    // if($('#ryear').is(':checked')) 
    // { alert("it's year"); }
    $(document).on('click', '.cprint102', function(e) {
        e.preventDefault();
        // alert('adasdsa')
        document.getElementById("panel_body").style.display = "block";

    });


    $(document).on('click', '.cprint101', function(e) {
        e.preventDefault();

        var type = $('#pxtype').val();
        // alert('sdf')
        //  var year = new Array();
        //  var i = 0;
        //  var course = new Array();
        //  var j = 0;
        // alert(' t:'+type)
        var year = '';
        var course = '';


        if (document.getElementById('chkall_course').checked) {
            course = 'all';

        } else {
            $("input:checkbox[name=chkcourse]:checked").each(function() {
                course += "'" + $(this).val() + "',";
                // check = true;
            });
        }
        // alert(''+al);
        // course[j] = $(this).val();

        // j++;




        if (document.getElementById('chkall_year').checked) {
            year = 'all';

        } else {
            $("input:checkbox[name=chkyear]:checked").each(function() {
                //  al = $(this).val();
                //year[i] = $(this).val();
                // i++;
                year += $(this).val() + ",";
            });
            // check = true;
        }



        if (year == '') {
            alert('please choose');
        } else if (course == '') {
            alert('please choose');

        } else {
            //alert('year:'+year);
            //alert('course:'+course); 
            $.ajax({
                url: "action/student.php",
                method: "POST",
                dataType: 'json',
                data: { year: year, course: course, type: type },
                beforeSend: function() {
                    $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                    // $(".btnsave13").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Updating...'); 

                },
                success: function(data) {



                    $('#loading_modal').modal('hide');
                    // printJS({
                    //     printable: someJSONdata,
                    //     properties: [
                    //   { field: 'name', displayName: 'Full Name'},
                    //   { field: 'email', displayName: 'E-mail'},
                    //   { field: 'phone', displayName: 'Phone'}
                    //     ],
                    //     type: 'json'
                    //       })

                    // printJS({
                    //   printable: someJSONdata,
                    //   type: 'json',
                    //   properties: ['name', 'email', 'phone'],
                    //   header: '<h3 class="custom-h3">My custom header</h3>',
                    //   style: '.custom-h3 { color: red; }'
                    //   })










                    //window.open('action/prints.php','name','width=600,height=400,toolbar=0');
                    //     if(data == 1){
                    //      // alert('print')
                    //   //  window.location.href = "action/prints.php";
                    //   $('#print_option_model').modal('hide');
                    //   activeprint();
                    // window.location.href = "action/prints.php";
                    //    // window.open('action/prints.php','name','width=600,height=400,toolbar=0');

                    //     }
                    if (data == 2) {
                        //  alert('excel')
                        $('#print_option_model').modal('hide');
                        activeprint();
                        window.location.href = "action/student_export_excel.php";
                    } else {
                        $('#print_option_model').modal('hide');
                        activeprint();
                        printJS({
                            printable: data,
                            properties: ['id_number', 'firstname', 'middlename', 'lastname',
                                'year', 'section', 'course', 'major'
                            ],
                            type: 'json'
                        });
                    }
                    //     // else {
                    //     //   alert('error')
                    //     // }
                }

            });
            // for(var t = 0; t < year.length; t++){
            //     alert('y:'+year[t]);
            // }

            // for(var t = 0; t < course.length; t++){
            //     alert('c:'+course[t]);
            // }
        }

    });


    ////////////////////////////////////////////////////////////////////////////

    $('#chkall_course').on('click', function() {
        if (this.checked) {
            $('.chkcourse').each(function() {
                this.checked = true;
            });
        } else {
            $('.chkcourse').each(function() {
                this.checked = false;
            });
        }
    });

    $('.chkcourse').on('click', function() {
        if ($('.chkcourse:checked').length == $('.chkcourse').length) {
            $('#chkall_course').prop('checked', true);
        } else {
            $('#chkall_course').prop('checked', false);
        }
    });

    $('#chkall_year').on('click', function() {
        if (this.checked) {
            $('.chkyear').each(function() {
                this.checked = true;
            });
        } else {
            $('.chkyear').each(function() {
                this.checked = false;
            });
        }
    });

    $('.chkyear').on('click', function() {
        if ($('.chkyear:checked').length == $('.chkyear').length) {
            $('#chkall_year').prop('checked', true);
        } else {
            $('#chkall_year').prop('checked', false);
        }
    });








    $('.btn_print').click(function(event) {
        /* Act on the event */
        $('#xpbtntype').html('<i class="fa fa-print"></i> Print');
        $('#pxtype').val('print');
        $('#print_option_model').modal('show');
    });
    $('.xexport').click(function(event) {
        /* Act on the event */
        $('#xpbtntype').html('<i class="fa fa-upload"></i> Export (Excel)');
        $('#pxtype').val('excel');
        $('#print_option_model').modal('show');
        //window.open('action/printstudentlist.php','name','width=600,height=400,toolbar=0');

    });


    $(document).on('click', '.del_student', function(e) {
        e.preventDefault();
        var delete_id = $('.id').val();

        $.ajax({
            url: "action/student.php",
            method: "POST",
            data: { delete_id: delete_id },
            beforeSend: function() {
                $(".btn_del_stu").html('<button type="button" class="btn btn-danger del_student" name="delete"><i style="color: white;" class="fa fa-spinner fa-spin"></i> Deleting..</button>');
            },
            success: function(data) {

                //  $('#form_edit_student')[0].reset();  
                $('#delete').modal('hide');
                // $(".btnsave13").html('<i class="fa fa-check-square-o"></i> Save Changes'); 

                $(".btn_del_stu").html('<button type="button" class="btn btn-danger del_student" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button>');
                $('#students_table').DataTable().ajax.reload();
                successnotify(2, 'Student Successfully Deleted.');

                //  setInterval( function () {
                //   dtable.ajax.reload();
                // }, 500 );
                //  window.location.href = "students_list.php";
                // loadtable();


            }
        });

    });


    $(document).on('submit', '#form_add_student', function(event) {
        event.preventDefault();

        $.ajax({
            url: "action/student.php",
            method: "POST",
            // dataType: 'json',
            // data: {
            //   data: JSON.stringify(data)
            // },
            data: new FormData(this),
            // data:$('#formjewel').serialize(), 
            contentType: false,
            processData: false,
            //  url:"action/add_students.php",  
            //  method:"POST",  
            //  data: {rfid:rfid,idnumber:idnumber,semester:semester,firstname:firstname,middlename:middlename,lastname:lastname,section:section,yearlevel:yearlevel,course:course,major:major},
            beforeSend: function() {
                $(".btnsave12").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Saving...');

                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {


                    if (data == 4) {
                        $(".errormsg").css("color", " red");
                        $(".errormsg").text("RFID CODE is exist already. Please Double Check!!");
                        setTimeout(function() {
                            $(".errormsg").css("color", "transparent");
                        }, 6000);
                        $(".btnsave12").html(' <i class="fa fa-save"></i> Save');
                    } else if (data == 3) {
                        // alert('id number is exist')
                        $(".errormsg").css("color", " red");
                        $(".errormsg").text("ID Number is Exist Already!");
                        setTimeout(function() {
                            $(".errormsg").css("color", "transparent");
                        }, 5000);
                        $(".btnsave12").html(' <i class="fa fa-save"></i> Save');
                    } else if (data == 1) {

                        $('#addnew').modal('hide');
                        $(".btnsave12").html('<i class="fa fa-save"></i> Save');
                        $('#form_add_student')[0].reset();
                        //table.ajax.reload();
                        $('#students_table').DataTable().ajax.reload();
                        successnotify(2, 'Student Successfully Added.');
                        // setInterval( function () {
                        //   dtable.ajax.reload();
                        // }, 500 );

                        //window.location.href = "students_list.php";
                    } else {
                        alert('Error: ASError.')
                    }
                    // loadtable();
                    // $('#form_add_student')[0].reset();  

                    //  $(".btnsave12").html('<i class="fa fa-save"></i> Save'); 
                    //   $('#addnew').modal('hide');
                    //  window.location.href = "students_list.php";

                    // loadtable();

                }
                // error: function (){
                // 	alert('Error: L33+ #form-login');
                // }
        });
        //  } 

    });



    $(document).on('submit', '#form_edit_student', function(e) {
        e.preventDefault();

        $.ajax({

            url: "action/student.php",
            method: "POST",
            data: new FormData(this),
            // data:$('#formjewel').serialize(), 
            contentType: false,
            processData: false,
            //  data: {
            //     data_edit: JSON.stringify(data_edit)
            //   }, 
            //data: {id:id,rfid:rfid,idnumber:idnumber,semester:semester,firstname:firstname,middlename:middlename,lastname:lastname,section:section,yearlevel:yearlevel,course:course,major:major},
            beforeSend: function() {
                $(".btnsave13").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Updating...');

            },
            success: function(data) {

                // alert(''+data);


                //  window.location.href = "students_list.php";
                // loadtable();

                if (data == 3) {
                    // alert('id number is exist')
                    $(".errormsg").css("color", " red");
                    $(".errormsg").text("ID Number is Exist Already!");
                    setTimeout(function() {
                        $(".errormsg").css("color", "transparent");
                    }, 5000);
                    $(".btnsave13").html('<i class="fa fa-check-square-o"></i> Save Changes');
                } else if (data == 4) {
                    $(".errormsg").css("color", " red");
                    $(".errormsg").text("RFID CODE is exist already. Please Double Check!!");
                    setTimeout(function() {
                        $(".errormsg").css("color", "transparent");
                    }, 6000);
                    $(".btnsave13").html('<i class="fa fa-check-square-o"></i> Save Changes');
                } else if (data == 1) {
                    // setInterval( function () {
                    //   dtable.ajax.reload();
                    // }, 500 );
                    $('#students_table').DataTable().ajax.reload();
                    $('#edit').modal('hide');
                    $('#form_edit_student')[0].reset();

                    $(".btnsave13").html('<i class="fa fa-check-square-o"></i> Save Changes');
                    successnotify(2, 'Student Successfully Updated.');
                    // window.location.href = "students_list.php";
                } else {
                    alert('Error: ESError.')
                }


            }
        });


    });





    $(function() {
        $(document).ready(function() {
            $('#upload_csv_form').on('submit', function(e) {
                e.preventDefault();

                // alert('click upload2');  
                $.ajax({
                    url: "action/import_csv_students.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        // $(".uploadcsv_btn").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Uploading Please Wait...');
                        $('#import_excel').modal('hide');
                        $('#loading_text').text('Uploading please wait a minute...');
                        $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');

                    },
                    success: function(data) {

                        //alert(data);

                        if (data == 'error1') {
                            alert('invalid file');
                        } else if (data == 'error2') {
                            alert('please select file');
                        } else {

                            $('#loading_modal').modal('hide');
                            // $('#import_excel').modal('hide');
                            $('#upload_csv_form')[0].reset();
                            $('#students_table').DataTable().ajax.reload();
                            showNotification(2, "Successfully Imported Data.");
                        }
                        // setInterval( function () {
                        //               dtable.ajax.reload();
                        //             }, 500 );
                        // $('#student_table').html(data);
                        //  $('#example1').html(data.html);
                        // window.location.href = "students_list.php";


                    }



                });


            });

        });

        //getRow(id);

    });

    $(function() {
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            $('#edit').modal('show');
            var id = $(this).data('id');
            getRow(id);
        });
        $(document).on('click', '.del', function(e) {
            e.preventDefault();

            $('#delete').modal('show');
            var id = $(this).data('id');
            getRow(id);
        });
    });

    function getRow(id) {
        $.ajax({
            type: 'POST',
            url: 'action/student.php',
            data: { getinfo: id },
            dataType: 'json',
            success: function(response) {
                //console.log(response);
                $('.id').val(response.student_id);
                $('#edit_rfid').val(response.rfid);
                $('#edit_firstname').val(response.firstname);
                $('#edit_middlename').val(response.middlename);
                $('#edit_lastname').val(response.lastname);
                $('#edit_yearlevel').val(response.year);
                $('#edit_section').val(response.section.toUpperCase().trim());
                $('#edit_course').val(response.course.toUpperCase().trim());
                $('#edit_major').val(response.major.toUpperCase().trim());
                $('#edit_idnumber').val(response.id_number);
                $('#drfid').val(response.rfid);
                $('#didnumber').val(response.id_number);
                $('.student_delete').text(" " + response.firstname + " " + response.lastname + "");

            },
            error: function() {
                alert('Error: L33+ #edit student');
            }
        });
    }

    // $(document).on('submit', '#form_edit_student', function(e){
    //   e.preventDefault();
    //       $.ajax({
    //         type: 'POST',
    //         url: 'action.php',
    //         data: {id:id},
    //         success: function(response){
    //           // data =  $.parseJSON(response);
    //            console.log(response);

    //           // alert(' fn: '+data.firstname);

    //           // $('.id').val(id);
    //           // $('#edit_firstname').val(data.firstname);
    //         // $('#edit_lastname').val(response.lastname);
    //           //$('.description').html(response.description);
    //         }
    //       });


    // });

    // function load_student_table(){
    //   $.ajax({
    //     type: 'POST',
    //     url: 'get_students_id.php',
    //     data: {id:id},
    //     success: function(response){
    //        data =  $.parseJSON(response);
    //       console.log(data);

    //       alert(' fn: '+data.firstname);

    //       $('.id').val(id);
    //       $('#edit_firstname').val(data.firstname);
    //      // $('#edit_lastname').val(response.lastname);
    //       //$('.description').html(response.description);
    //     }
    //   });
    // }


});