//   $(document).ready(function(){

//     $('.hoversize').hover(function() {
//     alert('sadsad');
//     // var name =  $(this).data('id');
//     // $(this).tooltip({title:''+name,placement:'left'});
//     var name = $(this).data('id');
//     $(this).tooltip({ title: '' + name, placement: 'top' });
// });

// var tshirt_array = new Array();
// var student_id_array = new Array();
// var index_array = 0;
// $('.size').on('change', function() {

//     var tshirt_size = $(this).val();
//      alert("tshirt_size:"+tshirt_size);
//     var student_id = $(this).data('id');
//     //var ss = ""+student_id+"";
//     //var student_id = (ss.trim());
//     var values = '.tdsize' + student_id + '';
//     //alert("tshirt_size:"+tshirt_size);
//     // alert(" student_id:"+student_id+"<");
//     // alert(" values:"+values+"<");
//     $(values).text("" + tshirt_size);
//     for (var i = 0; i < index_array + 1; i++) {
//         if (student_id_array[i] == student_id) {
//             tshirt_array[i] = null;
//             student_id_array[i] = null;
//         }
//         tshirt_array[index_array] = tshirt_size;
//         student_id_array[index_array] = student_id;
//     }
//     index_array++;

// });

//   });


//  $('.hoversize').hover(function(){
//     alert('sadsad');
//        // var name =  $(this).data('id');
//        // $(this).tooltip({title:''+name,placement:'left'});
//         var name = $(this).data('id');
//         $(this).tooltip({title:''+name,placement:'top'});
//     });

//   var tshirt_array = new Array();
//   var student_id_array = new Array();
//   var index_array = 0;
//    $('.size').on('change',function(){

//       var tshirt_size = $(this).val();
//        alert("tshirt_size:"+tshirt_size);
//       var student_id = $(this).data('id');
//       //var ss = ""+student_id+"";
//       //var student_id = (ss.trim());
//       var values = '.tdsize'+student_id+'';
//         //alert("tshirt_size:"+tshirt_size);
//        // alert(" student_id:"+student_id+"<");
//         // alert(" values:"+values+"<");
//        $(values).text(""+tshirt_size);
//       for(var i = 0; i < index_array + 1; i++)
//       {
//           if(student_id_array[i] == student_id )
//           {
//              tshirt_array[i] = null;
//             student_id_array[i] = null;
//            }
//              tshirt_array[index_array] = tshirt_size;
//             student_id_array[index_array] = student_id;
//       }
//        index_array++;

//   }); 
// });

var array_id = new Array();
var array_id_index = 0;


$(document).ready(function() {

    load_fee_cmb();
    load_tshirt_cmb();
    $(".view").tooltip({ title: 'Click to view more details', placement: 'top' });
    $(".select1").tooltip({ title: 'Choose Contribution Fee', placement: 'top' });
    $(".select2").tooltip({ title: 'Choose T-Shirt Fee', placement: 'top' });
    $(".btnremove_fee").tooltip({ title: 'Remove students for this Fee', placement: 'top' });
    $(".xclose").tooltip({ title: 'close', placement: 'top' });
    // bootstrapValidate('#description','required:Please fill out this field')



    var feetable = $('#fees_table').DataTable({
        'ordering': false,
        "processing": false,
        "serveSide": true,
        "async": true,
        ajax: {
            type: "POST",
            url: "action/fee.php",
            data: {
                "all_fee": 'success'
            }
            //  error: function (){
            //      alert('Something Error for Getting Data From Student(s)! Please Again Later.')
            //  }
        },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });
    //    setInterval( function () {
    //     feetable.ajax.reload();
    // }, 500 );
    $('#fees_table').DataTable().ajax.reload();
});


var tshirt_array = new Array();
var student_id_array = new Array();
var index_array = 0;


//  $('.size').on('change',function(){

//    // var fee_id = $(this).val();

//     alert("getttttt");

//     $('.size > option:selected').each(function(){
//       // var geteventidtshirt = $(this).val();
// //        var tshirt_size = $(this).val();
// //        // alert("tshirt_size:"+tshirt_size);
// //        var student_id = $(this).data('id');
// //        //var ss = ""+student_id+"";
// //        //var student_id = (ss.trim());
// //        var values = '.tdsize'+student_id+'';
// //          alert("tshirt_size:"+tshirt_size);
// //          alert(" student_id:"+student_id+"<");
// //           alert(" values:"+values+"<");


