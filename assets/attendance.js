$('#confirm').css('top', $(window).outerHeight() / 2 - ($("modal-dialog").outerHeight()) / 2 + 'px');
 var check_rfid_status;
  $(document).ready(function() {
    document.getElementById('rfid_msg').style.display = 'none';
    check_rfid_status = 0;
   // realtimeclock();
   toggleFullScreen();  
    loadstudent();
    $('.txtrfid').focus();
  $(".okay").tooltip({title:'Click here to mark attendance by ID-NUMBER',placement:'top'});
  $(".search").tooltip({title:'Search Student',placement:'top'});
  $(".winclose").tooltip({title:'Close',placement:'top'});
  // $(".btnfilter").tooltip({title:'Click here to Filter Student',placement:'top'});
  $(".year").tooltip({title:'Filter By Year',placement:'top'});
  $(".course").tooltip({title:'Filter By Course',placement:'top'});
  $("#checkall").tooltip({title:'Mark/UnMark Attendance for all Student ',placement:'top'});
  $(".attendance").tooltip({title:'Submit',placement:'top'});
  $(".roff").tooltip({title:'Turn On the rfid reader.',placement:'top'});

  $(document).on('click', '#rfid-status-off', function(){
    check_rfid_status = 1;
    document.getElementById('rfid-status-off').style.display = 'none';
    document.getElementById('rfid-status-on').style.display = 'block';
    document.getElementById('rfid_msg').style.display = 'block';
  });
  $(document).on('click', '#rfid-status-on', function(){
    check_rfid_status = 0;
    document.getElementById('rfid-status-off').style.display = 'block';
    document.getElementById('rfid-status-on').style.display = 'none';
    document.getElementById('rfid_msg').style.display = 'none';
  });

var options = {}
options.onScan = function(barcode){
  
   if(check_rfid_status == 0){
    errornotify('4',"  RFID Reader is TURN OFF! Please Turn it ON.");
    $('.rfid_msg_status').hide();
     $(".roff").focus();  
     $(".roff").tooltip({title:'Turn On the rfid reader.',placement:'top'});
  
   }
   if(check_rfid_status == 1){
   $('.rfid_msg_status').show();
    var eventid = $('.txteventid').val();
    $.ajax({
                  url:"action/attendance.php",
                  method:"POST",
                  data: {wrfid_eventid:eventid,wrfid_rfid:barcode},
                  dataType: 'json',
                  cache: false,
                  beforeSend:function(){
                   // $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                   // $(".loader").html('<img src="../images/loading.gif">');
                  },
                  success:function(data){

                   // document.getElementById('search').disabled = false;
                 // $('#exampleattend').html(data);
                  //  alert('rfid'+rfid);
                    //data =  $.parseJSON(data);

                    if(data.status == 'success')
                    {
                      // $('.tdamount1').text("12");

                    //  alert(''+data.firstname.toUpperCase())
                      //  $('#attend').modal('hide');
                       // $('#exampleattend').html(data.html);
                      // console.log(data);
                       //  $('.datarow').html(data.html);
                        loadstudent();
                       
                         showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");
                        
                     }
                     else
                     {
                      errornotify('4',"  Students not found!");
                     }




                     }
               });
   }
  //getinfo(barcode);getbalance(barcode);
    //$('.search').val('');
  };
  try {
  onScan.attachTo(document, options);
  console.log("onScan Started!");
  blurall();  
} catch(e) {
  onScan.setOptions(document, options);
  console.log("onScansettings changed!");
}




  var id_array = new Array();
  var index_array = 0;
  var trace = false;

  $(document).on('click', '.offrfid', function(){

    ('.active').removeClass('active');
$(this).addClass('active');

  });
  $(document).on('click', '.onrfid', function(){
});

  


  


          $(':not(#checkall)').click(function(){
            if($(this).is(':checked'))
            {
              $(this).addClass('clicked');
            }
            else
            {
              $(this).removeClass('clicked');
            }
          });
          $('#checkall').click(function(){
            $(':not(.clicked)').prop('checked',$('#checkall').is(':checked'));

          });


  

   $(document).on('click', '#chk_getid', function(){


          var row = $(this).closest('tr');
          if($(this).prop("checked") == true)
          {
            var id = $(this).data('id');
             // alert('id:'+id);
            // trace = true;
              id_array[index_array] = id;
              index_array++;
          }
          else if($(this).prop("checked") == false)
          {
            var id = $(this).data('id');
            for(var i = 0;i < id_array.length; i++)
                 if(id_array[i] == id)
                  {
                    id_array[i] = null;
                  }
          }



   });

$(document).on('click', '.btn_attendance_confirm', function(){
       var eventid = $('.txteventid').val();
        var status = '';
        var concat_student_id = "";
       if($('#checkall').prop("checked") == true)
       {
          // alert('all');
           var concat_student = "all";
           $.ajax({
                  url:"action/attendance.php",
                  method:"POST",
                  data: {mast_eventid:eventid,mast_concat_student_id:concat_student},
                  cache: false,
                  beforeSend:function(){
                    //$(".loader").html('<img src="../images/loading.gif">');
                    $('#confirm').modal('hide');
                    $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                   
                  },
                  success:function(data){

                //   //$('#exampleattend').html(data);
                // // alert('1111');
                   loadstudent();
                  $('#checkall').prop("checked",false);
                  $('#confirm').modal('hide');
                   $(".loader").html('');
                   $('#loading_modal').modal('hide');

    

                     }
               });
       }
       else
       {
              var found_id = false;
            for(var i = 0;i < id_array.length; i++)
              {
                if(id_array[i] != null)
                {
                  found_id = true;
                  concat_student_id += id_array[i]+",";
                   // alert('id:'+concat_student_id);
                 }
              }
              if(!found_id)
              {
                 errornotify(4,"Select Data First!<br>");
              }
              else
              {
              // alert(" not all concat_student_id:"+concat_student_id);
               //alert(" eventid:"+eventid);
                $.ajax({
                  url:"action/attendance.php",
                  method:"POST",
                  data: {mast_eventid:eventid,mast_concat_student_id:concat_student_id},
                  //cache: false,
                  beforeSend:function(){
                     $(".loader").html('<img src="images/loading.gif">');
                   //  $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                  },
                  success:function(data){

                   // alert('okayaaa');
                    $(".loader").html('');
                     $('#confirm').modal('hide');
                      loadstudent();
                   
                     }
               });

              }

       }
  });
   $(document).on('click', '.attendance', function(){


        var found_id = false;
            for(var i = 0;i < id_array.length; i++)
              {
                if(id_array[i] != null)
                {
                  found_id = true;
                 }
              }
       if($('#checkall').prop("checked") == true)
       {
         
          $('#confirm').modal({ backdrop: 'static', keyboard: false },'show');
         
       }
       else if(found_id == true)
       {
         $('#confirm').modal({ backdrop: 'static', keyboard: false },'show');
         
       }
       else
        {
        
          errornotify('4',"Please Select Students First!");
        }










  });

  $('#ccourse').change(function(){

    var value = $(this).val();
   //alert('course'+value);
    var eventid = $('.txteventid').val();

    if(value == 'all'){
      loadstudent();
    }else{

    $.ajax({
                  url:"action/attendance.php",
                  method:"POST",
                  data: {filter_eventid:eventid,filter_course:value},
                  dataType: 'json',
                  cache: false,
                  beforeSend:function(){
                            //  $('.addeventmodal').val("Saving...");
                  },
                  success:function(data){

                    $('.datarow').html(data);

                     }
               });
    }

  });
  $('#cyear').change(function(){

   
    var value = $(this).val();
   //alert('course'+value);
    var eventid = $('.txteventid').val();

    if(value == 'all'){
      loadstudent();
    }else{

    $.ajax({
                  url:"action/attendance.php",
                  method:"POST",
                  data: {filtery_eventid:eventid,filter_year:value},
                  dataType: 'json',
                  cache: false,
                  beforeSend:function(){
                            //  $('.addeventmodal').val("Saving...");
                  },
                  success:function(data){

                    $('.datarow').html(data);

                     }
               });
    }


    

});
  


$(document).on('click', '.unfucos', function(){
    //window.close();
    alert('unfocus')
    blurall();

});

  $(document).on('click', '.winclose', function(){
    window.close();
    window.location.href = "eventsliststudent.php";

});


function showNotification1(colour,msg){
 // color = colour;
  color = 2;

  $.notify({
      icon: "ti-user",
      message: msg

    },{
        type: type[color],
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
}

function blurall(){
  var tmp = document.createElement('input');
  document.body.appendChild(tmp);
  tmp.focus();
  document.body.removeChild(tmp);
}

function loadstudent(){

     var eventid = $('.txteventid').val();

    $.ajax({
                  url:"action/attendance.php",
                  method:"POST",
                  data: {loadst_eventid:eventid},
                  dataType: 'json',
                  cache: false,
                  beforeSend:function(){
                            //  $('.addeventmodal').val("Saving...");
                  },
                  success:function(data){

          

                    if(data.status == 'success')
                    {
                    
                         $('.datarow').html(data.html);

                       //  showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");

                     }
                     else
                     {
                      alert('error');
                     }



                     }
               });

}


         $(".search").on("keyup", function(){

                var value = $(this).val().toLowerCase();

                 $("tr").each(function(index){
                    if(index != 0)
                    {
                      $row = $(this);
                      var id1 = $row.find("td:eq(1)").text();
                       var id2 = $row.find("td:eq(2)").text().toLowerCase();
                       var id3 = $row.find("td:eq(3)").text().toLowerCase();
                       var id4 = $row.find("td:eq(4)").text().toLowerCase();
                      var id5 = $row.find("td:eq(5)").text();
                      var id6 = $row.find("td:eq(6)").text().toLowerCase();
                      var id7 = $row.find("td:eq(7)").text().toLowerCase();
                      var id8 = $row.find("td:eq(8)").text().toLowerCase();
                    
                      if(id1.indexOf(value) != 0 && id2.indexOf(value) != 0 && id3.indexOf(value) != 0 && id4.indexOf(value) != 0 && id5.indexOf(value) != 0 && id5.indexOf(value) != 0 && id7.indexOf(value) != 0  && id8.indexOf(value) != 0  ){
                        $(this).hide();
                      }
                     else{
                        $(this).show();
                      }
                    }
                 });


            });



            $(document).ready(function() {
   //EST
setInterval( function() {
var estTime = new Date();
 var currentDateTimeCentralTimeZone = new Date(estTime.toLocaleString('en-US', { timeZone: 'Asia/Manila' }));
var seconds = currentDateTimeCentralTimeZone.getSeconds();
var minutes = currentDateTimeCentralTimeZone.getMinutes();
var hours =  currentDateTimeCentralTimeZone.getHours();//new Date().getHours();
 var am_pm = currentDateTimeCentralTimeZone.getHours() >= 12 ? "pm" : "am";

if (hours < 10){
     hours = "0" + hours;
}

if (minutes < 10){
     minutes = "0" + minutes;
}
if (seconds < 10){
     seconds = "0" + seconds;
}
    var mid='PM';
    if(hours==0){ //At 00 hours we need to show 12 am
    hours=12; 
   
    }
    else if(hours>12)
    {
    hours=hours%12;
   
    mid='AM';
    }
   
    var x3 = hours+':'+minutes+':'+seconds +' '+am_pm
// Add a leading zero to seconds value
$("#sec").html(x3);
},1000);


});







function toggleFullScreen() {
          var doc = window.document;
          var docEl = doc.documentElement;

          var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
          var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

          if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
            requestFullScreen.call(docEl);
          }
          else {
            cancelFullScreen.call(doc);
          }
        }



      });
