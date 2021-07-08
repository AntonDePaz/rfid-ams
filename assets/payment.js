$(document).ready(function() {



    $("#getchkx").tooltip({ title: 'This Event is not yet Done!', placement: 'top' });

    var options = {}
    options.onScan = function(barcode) {
        //	alert(' barcode:'+barcode);
        getinfo(barcode);
        getbalance(barcode);
        $('.search').val('');
    };
    try {
        onScan.attachTo(document, options);
        console.log("onScan Started!");
    } catch (e) {
        onScan.setOptions(document, options);
        console.log("onScansettings changed!");
    }




    // $('.search').focus();


    //$('#selectall').click(function(){
    //  $('input[type=checkbox]').prop('checked',$('#selectall').is(':checked'));
    //});


    // $(':not(#selectall)').click(function(){
    //   if($(this).is(':checked'))
    //   {
    //     $(this).addClass('clicked');
    //   }
    //   else
    //   {
    //     $(this).removeClass('clicked');
    //   }
    // });


    // $('#selectall').click(function(){
    //   $(':not(.clicked)').prop('checked',$('#selectall').is(':checked'));
    // });


});




$('.search').change(function() {
    var rfid = $(this).val();
    getinfo(rfid);
    getbalance(rfid);
    $('.search').val('');
    //
});

var totall = 0;


$(document).ready(function() {


    //$(".disabled").tooltip({title:'Note: This event is not yet done!',placement:'top'});


    // $(':not(#checkall)').click(function(){
    //     if($(this).is(':checked'))
    //     {
    //       $(this).addClass('clicked');
    //     }
    //     else
    //     {
    //       $(this).removeClass('clicked');
    //     }
    //   });
    $('#checkall').click(function() {
        $(':not(.clicked)').prop('checked', $('#checkall').is(':checked'));
        if ($(this).prop("checked") == true) {
            var totalall = $('.totalall').val();
            $('#totals').text("" + totalall);
        } else {
            // var totalall = $('.totalall').val();
            $('#totals').text("0.00");
        }

    });
    $('#cancel').click(function() {
        window.location.href = "payment.php";
    });

    var id_array = new Array();
    var t = 0;
    $(document).on('click', '#getchk', function() {

        // $('#myModaladminupdate').modal('show');


        var row = $(this).closest('tr');



        // $('#uid').val(row.find('td:eq(0)').text());
        // $('#ufn').val(row.find('td:eq(1)').text());
        // $('#uln').val(row.find('td:eq(2)').text());
        // $('#uuser').val(row.find('td:eq(3)').text());


        //  alert(" cost: "+row.find('td:eq(2)').text());

        if ($(this).prop("checked") == true) {

            var id = row.find('td:eq(1)').text();
            var to = row.find('td:eq(3)').text();
            var rem = to.substring(2, to.length).trim();
            var tot = parseFloat(rem);
            totall += tot;
            $('#cash').val("");
            $('.change').text("0.00");
            $('.lack').text("");
            $('#print').prop('disabled', true);
            // alert('true');
            //  alert(' ttot '+row.find('td:eq(2)').text());
            //   alert(' rem '+rem);
            // alert(' id '+id);

            id_array[t] = id;
            t++;

        } else if ($(this).prop("checked") == false) {
            $('#checkall').prop('checked', false);
            var id = row.find('td:eq(1)').text();
            var to = row.find('td:eq(3)').text();
            var rem = to.substring(2, to.length).trim();
            var tot = parseFloat(rem);
            totall -= tot;
            $('#cash').val("");
            $('.change').text("0.00");
            $('.lack').text("");
            $('#print').prop('disabled', true);
            for (i = 0; i < id_array.length; i++)
                if (id == id_array[i]) {
                    //alert(" delete id:"+id_array[i]);
                    id_array[i] = null;
                }
        }

        //   alert(''+totall);

        const formatcurrency = amount => {
            return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
        }
        $('#totals').text("" + formatcurrency(totall));
        // $('#totals').text(""+totall.toFixed(2));



    });



    $(document).on('click', '#print', function(e) {
        e.preventDefault();

        var student_id = $('.student_id').val();
        var my_id = "",
            concat_fee_event_id = "";

        for (i = 0; i < id_array.length; i++) {
            if (id_array[i] != null) {
                // alert(" id all:"+id_array[i]);

                my_id = id_array[i] + ",";
                concat_fee_event_id += my_id;


            }
        }
        // alert(" id:"+concat_fee_event_id);
        // alert(" sid:"+student_id);
        $.ajax({
            url: "action/payment_transaction.php",
            method: "POST",
            data: { student_id: student_id, concat_fee_event_id: concat_fee_event_id },
            beforeSend: function() {
                //  $('.addeventmodal').val("Saving...");
            },
            success: function(data) {
                console.log(data);
                // $('#form_add_student')[0].reset();
                // $('#addnew').modal('hide');

                window.location.href = "payment.php";

                // concat_fee_event_id = null;
                // $('.change').text("0.00");
                //  $('.lack').text("");
                //  $('#cash').val("");
                //  $('#totals').text("0.00")
                //  $('#print').prop('disabled',true);
                //  totall = 0;
            }
        });

        totall = 0;

    });



});