// alert(" geteventidtshirt");

//      });


//     });




$('.size').on('change', function() {



    // errornotify(4,'Warning <br>Please Choose a tshirt menu first!');
    $('.select2').focus();
    // var tshirt_size = $(this).val();
    // // alert("tshirt_size:"+tshirt_size);
    // var student_id = $(this).data('id');
    // //var ss = ""+student_id+"";
    // //var student_id = (ss.trim());
    // var values = '.tdsize'+student_id+'';
    //   alert("tshirt_size:"+tshirt_size);
    //   alert(" student_id:"+student_id+"<");
    //    alert(" values:"+values+"<");
    //  $(values).text(""+tshirt_size);
    // for(var i = 0; i < index_array + 1; i++)
    // {
    //     if(student_id_array[i] == student_id )
    //     {
    //        tshirt_array[i] = null;
    //       student_id_array[i] = null;
    //      }
    //        tshirt_array[index_array] = tshirt_size;
    //       student_id_array[index_array] = student_id;
    // }
    //  index_array++;

});






$(document).on('click', '.modaladdtshirt', function(e) {
    e.preventDefault();
    $('.feeheader').text('Add T-Shirt Fee');
    $('#addnew').modal('show');
    $('.gettype').val('1');


});

$(document).on('click', '.xclose', function(e) {
    e.preventDefault();
    $(".search-box").css("display", "none");

});

$(document).on('click', '.modaladdnew', function(e) {
    e.preventDefault();

    $('.feeheader').text('Add Contribution Fee');
    $('#addnew').modal('show');
    $('.gettype').val('0');

});


$(document).on('click', '.ckhbox', function() {
    //  alert('not undo');   
    var row = $(this).closest('tr');
    var getid = $(this).data('id');

    if ($(this).prop("checked") == true) {
        // alert('checked');
        array_id[array_id_index] = getid;
        array_id_index++;
    } else if ($(this).prop("checked") == false) {
        //  alert('not checked');
        for (var i = 0; i < array_id.length; i++) {
            if (array_id[i] == getid) {
                array_id[i] = null;
            }
        }
    }

});


$(document).on('click', '.nckhbox', function() {
    //  alert('undo');
    var row = $(this).closest('tr');
    var getid = $(this).data('id');

    if ($(this).prop("checked") == true) {
        // alert('checked');
        array_id[array_id_index] = getid;
        array_id_index++;
    } else if ($(this).prop("checked") == false) {

        for (var i = 0; i < array_id.length; i++) {
            if (array_id[i] == getid) {
                array_id[i] = null;
            }
        }
    }

});


// $('input[type=checkbox]').click(function(){
//          var getid = $(this).data('id');
//           var row = $(this).closest('tr');    
//           if($(this).prop("checked") == true)
//           {
//             alert('checked');
//             array_id[array_id_index] = getid;
//             array_id_index++;
//           }
//           else
//           {
//              alert('not checked');
//             for(var i = 0;i< array_id.length; i++)
//             {
//               if(array_id[i] == getid){
//                 array_id[i] = null;
//               }
//             }
//           }

// });













