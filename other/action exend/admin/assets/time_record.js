$(document).ready(function() {

    $(".rse").tooltip({ title: 'Remove Students Not Belong for this event', placement: 'right' });

    //  var table =  $('#students_table').DataTable({
    //      'ordering'  : false,
    //      "processing": true,
    //      "serveSide" : true,
    //          "async" : true,
    //    "responsive" : true,
    //          ajax : {
    //          type :"POST",
    //          url  : "action/student.php",
    //          data : {
    //                  "alldata": 'success'
    //              },
    //            error: function (){
    //                alert('Something Error for Getting Data From Student(s)! Please Again Later.')
    //            }
    //        },
    //        lengthMenu : [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ]
    //     });
    //    // table.ajax.reload();
    //   // table.ajax.reload();
    //    setInterval( function () {
    //    table.ajax.reload();
    // }, 20000 );




    var dtable = $('#student_event_time_table').DataTable({

        // 'ordering': false,
        // "processing": false,
        // "serveSide": true,
        // "async": true,
        // "responsive": true,
        // ajax: {
        //     type: "POST",
        //     url: "action/event.php",
        //     data: {
        //         "slet": 'success'
        //     }
        //     // error: function (){
        //     //     alert('Something Error for Getting Data From Student(s)! Please Again Later.')
        //     // }
        //},
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });






    $(document).on('click', '.start', function(e) {
        e.preventDefault();

        var get_status = $('.get_status').val();
        // var eventid = $('.eventid').val();
        if (get_status == 1) {
            // $('.tap_status').text(tap_status);
            $('#actived').modal('hide');
            window.open('attendance_event.php', 'name', 'width=1000,height=500,toolbar=0');
        } else {
            $(".errormsg").css("color", " red");
            $(".errormsg").text("Please activated status first!");

            setTimeout(function() {
                $(".errormsg").css("color", " white");
            }, 3000);
            //showNotification(4," Please activated status first!");
        }


    });



    $(document).on('click', '.activate', function(e) {
        e.preventDefault();
        ///$('#edit').modal('show');
        var id = $(this).data('id');
        var eventid = $('.eventid').val();
        var status = '';

        //alert('idac:'+id);
        $.ajax({
            url: "action/attendance.php",
            method: "POST",
            data: { active_id: id, active_eventid: eventid, status: status },
            dataType: 'json',
            beforeSend: function() {
                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {

                console.log(data);

                $('#attendance_status_table').html(data);
                // if(data == "success")
                // showNotification('2',' &nbsp Successfully Added!<br><br>');



            }
        });




    });


    $(document).on('click', '.deactivate', function(e) {
        e.preventDefault();
        ///$('#edit').modal('show');
        var id = $(this).data('id');
        var eventid = $('.eventid').val();
        var status = 1;

        //alert('ideac:'+id+' '+eventid);
        $.ajax({
            url: "action/attendance.php",
            method: "POST",
            data: { active_id: id, active_eventid: eventid, status: status },
            dataType: 'json',
            beforeSend: function() {
                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {

                console.log(data);

                $('#attendance_status_table').html(data);
                // if(data == "success")
                // showNotification('2',' &nbsp Successfully Added!<br><br>');



            }
        });
    });
    // $(function(){
    //   $(document).on('click', '.edit', function(e){
    //     e.preventDefault();
    //     $('#edit').modal('show');
    //     var id = $(this).data('id');
    //     getRow(id);
    //   });

    //   $(document).on('click', '.delete', function(e){
    //     e.preventDefault();
    //     $('#delete').modal('show');
    //     var id = $(this).data('id');
    //     getRow(id);
    //   });


    //   $(document).on('click', '.photo', function(e){
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     getRow(id);
    //   });

    // });

    // function getRow(id){
    //   $.ajax({
    //     type: 'POST',
    //     url: 'voters_row.php',
    //     data: {id:id},
    //     dataType: 'json',
    //     success: function(response){
    //       $('.id').val(response.id);
    //       $('#edit_firstname').val(response.firstname);
    //       $('#edit_lastname').val(response.lastname);
    //       $('#edit_password').val(response.password);
    //       $('.fullname').html(response.firstname+' '+response.lastname);
    //     }
    //   });
    // }

    var get_id_array = new Array();
    var student_id = 0;
    var concat_all_id = "";
    var index = 0;
    $(document).on('click', '#chk_getid', function() {

        var row = $(this).closest('tr');
        if ($(this).prop("checked") == true) {
            var id = $(this).data('id');
            get_id_array[index] = id;
            index++;
        } else if ($(this).prop("checked") == false) {
            var id = $(this).data('id');
            for (var i = 0; i < get_id_array.length; i++)
                if (get_id_array[i] == id) {
                    get_id_array[i] = null;
                }
        }

    });


    $(document).on('click', '.rse', function() {

        var gf = false;
        for (var i = 0; i < get_id_array.length; i++) {
            if (get_id_array[i] != null) {
                gf = true;
            }
        }
        if (!gf) {
            errornotify(4, 'Note: Please Select Student(s) First..');
            // alert('please select students first');
        } else {
            $('#removestudent').modal('show');

        }
    });

    $(document).on('click', '.btndelete', function() {

        var get_event_id = $('.get_event_id').val();
        var get_event_id = get_event_id.trim();

        for (var i = 0; i < get_id_array.length; i++) {
            if (get_id_array[i] != null) {
                //alert(" "+get_id_array[i]);
                student_id = get_id_array[i] + ",";
                concat_all_id += student_id;
            }


        }

        //alert(''+concat_all_id);

        $.ajax({
            url: "action/attendance.php",
            method: "POST",
            data: { get_event_id: get_event_id, concat_all_id: concat_all_id },
            beforeSend: function() {
                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {
                //data =  $.parseJSON(data);
                console.log(data);



                window.location.href = "eventsliststudent.php?id=" + get_event_id + "";

            }
        });


    });


    //  function load_time_record() {
    //        // var value = 'all';
    //         var get_event_id = $('.get_event_id').val();
    //         $.ajax({
    //             type: 'POST',
    //             url: 'action/event.php',
    //             data: { get_event_time_record_id: get_event_id },
    //             dataType: 'json',
    //             success: function(response) {

    //                 $('#load-container-data').html(response);

    //             }
    //         });
    //     }

});