$(document).ready(function() {




    $('#print').prop('disabled', true);
    $(document).ready(function() {
        $('#cash').bind('keypress', function(e) {
            var value = $('#cash').val();
            var char = (e.which) ? e.which : e.keyCode;
            if (char == 46 && value.indexOf('.') != -1)
                return false;
            if (char != 46 && char > 31 && (char < 48 || char > 57))
                return false;
            return true;
        });
    });

    $('#totals').change(function() {
        // alert('text change');
    });
    $('#search').keyup(function() {
        $('.change').text("0.00");
        $('.lack').text("");
        $('#cash').val("");
        $('#totals').text("0.00")
        $('#print').prop('disabled', true);
        totall = 0;
    });

    $('#cash').keyup(function() {
        var total = parseFloat($('#totals').text());
        var cash = parseFloat($('#cash').val());
        var change = '0.00';


        if (cash >= total && total > 1) {
            change = cash - total;
            $('.change').text(change.toFixed(2));
            $('.lack').text("");
            $('#print').prop('disabled', false);
        } else if (cash < total) {
            $('.change').text(change);
            $('.lack').text("Insufficient cash amount!");
            $('#print').prop('disabled', true);
        } else {
            $('.change').text(change);
            $('.lack').text("");
            $('#print').prop('disabled', true);


        }


    });








});
// $('#search').keyup(function(){
//   if(!$('#search').val() == ""){
//    getbalance();
//     getinfo();
//   }


// });
// $('#btnsearch').keyup(function(){
//   if(!$('#search').val() == ""){
//    getbalance();
//     getinfo();
//   }


// });
// $(document).on('click', '#btnsearch', function(){
//   getinfo();
//   getbalance();
//
//   $('.search').focus();
//     $('.search').val('');
// });

$(document).on('click', '#rem', function() {

    $('#remv').remove();
    //alert('click');


});












// function getRow(id){

//   $.ajax({
//     type: 'POST',
//     url: 'actionpayment.php',
//     data: {id:id},
//     dataType: 'json',
//     success: function(response){
//      // $('.id').val(response.id);
//       //$('#trow').val(response.amount);


//       console.log(response.amount);
//      // $('#edit_max_vote').val(response.max_vote);
//      // $('.description').html(response.description);
//     }
//   });
// }


// $(document).on('click', '#chk', function(){


// var row = $(this).closest('tr');
//  //alert(""+row.find('td:eq(2)'));

//  var to = row.find('td:eq(1)').text();

//  var rem = to.substring(1,to.length).trim();
//   var tot = parseFloat(rem);
//   totall += tot;


//  //var tot += to;
//  //alert(''+tot);
//  //$('#totals').text(to.text());

// $('#cash').val(totall);



// });

// var totall = 0;

// $(document).ready(function(){

// $('input[type=checkbox]').click(function(){


//           var row = $(this).closest('tr');

//          //  var cost = $(this).attr("data-id");

//          //  alert(" cost: ");


//           if($(this).prop("checked") == true)
//           {

//             var to = row.find('td:eq(2)').text();
//           var rem = to.substring(1,to.length).trim();
//           var tot = parseFloat(rem);
//             totall += tot;
//             //alert('true');

//           }
//           else if ($(this).prop("checked") == false)
//           {
//           var to = row.find('td:eq(2)').text();
//           var rem = to.substring(1,to.length).trim();
//           var tot = parseFloat(rem);
//             totall -= tot;
//            // alert('false');
//           }

//        // var tot += to;
//        //  alert(''+tot);

//       // $('#cash').val(totall);
//         $('#totals').text(""+totall);
//     });
// });






function getbalance(barcode) {
    // var record = $('#search').val();
    //alert('getbal:'+barcode);
    $.ajax({
        url: 'action/payment.php',
        method: 'post',
        data: { record: barcode },
        dataType: 'json',
        cache: false,
        success: function(data) {
            // alert('success')
            //  data =  $.parseJSON(data);
            // console.log(data[0]);
            // console.log(data[1]);

            // console.log(data.html);

            if (data.status == 'success') {
                // $('.tdamount1').text("12");

                //  $('#table').html(data.html);
                $('#datarow').html(data.html);
                $('.totalall').val(data.total);

            }
            if (data.status == 'error') {
                showNotification(4, "Student not found!<br>");
                // $('#table').html(data.html);
                $('#datarow').html(data.html);
            }


        }
    });


}

function getinfo(barcode) {
    //var id = $('#search').val();
    //alert('getinfo:'+barcode);
    $.ajax({
        url: 'action/payment.php',
        method: 'post',
        data: { get_student_info: barcode },
        cache: false,
        success: function(data) {
            data = $.parseJSON(data);

            if (data == null) {
                errornotify('4', '&nbsp Student Not Found');
                $('.student_id').val("");
                $('.fn').text("");
                $('.mn').text("");
                $('.ln').text("");
                $('.year').text("");
                $('.section').text("");
                $('.course').text("");
                $('.major').text("");
            } else {

                //console.log(data.firstname);
                $('.student_id').val(data.student_id);
                $('.fn').text(data.firstname);
                // $('.mn').text(data.middlename);
                $('.ln').text(data.lastname);
                $('.year').text(data.year);
                $('.section').text(data.section);
                $('.course').text(data.course);
                $('.major').text(data.major);
            }

        }
    });


}







//var checked = [];

// $("input[name='amount[]']:checked").each(function(){

//   checked.push(parseInt($(this).val()));
//   alert(""+checked[0]);
// });

// $(document).on('click', '.btnupdate', function(){
//   var idx = $(this).attr("id");
//    var row = $(this).closest('tr');
//     $('#name').val(row.find('td:eq(2)').text());
//     $('#sex').val(row.find('td:eq(3)').text());
//    $('#blood').val(row.find('td:eq(6)').text());
//    $('#weight').val(row.find('td:eq(5)').text());
//    $('#phone').val(row.find('td:eq(7)').text());
//    $('#age').val(row.find('td:eq(4)').text());
//    $('#address').val(row.find('td:eq(8)').text());
//    $('#uid').val(idx);

//  });