$(document).ready(function() {

    var concat_studentid = "";
    var found = false;
    var fee_eventid = "";
    var amount = $('.select1').val();

    $(document).on('click', '.btnremove_fee', function(e) {
        e.preventDefault();

        fee_eventid = $('.setfeeid').val();


        for (var i = 0; i < array_id.length; i++) {
            if (array_id[i] != null) {
                //alert(""+array_id[i]);
                concat_studentid += array_id[i] + ',';
                found = true;
            }
        }

        if (!found) {
            if (fee_eventid != '') {
                errornotify(4, ' Please select students first!');
            } else {
                $('.select1').focus();
            }
        } else if (fee_eventid == "") {
            // errornotify(4,' Warning <br><br> Please select a fee first!');
            $('.select1').focus();
            array_id = [];
        } else {

            //alert(''+concat_studentid);
            // alert(' amount:'+amount);


            $('#confirm_fee_student_modal').modal('show');




        }


    });




    $('.confirm_fee_student_btn').on('click', function() {

        amount = $('.select1').val();

        //alert(" concat_studentid:"+concat_studentid);
        // alert(" amount:"+amount);

        $('#confirm_fee_student_modal').modal('hide');
        fee_eventid = $('.setfeeid').val();

        $.ajax({
            url: "action/fee.php",
            method: "POST",
            data: { fee_eventid: fee_eventid, concat_studentid: concat_studentid, amount: amount },
            beforeSend: function() {
                 $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {

                //   $('#loading_modal').modal('hide');
                // $('.tbodydata').html(data);
                // $('#form_addfee')[0].reset();  

                // $('.addeventmodal').modal('hide');

                //  window.location.href = "fee.php";

                //  showNotification('top','right');

                $("#search_fee").val("");





                // var geteventid = $(this).data('id');

                $.ajax({
                    url: "action/fee.php",
                    method: "POST",
                    data: { geteventid: fee_eventid, amount: amount },
                    beforeSend: function() {
                        // $('.tdamountloading').html('<img width="30" src="../images/loading2.gif">');  
                        $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                    },
                    success: function(data) {


                        $('.fee_table').html(data);
                        //  $('.totalcostfee').text(""+data.costall);


                        //  alert('success')
                        // data =  $.parseJSON(data);
                        // console.log(''+data.html);
                        //  $('.fee_table').html(data);
                        //$('.fee_table').html(data.html);

                        var costall = $('.totalfee').val();

                        //alert('cos:'+costall);
                        // const formatcurrency = amount => {
                        //    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g,"$&,");
                        //  } 
                        // $('.totalcostfee').text(""+formatcurrency(costall));
                        // alert('asa'+costall.formatMoney(2,".",","));
                        $('.totalcostfee').text("" + costall);


                        array_id = [];
                        concat_studentid = "";
                        successnotify(2, ' Success :Successfully Removed Students');
                        $('#loading_modal').modal('hide');



                        // }
                        // $('#form_addfee')[0].reset();  

                        // $('.addeventmodal').modal('hide');

                        // window.location.href = "fee.php";

                        //  showNotification('top','right');

                    }
                });





                // $.ajax({  
                //   url:"action/fee.php",  
                //   method:"POST",  
                //   data:{geteventid:geteventid,amount:amount}, 
                //   beforeSend:function(){  
                //     $('.tdamountloading').html('<img width="30" src="../images/loading2.gif">');  
                //     $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                //   },   
                //     success:function(data){  
                //      // data =  $.parseJSON(data);
                //      $('.fee_table').html(data);
                //       $('.totalcostfee').text(""+data.costall);
                //       array_id = [];
                //       concat_studentid = "";
                //       successnotify(2,' Success :Successfully Removed Students');
                //       $('#loading_modal').modal('hide');
                //         // $('#form_addfee')[0].reset();  

                //         // $('.addeventmodal').modal('hide');

                //           // window.location.href = "fee.php";

                //         //  showNotification('top','right');

                //     } 
                //   });









            }
        });



    });




}); // close for ready




$('.add_tshirt_size').on('click', function() {



     var getfeeidtshirt = $('.select2').val().trim();  
      var tshirtamount =  $('.set_amount_fe').val().trim();


    

    // var x = document.createElement('INPUT');
    // $('.txt_tshirt_size').setAttribute("type","text");

    // $('.txt_tshirt_size').style.display = 'inline';

    //   var x = document.getElementById('txt_tshirt_size');
    // //  x.setAttribute("type","text");
    //    x.type = "text";

    $(".search-box").css("display", "flex");



    var tshirt_size = $('.txt_tshirt_size').val().trim();
    var column_name = "tshirt_size";
    var tshirt = true;
    // alert(' tshirt_size:'+tshirt_size+" cname:"+column_name);
    if (tshirt_size != '') {
        $.ajax({
            url: "action/category1.php",
            method: "POST",
            data: { tshirt: tshirt, cname: column_name, cvalue: tshirt_size },
            beforeSend: function() {
                $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                //  $('.addeventmodal').val("Saving...");  
            },
            success: function(data) {
                $('#loading_modal').modal('hide');
                //  alert('success');
                $(".search-box").css("display", "none");


            if(getfeeidtshirt != '' &&  tshirtamount != ''){

                    $.ajax({
                        url: "action/load_fee_student.php",
                        method: "POST",
                        data: { getfeeidtshirt: getfeeidtshirt },
                        //  dataType: 'json',
                        beforeSend: function() {
                            // $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');
                          //  $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                        },
                        success: function(data) {

                            // alert(data);
                            //  data =  $.parseJSON(data);
                            //   console.log(data.html);

                            $('#tbodydata').html(data);

                            $.ajax({
                                url: "action/load_tshirt_stats.php",
                                method: "POST",
                                // dataType: 'json',
                                data: { geteventidtshirt: getfeeidtshirt, tshirtamount: tshirtamount },
                                beforeSend: function() {
                                    //  $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');
                                //  $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                                    //  $('.addeventmodal').val("Saving...");  
                                },
                                success: function(data) {
                                    //  alert('success');

                                    $('.footer').html(data);
                                   
                                }
                            });


                            // if(data.status == 'success')
                            //  {

                            //  $('.tbodydata').html(data.html);

                            //  }

                            // $('.tbodydata').html(data);
                            // $('#form_addfee')[0].reset();  

                            // $('.addeventmodal').modal('hide');

                            // window.location.href = "fee.php";

                            //  showNotification('top','right');


                        }
                    });
            }




               $('#loading_modal').modal('hide');
               // window.location.href = "fee.php";
                //           console.log(data);

                //   $('#tablemain').html(data);
                // // if(data == "success")
                //    showNotification('2',' &nbsp Successfully Added!<br><br>');



            }
        });
    } else {
        $('.txt_tshirt_size').focus();
        $(".txt_tshirt_size").tooltip({ title: 'Enter T-Shirt Size', placement: 'top' });

    }

});







$('.select1').on('change', function() {
    var id = $(this).val();
    // $('.tdamount').text(""+id);

    $('#select1 > option:selected').each(function() {
        var value = $(this).val();
        if (value != "0") {
            var geteventid = $(this).data('id');
            var getevent_description = $(this).text();
            var amount = $('.select1').val();
            $('.setfeeid').val("" + geteventid);
            $('.fee_description').text("" + getevent_description);
            $.ajax({
                url: "action/fee.php",
                method: "POST",
                data: { geteventid: geteventid, amount: amount },
                beforeSend: function() {
                    $('.tdamountloading').html('<img width="30" src="../images/loading2.gif">');
                    $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                },
                success: function(data) {

                    //  alert('success')
                    // data =  $.parseJSON(data);
                    // console.log(''+data.html);
                    $('.fee_table').html(data);
                    //$('.fee_table').html(data.html);

                    var costall = $('.totalfee').val();

                    //alert('cos:'+costall);
                    // const formatcurrency = amount => {
                    //    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g,"$&,");
                    //  } 
                    // $('.totalcostfee').text(""+formatcurrency(costall));
                    // alert('asa'+costall.formatMoney(2,".",","));
                    $('.totalcostfee').text("" + costall);


                    $('#loading_modal').modal('hide');



                    // }
                    // $('#form_addfee')[0].reset();  

                    // $('.addeventmodal').modal('hide');

                    // window.location.href = "fee.php";

                    //  showNotification('top','right');

                }
            });


        }




    });

});

$('.select2').on('change', function() {

    // var fee_id = $(this).val();

    $('.select2 > option:selected').each(function() {
        var getfeeidtshirt = $(this).val(); 
        // alert(" geteventidtshirt:"+geteventidtshirt);
        if (getfeeidtshirt != "0") {
            var tshirtamount = $(this).data('id');
            $('.set_amount_fe').val(""+tshirtamount);
            var getevent_description = $(this).text();
            $('.get_fee_id').val("" + getfeeidtshirt);
            $('.tshirt_fee_amount').val("" + tshirtamount);
            $('.tshirt_description').text("" + getevent_description);

            //alert(' 1111111111111111111111111:');
            // alert(' amount:'+geteventids);
            //  alert(' 3:'+getevent_description);
            // $('.tbodydata').removeClass();

            $.ajax({
                url: "action/load_fee_student.php",
                method: "POST",
                data: { getfeeidtshirt: getfeeidtshirt },
                //  dataType: 'json',
                beforeSend: function() {
                    // $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');
                    $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                },
                success: function(data) {

                    // alert(data);
                    //  data =  $.parseJSON(data);
                    //   console.log(data.html);

                    $('#tbodydata').html(data);

                    $.ajax({
                        url: "action/load_tshirt_stats.php",
                        method: "POST",
                        // dataType: 'json',
                        data: { geteventidtshirt: getfeeidtshirt, tshirtamount: tshirtamount },
                        beforeSend: function() {
                            //  $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');
                          //  $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                            //  $('.addeventmodal').val("Saving...");  
                        },
                        success: function(data) {
                            //  alert('success');

                            $('.footer').html(data);
                            $('#loading_modal').modal('hide');
                        }
                    });


                    // if(data.status == 'success')
                    //  {

                    //  $('.tbodydata').html(data.html);

                    //  }

                    // $('.tbodydata').html(data);
                    // $('#form_addfee')[0].reset();  

                    // $('.addeventmodal').modal('hide');

                    // window.location.href = "fee.php";

                    //  showNotification('top','right');


                }
            });














        }


    });



});





$("#search_fee").on("keyup", function() {

    var value = $(this).val().toLowerCase();

    $("table tr").each(function(index) {
        if (index != 0) {
            $row = $(this);
            var id = $row.find("td:eq(0)").text();
            var name = $row.find("td:eq(2)").text();
            var age = $row.find("td:eq(3)").text().toLowerCase();
            var sex = $row.find("td:eq(4)").text().toLowerCase();
            var user = $row.find("td:eq(5)").text().toLowerCase();
            if (id.indexOf(value) != 0 && name.indexOf(value) != 0 && age.indexOf(value) != 0 &&
                sex.indexOf(value) != 0 && user.indexOf(value) != 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        }
    });


});

$(".search_tshirt").on("keyup", function() {


    var value = $(this).val().toLowerCase();

    $("table tr").each(function(index) {
        if (index != 0) {
            $row = $(this);
            var get1 = $row.find("td:eq(0)").text();
            var get2 = $row.find("td:eq(1)").text();
            var get3 = $row.find("td:eq(2)").text().toLowerCase();
            var get4 = $row.find("td:eq(3)").text().toLowerCase();
            var get5 = $row.find("td:eq(4)").text().toLowerCase();
            var get6 = $row.find("td:eq(7)").text().toLowerCase();
            if (get1.indexOf(value) != 0 && get2.indexOf(value) != 0 && get3.indexOf(value) != 0 &&
                get4.indexOf(value) != 0 && get5.indexOf(value) != 0 && get6.indexOf(value) != 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        }
    });



});





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





$(document).on('click', '.save_change', function(e) {
    e.preventDefault();
    var fee_id = $('.get_fee_id').val();
    if (fee_id > 0) {
        var tshirt_amount = $('.tshirt_fee_amount').val();
        var concat_student_id = "";
        var concat_tshirt_size = ""; // alert('id:'+fee_id);

        for (var i = 0; i < tshirt_array.length; i++) {
            if (tshirt_array[i] != null && tshirt_array[i] != "") {


                ///alert(' fee_id:'+fee_id);

                concat_tshirt_size += tshirt_array[i] + ",";
                concat_student_id += student_id_array[i] + ",";

                //  alert(""+concat_tshirt_size);
                //  alert(""+concat_student_id);

            }

        }

        if (concat_tshirt_size != '' && concat_student_id != '' && fee_id != '') {

            //alert('asdsa')
            //  console.log(" tshirt_size:"+concat_tshirt_size);
            //    console.log(" student_id:"+concat_student_id);
            //    console.log(" fee_id:"+fee_id);

            $.ajax({
                url: "action/fee.php",
                method: "POST",
                data: { fee_id: fee_id, student_id: concat_student_id, tshirt_size: concat_tshirt_size, tshirt_amount: tshirt_amount },
                beforeSend: function() {
                    $('.save_changelabel').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> saving changes');
                     $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                },
                success: function(data) {


                    $.ajax({
                        url: "action/load_fee_student.php",
                        method: "POST",
                        data: { getfeeidtshirt: fee_id },
                        beforeSend: function() {
                            $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');
                           // $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                        },
                        success: function(data) {


                            // data =  $.parseJSON(data);


                            //  if(data.status == 'success')
                            //  {
                            $('#loading_modal').modal('hide');
                            $('#tbodydata').html(data);

                            //   }
                            // $('#form_addfee')[0].reset();  

                            // $('.addeventmodal').modal('hide');

                            // window.location.hdddddddref = "fee.php";

                            //  showNotification('top','right');

                        }
                    });




                    $.ajax({
                        url: "action/load_tshirt_stats.php",
                        method: "POST",
                        data: { geteventidtshirt: fee_id, tshirtamount: tshirt_amount },
                        beforeSend: function() {
                            $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                        },
                        success: function(data) {
                            $('#loading_modal').modal('hide');
                            $('.footer').html(data);
                        }
                    });


                    // $('#form_addfee')[0].reset();  

                    // $('.addeventmodal').modal('hide');

                    // window.location.href = "fee.php?id="+fee_id+"";

                    //  showNotification('top','right');
                    // $('.save_changelabel').text(" save change"); 




                    tshirt_array = [];
                    student_id_array = [];
                    $('.search_tshirt').val("");

                }
            });

            $('.save_changelabel').html('<i class="fa fa-save"></i> save changes');




            // $.ajax({  
            //               url:"action/tshirt_size.php",  
            //                 method:"POST",  
            //               data:{fee_id:fee_id,student_id:concat_student_id,tshirt_size:concat_tshirt_size,tshirt_amount:tshirt_amount}, 
            //                 beforeSend:function(){  
            //                    //  $('.addeventmodal').val("Saving...");  
            //                 },  
            //                 success:function(data){  

            //                     // $('#form_addfee')[0].reset();  

            //                     // $('.addeventmodal').modal('hide');

            //                      //  window.location.href = "fee.php?id="+fee_id+"";

            //                     //  showNotification('top','right');
            //                        $.ajax({  
            //                         url:"action/load_fee_student.php",  
            //                           method:"POST",  
            //                           data:{geteventidtshirt:fee_id}, 
            //                           beforeSend:function(){  
            //                              //  $('.addeventmodal').val("Saving...");  
            //                           },  
            //                           success:function(data){  
            //                            $('.tbodydata').html(data);
            //                               // $('#form_addfee')[0].reset();  

            //                               // $('.addeventmodal').modal('hide');

            //                                 // window.location.href = "fee.php";

            //                               //  showNotification('top','right');

            //                           } 
            //                         });

            //                 }  
            //               });

            //  alert(''+concat_student_id+":"+concat_tshirt_size);
            //alert('finish');
            // window.location.href = "fee.php";

            // alert('Successfully all');














        } else {
            errornotify('4', '&nbsp Nothing To Save Changes.');
        }








    } else {
        //errornotify(4,'Warning <br>Please Choose a tshirt menu first!');
        $('.select2').focus();
    }

});




$(document).on('click', '.btn_confirm_del_fee', function(e) {
    e.preventDefault();
    var description = $('.del_description').val();
    var id = $('.deleteid').val();
    // alert(' id:'+id);
    $.ajax({
        url: "action/fee.php",
        method: "POST",
        data: { fee_deleteid: id },
        beforeSend: function() {
            $('.btn_confirm_del_fee').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Deleting...');
        },
        success: function(data) {
            if (data == 1) {
                load_fee_cmb();
                load_tshirt_cmb();
                $('.btn_confirm_del_fee').html('<span class = "glyphicon glyphicon-trash"></span> Yes ');
                $('#confirm_del_fee_modal').modal('hide');
                $('#fees_table').DataTable().ajax.reload();
                //  setInterval( function () {
                //         feetable.ajax.reload();
                //     }, 500 );
                addloghistory("Deleting", "Fee", description);
                //  window.location.href = "fee.php";
            } else {
                alert('ERROR: DFee:ER')
            }

        }
    });
});


$(function() {
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        $('#edit_fee_modal').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.del', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
        $('#confirm_del_fee_modal').modal('show');
        $('.deleteid').val(id);

    });
    //   $(document).on('click', '.view', function(e){
    //     e.preventDefault();


    //    // $('.ac').removeClass('active');
    //    //  $('.ac2').addClass('active');
    //    //  $('#fee').toggleClass('active');
    //     // $('#fee').show();
    //     // $('#fee').tab('show');


    //     //$('#edit').modal('show');
    //     var id = $(this).data('id');
    //     getRowview(id);
    //     // alert('');
    //   });

});

function getRow(id) {
    $.ajax({
        type: 'POST',
        url: 'action/fee.php',
        data: { get_fee_edit_id: id },
        dataType: 'json',
        success: function(response) {
            $('.feeid').val(response.fe_id);
            $('#edit_description').val(response.Description);
            $('#edit_amount').val(response.amount);
            $('.del_description').val(response.Description);
            $('.confirm_del_fee_modal_description').text("" + response.Description);


        }
    });
}
// function getRowview(id){
//   $.ajax({
//     type: 'POST',
//     url: 'action/fee.php.php',
//     data: {get_fee_edit_id:id},
//     dataType: 'json',
//     success: function(response){
//       $('.feeid').val(response.fe_id);
//       $('#edit_description').val(response.Description);
//       $('#edit_amount').val(response.amount);

//       if(response.fe_status == 0){
//         $('.ac').removeClass();
//         $('.ac2').addClass('active');
//         $('#fee').toggleClass('active');
//         $('.select1').focus();
//         $(".select1").tooltip({title:'Choose Contribution Fee',placement:'top'});
//       }
//       if(response.fe_status == 1){
//         $('.ac').removeClass();
//         $('.ac3').addClass('active');
//         $('#tshirt_fee').toggleClass('active');
//         $('.select2').focus();
//         $(".select2").tooltip({title:'Choose Tshirt Fee',placement:'top'});
//       }

//     }
//   });
// }






function load_fee_cmb() {
    $.ajax({
        type: 'POST',
        url: 'action/fee.php',
        dataType: 'json',
        data: { load_select_fee: "load" },
        success: function(response) {

            console.log(response);
            $('#select1').html(response);
        }
    });

}

function load_tshirt_cmb() {
    $.ajax({
        type: 'POST',
        url: 'action/fee.php',
        dataType: 'json',
        data: { load_select_tshirt: "load" },
        success: function(response) {

            console.log(response);
            $('#tshirt').html(response);
        }
    });

}

function addloghistory(action, action_name, description) {
    $.ajax({
        type: 'POST',
        url: 'action/log_history.php',
        data: { action: action, action_name: action_name, description: description },
        success: function(response) {
            // window.location.href = "events.php";
        }
    });

}


$("#addfee").click(function() {

    //  var fee_status = $("input[type='radio'][name='option']:checked").val();

    var gettype = $('.gettype').val();
    var fee_id = $('.get_fee_id').val();
    var description = $('#description').val();

    if ($('#description').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Description is Required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('#amount').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Amount is Required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else {

        //   var gt = $('.gettype').val();
        // alert('saved events :'+gt);



        // alert("gt:"+gettype);

        $.ajax({
            url: "action/fee.php",
            method: "POST",
            data: $('#form_addfee').serialize(),
            beforeSend: function() {
                $('#addfee').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Saving..');
            },
            success: function(data) {


                load_fee_cmb();
                load_tshirt_cmb();
                $('#form_addfee')[0].reset();
                $('#addfee').html('<i class="fa fa-save"></i> Save Fee');
                $('#addnew').modal('hide');
                $('#fees_table').DataTable().ajax.reload();
                //  setInterval( function () {
                //         feetable.ajax.reload();
                //     }, 500 );
                successnotify(2, " Fee Successfully Added");
                //  if(data == 1){
                //    alert('success');
                //  }
                //  else{
                //    alert('ERROR: AFEror');
                //  }
                // $('#form_addfee')[0].reset();  
                // $('.addeventmodal').modal('hide');
                //   addloghistory("Adding","Fee",description);
                //   window.location.href = "fee.php";
                // $.ajax({
                //           type: 'POST',
                //           url: 'action/log_history.php',
                //           data: {action:"Adding",action_name:"Fee",description:description},
                //           success: function(response){
                //               window.location.href = "fee.php";
                //           }
                //         });
            }
        });
    }


});

// $("#btnaddtshirt").click(function(){
//      //  var fee_status = $("input[type='radio'][name='option']:checked").val();



//          if($('#tshirtdescription').val() == "")  
//            {  
//                 $(".errormsg").css("color"," red");
//                 $(".errormsg").text("Tshirt Description is required!");

//             setTimeout(function(){
//                $(".errormsg").css("color"," white");
//             } , 2000);   
//            }  

//         else  if($('#tshirtamount').val() == "")  
//            {  
//                 $(".errormsg").css("color"," red");
//                 $(".errormsg").text("Tshirt Amount is required!");

//             setTimeout(function(){
//                $(".errormsg").css("color"," white");
//             } , 2000);   
//            }
//            else{

//             var gt = $('.gettype').val();
//            // alert('saved events :'+gt);



//            alert("gt"+gt);

//                    // $.ajax({  
//                    //        url:"action/add_fee.php",  
//                    //        method:"POST",  
//                    //        data:$('#form_addfee_tshirt').serialize(), 
//                    //        beforeSend:function(){  
//                    //           //  $('.addeventmodal').val("Saving...");  
//                    //        },  
//                    //        success:function(data){  

//                    //             $('#form_addfee_tshirt')[0].reset();  
//                    //            // $('.addeventmodal').modal('hide');

//                    //               window.location.href = "fee.php";
//                    //        }  
//                    //      });
//            }  


//  }); 





$("#editfee").click(function() {


    var id = $('.feeid').val();
    var description = $('#edit_description').val();
    var amount = $('#edit_amount').val();
    if ($('#edit_description').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Description is Required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else if ($('#edit_amount').val() == "") {
        $(".errormsg").css("color", " red");
        $(".errormsg").text("Amount is Required!");

        setTimeout(function() {
            $(".errormsg").css("color", " white");
        }, 2000);
    } else {
        $.ajax({
            url: "action/fee.php",
            method: "POST",
            data: { edit_fee_id: id, description: description, amount: amount },
            beforeSend: function() {
                //  $('.addeventmodal').val("Saving...");  
                $('#editfee').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Updating..');
            },
            success: function(data) {

                load_fee_cmb();
                $('#form_editfee')[0].reset();
                $('#editfee').html('<i class="fa fa-check-square-o"></i> Save Changes');
                $('#edit_fee_modal').modal('hide');
                successnotify(2, " Fee Successfully Updated");
                $('#fees_table').DataTable().ajax.reload();
                //  setInterval( function () {
                //         feetable.ajax.reload();
                //     }, 500 );
                addloghistory("Updated", "Fee", description);

                //  window.location.href = "fee.php";

                // $.ajax({
                //           type: 'POST',
                //           url: 'action/log_history.php',
                //           data: {action:"Updated",action_name:"Fee",description:description},
                //           success: function(response){
                //               window.location.href = "fee.php";
                //           }
                //         });

                // $('.addeventmodal').modal('hide');

                // window.location.href = "fee.php";

                //   showNotification('top','right');

            }
        });

    }


});
// function showNotification(from, align){
//     color = Math.floor((Math.random() * 4) + 1);

//     $.notify({
//         icon: "fa fa-plus",
//         message: "Fee updated Successfully!"

//     },{
//         type: type[1],
//         timer: 500,
//         placement: {
//             from: from,
//             align: align
//         }
//     });
// }


//     $('.hoversize').hover(function() {
//         //alert('sadsad');
//         // var name =  $(this).data('id');
//         // $(this).tooltip({title:''+name,placement:'left'});
//         var name = $(this).data('id');
//         $(this).tooltip({ title: '' + name, placement: 'top' });
//     });

// var tshirt_array = new Array();
// var student_id_array = new Array();
// var index_array = 0;
// $('.size').on('change', function() {

//     var tshirt_size = $(this).val();
//     // alert("tshirt_size:"+tshirt_size);
//     var student_id = $(this).data('id');
//     //var ss = ""+student_id+"";
//     //var student_id = (ss.trim());
//     var values = '.tdsize' + student_id + '';
//     //alert("tshirt_size:"+tshirt_size);
//     // alert(" student_id:"+student_id+"<");
//     // alert(" values:"+values+"<");
//     $(values).text("" + tshirt_size);
//     for (var i = 0; i < index_array + 1; i++) {
//         if (student_id_array[i] == student_id) {
//             tshirt_array[i] = null;
//             student_id_array[i] = null;
//         }
//         tshirt_array[index_array] = tshirt_size;
//         student_id_array[index_array] = student_id;
//     }
//     index_array++;

// });