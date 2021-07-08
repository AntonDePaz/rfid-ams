$(document).ready(function() {

    // $(document).ajaxStart(function() {
    //     $("#loading").removeClass('hide');
    // }).ajaxStop(function() {
    //     $("#loading").addClass('hide');
    // });
    $('#loading_modal').modal('hide');



    load_container_event();
    $('#fines').bind('keypress', function(e) {
        var value = $('#fines').val();
        var char = (e.which) ? e.which : e.keyCode;
        if (char == 46 && value.indexOf('.') != -1)
            return false;
        if (char != 46 && char > 31 && (char < 48 || char > 57))
            return false;
        return true;
    });

    $(document).on('click', '.addevent', function(event) {
        event.preventDefault();
        //loadm
        // $(".modals").show();



        // $('body').append('<div id="loading"><img id="loading-image" src="../images/loading.gif" alt="Loading..." /></div>');
        $('#reset').modal({ backdrop: 'static', keyboard: false }, 'show');
    });

    $(document).on('click', '.eventspanel', function(event) {
        event.preventDefault();

        var eventid = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'action/jumpage.php',
            data: { jumpeventid: eventid },
            success: function(response) {
                window.location.href = "eventsliststudent.php";
            }
        });

        // alert('clck ecvent'+eventid);
        // href="eventsliststudent.php?id='.$row['fe_id'].'"
    });

    $(document).on('submit', '#add_event_form', function(event) {
        event.preventDefault();

        $.ajax({
            url: "action/event.php",
            method: "POST",
            data: new FormData(this),
            // data:$('#add_event_form').serialize(),  
            contentType: false,
            processData: false,
            cache: false,

            beforeSend: function() {
                $(".addeventmodal").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Saving Please wait..');
                // $('.close').click(function() {
                //     $(this).prop('disabled', true);
                // });
                $('#reset').modal('hide');

                $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');

                // $('#add_event_form')[0].reset();
                // $(".addeventmodal").html('<i class="fa fa-save"></i> Save Event');




                //  $(".close").prop("disabled", true);
                // $("#add_event_form :input").prop("disabled", true);
            },
            success: function(data) {

                // $.ajax({
                //       type: 'POST',
                //       url: 'action/log_history.php',
                //       data: {action:"Adding",action_name:"Events",description:eventname},
                //       success: function(response){

                // window.location.href = "events.php";
                //       }
                //     });

                $('#loading_modal').modal('hide');

                $('#add_event_form')[0].reset();
                $(".addeventmodal").html('<i class="fa fa-save"></i> Save Event');
                $('#reset').modal('hide');
                load_container_event();

                successnotify(2, "Event Successfully Added");
                //  $(".close").prop("disabled", false);
                //  $("#add_event_form :input").prop("disabled", false);



            }
        })


    });


    $(document).on('submit', '#modify_event_form', function(event) {
        event.preventDefault();
        // alert('edit');


        $.ajax({
            url: "action/event.php",
            method: "POST",
            data: new FormData(this),
            //data:$('#modify_event_form').serialize(), 
            contentType: false,
            processData: false,
            cache: false,

            beforeSend: function() {
                $('.edit_eventmodal').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Updating...');
                //alert('saved events'); 
                $('#modify').modal('hide');
                $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                // $(".close").prop("disabled", true);
                // $("#modify_event_form :input").prop("disabled", true);
            },
            success: function(data) {
                //  $.ajax({
                //         type: 'POST',
                //         url: 'action/log_history.php',
                //         data: {action:"Updated",action_name:"Events",description:eventnameedit},
                //         success: function(response){
                //            window.location.href = "events.php";
                //         }
                //       });

                $('#loading_modal').modal('hide');

                $('#modify_event_form')[0].reset();
                $(".edit_eventmodal").html('<i class="fa fa-edit"></i> Update');
                // $('#modify').modal('hide');
                load_container_event();
                $(".close").prop("disabled", false);
                $("#modify_event_form :input").prop("disabled", false);
                successnotify(2, "Event Successfully Updated");
                // window.location.href = "events.php";

            }
        });



    });

    // $(".confirm_delete_event_exit").click(function(){
    //   window.location.href = "events.php";
    //   });
    // $(".cancel_confirm_password").click(function(){
    //   window.location.href = "events.php";
    //   });
    $(".delete_event").click(function() {
        var description = $('.eventdescription_edit').val();
        var id = $('.event_id').val();
        var password = $('#confirm_password').val();

        // alert(' id:'+id);
        // alert(' password:'+password);

        $.ajax({
            type: 'POST',
            url: 'action/admin.php',
            data: { check_password: password },
            success: function(response) {

                if (response == 1) {

                    $.ajax({
                        url: "action/event.php",
                        method: "POST",
                        data: { delete_eventid: id },
                        //  url:"action/modify_events.php",  
                        // method:"POST",  
                        // data:{deleteid:id}, 
                        beforeSend: function() {
                            $('.delete_event').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Deletingzz...');

                            $('#modify').modal('hide');
                            $('#confirm_remove_event').modal('hide');
                            $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');

                            // $(".close").prop("disabled", true);
                            // $("#modify_event_form :input").prop("disabled", true);
                        },
                        success: function(data) {
                            //alert('deleted')
                            $('#loading_modal').modal('hide');
                            $('#form_password')[0].reset();
                            $(".delete_event").html('<span class = "glyphicon glyphicon-trash"></span> Confirm Delete ');
                            $('#confirm_remove_event').modal('hide');
                            load_container_event();


                            // $(".close").prop("disabled", false);
                            // $("#modify_event_form :input").prop("disabled", false);
                            //  $.ajax({
                            //           type: 'POST',
                            //           url: 'action/log_history.php',
                            //           data: {action:"Deleting",action_name:"Events",description:description},
                            //           success: function(response){
                            //              window.location.href = "events.php";
                            //           }
                            //         });                     

                        }
                    });
                } else {
                    $(".xpass").css("color", " red");
                    $(".xpass").text("Incorrect Password!");

                    setTimeout(function() {
                        $(".xpass").css("color", " transparent");
                    }, 2000);
                }
            }
        });


    });

    $(".confirm_delete_event").click(function() {
        // alert('confirm delete');
        var description = $('.eventdescription_edit').val();
        var id = $('.event_id').val();
        //alert(' deleteid:'+id);
        $.ajax({
            url: "action/event.php",
            method: "POST",
            data: { checkeventid: id },
            beforeSend: function() {
                $('.confirm_delete_event').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Deleting...');
            },
            success: function(data) {



                if (data > 1) {
                    // alert('naa sulod');
                    $('.confirm_delete_event').html('<span class = "glyphicon glyphicon-trash"></span> Yes ');
                    $('#modify_event_form')[0].reset();
                    $('#confirm_delete_event_modal').modal('hide');
                    //$('#confirm_remove_event').modal('show');
                    $('#confirm_remove_event').modal({ backdrop: 'static', keyboard: false }, 'show');
                } else {
                    //alert('wala sulod');
                    $.ajax({
                        url: "action/event.php",
                        method: "POST",
                        data: { delete_eventid: id },
                        beforeSend: function() {
                            // $('.confirm_delete_event').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Deleting...');
                            $('#confirm_delete_event_modal').modal('hide');
                            $('#confirm_remove_event').modal('hide');
                            $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                        },
                        success: function(data) {
                            $('#loading_modal').modal('hide');
                            // $('.confirm_delete_event').html('<span class = "glyphicon glyphicon-trash"></span> Yes ');
                            $('#confirm_remove_event_form')[0].reset();
                            // $('#confirm_delete_event_modal').modal('hide');
                            //$('#loading_modal').modal('hide');
                            load_container_event();

                            successnotify(2, "Event Successfully Deleted");


                            //  $.ajax({
                            //   type: 'POST',
                            //   url: 'action/log_history.php',
                            //   data: {action:"Deleting",action_name:"Events",description:description},
                            //   success: function(response){
                            //      window.location.href = "events.php";
                            //   }
                            // });  

                            //window.location.href = "events.php";

                            //  $('#confirm_delete_event_modal').modal('hide');
                            // $('.delete_btn').html('<button type="button" class="btn btn-danger btn-sm pull-left delete_eventmodal" name="btn_addeventmodal"><i class="fa fa-trash"> Delete</i></button>'); 
                        }
                    });
                }


            }
        });
    });



    $(".delete_eventmodal").click(function() {

        var Description = $('.eventdescription_edit').val();

        $('#modify').modal('hide');
        $('.eventdescription').text("" + Description);
        // $('#confirm_delete_event_modal').modal('show');
        $('#confirm_delete_event_modal').modal({ backdrop: 'static', keyboard: false }, 'show');


    });





    $('#confirm_remove_event').on('shown.bs.modal', function() {
        $('#confirm_remove_event_form')[0].reset();
    });
    $(function() {
        $(document).on('click', '.menu', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            //  $('#modify').modal('show');
            $('#modify').modal({ backdrop: 'static', keyboard: false }, 'show');
            //$('.deleteid').val(id);
            //alert(' id:'+id);
            getRow(id);
        });

    });

    function getRow(id) {

        $.ajax({
            type: 'POST',
            url: 'action/event.php',
            data: { getevent: id },
            dataType: 'json',
            success: function(response) {
                $('.event_id').val(response.fe_id);
                $('#edit_eventname').val(response.Description);
                $('#edit_date').val(response.date);
                $('#edit_date2').val(response.date);
                $('#edit_time').val(response.time);
                $('#edit_fines').val(response.fines);
                $('#edit_tap').val(response.tap.trim());
                $('#edit_apm').val(response.apm.trim());
                $('.eventdescription_edit').val(response.Description);

            }
        });
    }

    function load_container_event() {
        var value = 'all';
        $.ajax({
            type: 'POST',
            url: 'action/event.php',
            data: { value: value },
            dataType: 'json',
            success: function(response) {

                $('#load-container-data').html(response);

            }
        });
    }










});