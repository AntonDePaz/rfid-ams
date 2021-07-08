<?php
  include 'includes/session.php';
  include 'model/event.php';
  include 'model/attendance.php';
  include 'model/category.php';
  //session_start();
// if(!isset($_SESSION['admin_id']))
//  {
//   header('location: index.php');
//  }
//  else{
//    $attendance = new attendance();
//    $event = new event();
//    $category = new category();
//  }
 ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">

  #rfid-status-on{
    display : none;
  }
  .txtrfid{
    width: 200px;
    border: 1px solid #33bbff;
     border-radius: 5px 0 0 5px;
    border-right: none;
    padding: 5px;
    height: 30px;
    outline: none;
    color: #9bdfaf;
  }
  .txtrfid:focus{
    color: #000;
    box-shadow: 0 0 5px #33bbff;
  }
  .okay{
    width: 40px;
    height: 30px;
    border:1px solid #33bbff;
    background: #0099e6;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
  }
  .icon{
    position: absolute;
    align-items: center;
    margin-left: -10px;
  }
  .search{
    width: 200px;
    border: 1px solid #33bbff;
     border-radius: 5px 0 0 5px;
    padding: 5px;
    height: 25px;
    color: #000;
    margin-right: 35px;
  }
  .eg1{
   font-size: 10px;
    color: red;
     font-style: italic;
     position: absolute;
      margin-top: 2px;
  }
  
  .blink_status{
    animation:blinker 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: cyan;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}
.blinking_status {
    animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
}

@keyframes blinker {  
  from { opacity: 1; }
  to { opacity: 0; }
}
</style>
<body>
<div>

  <?php// include 'includes/navbar.php'; ?>
  <?php// include 'includes/menubar.php'; ?>

  <?php   //$eventid = $_GET['id'];
          
         $eventid = $_SESSION['event_id'];
       
        // if($eventid == '')
        // {header('location: index.php');}
        $row = $event->show_event($eventid);
        //$sql = "SELECT * FROM fee_event where fe_id = '$eventid'";
        //$query = $conn->query($sql);
        //$row = $query->fetch_assoc();

        $description = $row['Description'];
       
        $lastacivate = 0;
        $lasttime = "";
        $row = $attendance->attendance_status_active($eventid);
       // $sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eventid' order by timeactivate asc ";
        // $query3 = $conn->query($sql3);
        // while($row3 = $query3->fetch_assoc())
        // {
          $lastacivate = $row['as_id'];
          $lasttime = $row['time'];
        // }
         

          $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');

          $lasttime2 = intval($lastacivate);

          // for($i = 0;$i < count($content); $i++)
          // {
          //   echo " i:".$i." count:".$count_trace_time_status;
          //   if($i == $count_trace_time_status)
          //   {
          //     echo " ".$content[$i];
          //     break;
          //   }
          // }



  ?>



  <!-- Content Wrapper. Contains page content -->
  <div >
    <!-- Content Header (Page header) -->
    <section class="content-header" style="top: 0;">
      <div class="row">
        <!-- <div class="row" style="margin: 0 10px;"><h6 class="pull-right"><?php// echo "".date('D, F d, Y'); ?></h6>
        </div> -->
      <div class="row" style=" margin: 0 10px;">
        <h2 class="pull-left">
         <?php  echo $description; ?>
        </h2>
        <div class="row pull-right" style=" margin-right: 10px;">
          <p class="pull-right"><?php echo "".date('D, F d, Y'); ?></p>
        </div>
        <br>
         <div class="row pull-right" style=" margin-right: -150px;">
         <!-- <p class="pull-right" style="font-size: 25px; " id="time"></p> -->
         <p class="date_time" style="font-size: 25px; margin-right:30px; " id="time"><strong id="sec"></strong></p>
       </div>
      </div>

   


       
      <div class="row" style=" margin:0 10px;">
           <h4 class="tap_status pull-left text-info"> <?php echo $content[($lasttime2-1)] ?></h4>
          <h5 class="pull-right">
        RFID Based Students Attendance
         </h5><br>

        </div>
        <div class="row" style="margin:0 10px;">

            
   


          <input type="hidden" class="txteventid" value=" <?php echo $eventid;  ?> ">
            <h6 class="pull-left blinking_status" id="rfid_msg"> Tap Now Your ID for Check attendance.</h6>
         <a  style="margin-left: 20px;" class="btn btn-danger btn-xs pull-right winclose"><i class="fa fa-reply"></i> Back</a>
          <a  href="attendance_event.php" class="btn btn-info btn-xs pull-right"><i class="fa fa-refresh"></i> Refresh</a>
          <input type="text" id="search" class="pull-right search" placeholder="search..">
         
           <!-- <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text bg-warning"><i class="fa fa-reply"></i></div>
            </div>
         
         
            <input type="text" autocomplete="off" class="form-control" id="inlineFormInputGroup" placeholder='enter' name='kname'></div> -->
            <!-- <div class="form-check form-check-inline pull-right" >
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Attendence Not Check</label>
          </div>
          <div class="form-check form-check-inline pull-right" >
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Attendence Check</label>
          </div>
          <div class="form-check form-check-inline pull-right" >
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
            <label class="form-check-label" for="inlineRadio3">All</label>
          </div> -->


          </div>


    </div>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Events</li>
        <li class="active">Students List</li>
      </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <!-- <a class="btn btn-primary btn-sm btn-flat unfucos"> unfucos</a> -->

              <!-- <a href="#attend"  data-toggle="modal" class="btn btn-default btn-sm "><i class="fa fa-plus"></i> tap rfid</a>
              <a href="#actived" data-toggle="modal" class="btn btn-primary btn-sm pull-left"><i class="fa fa-plus"></i> attendance status</a>-->
              <!-- <a  class="btn btn-primary btn-sm  popup"><i class="fa fa-plus"></i> pop up</a>  -->
            
              <!-- <input type="text" class="pull-left txtrfid" placeholder="Enter ID-number"><a class="btn btn-primary btn-sm okay"><i class="fa fa-calendar-plus-o icon"></i></a>
              <h6 class="eg1">eg. 1710128-1</h6> -->
               <!-- <a class="btn btn-info btn-sm pull-right btnfilter"><i class="fa fa-refresh"></i></a> -->
              <!-- <a class="btn btn-success btn-sm pull-right" id="checkall">select all</a> -->
              <div class="col-md-2 pull-left" >
              
              <a  id="rfid-status-off"><i  style="color:skyblue; font-size:25px; cursor:pointer; " class="fa fa-toggle-off roff"></i> &nbsp; <span class="text-info" style="font-style:italic; font-size:12px; position:absolute; margin-top:5px; "> <span style="position: absolute;"><i class="fa fa-circle text-danger"></i>&nbsp; </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RFID Reader<i class="fa fa-circle-green"></i> </span></a>
              
              <a  id="rfid-status-on"><i style="color:skyblue; font-size:25px; cursor:pointer;" class="fa fa-toggle-on " ></i> &nbsp; <span class="text-info" style="font-style:italic;  font-size:12px; position:absolute; margin-top:5px;"><span style="position: absolute;" class="blink_status"><i class="fa fa-circle text-success"></i>&nbsp; </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RFID Reader</span></a>
           
            </div>

                        <div class="col-md-2 pull-right" >
                           <select class = "form-control year" id="cyear" name = "year" style="border-radius: 10px;">
                                  <option value="all">All Year</option>
                                  <?php

                                        $sec = $category->year();
                                      // $sql = "SELECT c_year FROM category where c_year <> '' order by c_year asc" ;
                                      // $query = $conn->query($sql);
                                      // while($row = $query->fetch_assoc()){
                                        foreach($sec as $row){
                                       echo "<option value=".$row['c_year'].">".strtoupper($row['c_year'])." Year</option>";
                                        } ?>
                                </select>
                        </div>
                        <div class="col-md-2 pull-right">
                           <select class = "form-control course" id="ccourse" name = "section"  style="border-radius: 10px">
                                  <option value="all">All Course</option>
                                  <option value="attended">All Attended</option>
                                  <option value="nattended">All Not Attended</option>
                                  <?php
                                      // $sql = "SELECT c_course FROM category where c_course <> '' order by c_course asc" ;
                                     //  $query = $conn->query($sql);
                                      // while($row = $query->fetch_assoc()){
                                        $cors = $category->course();
                                        foreach($cors as $row){
                                       echo "<option>".strtoupper($row['c_course'])."</option>";
                                        } ?>
                                </select>
                        </div>





            </div>
            <div class="box-body" style="overflow-y:auto; height:600px;">
              <table id="exampleattend" class="table table-bordered table-striped">
                <thead>
                  <th>#</th>
                  
                  <th>ID Number</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>Year</th>
                  <th>Section</th>
                  <th>Course</th>
                  <th>Major </th>
                  <th>Status </th>
                  <th width="10%"><p style="font-size: 10px;">Modify Attendance</p><a style="font-size: 15px; cursor: pointer;" class="btn btn-info btn-xs pull-right attendance"> <b> <small style="font-size:10px;" > Attendance</small> <i class='fa fa-calendar-check-o' style="color: green;"></i></b></a>
                    <input class="btn btn-success btn-sm pull-left" type="checkbox" id="checkall">
                  </th>
                </thead>
                <tbody class="datarow" >
                

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer>
    <div class="pull-right hidden-xs">
      <b>SSC Fines Management System</b>
      <p style="font-size: 12px; margin-top: -2px; ">&copy; <script>  document.write(new Date().getFullYear()); </script> Develop by <a href="#">ME</a></p>
    </div>
    <p style="font-size: 13px; font-style: italic; font-weight: 200;"><span>SY:<span style="color: blue;"> <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sy_range']; }else{ echo "___-___"; }?></span> 
    Semester:<span style="color: blue;"> <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sem_id']; }else{ echo "_";} ?></span></span></p>
</footer>


  <?php // include 'includes/footer.php'; ?>
  <?php   include 'includes/students_attendance_modal.php'; ?>
   <?php  // include 'includes/students_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<?php include 'includes/loading_modal.php'; ?>
</body>
</html>
<script type="text/javascript">
 var check_rfid_status;
  $(document).ready(function() {
    document.getElementById('rfid_msg').style.display = 'none';
    check_rfid_status = 0;
   // realtimeclock();
   //toggleFullScreen();  
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
  	//alert(' barcode:'+barcode);
    //blurall();
   // document.getElementById('search').disabled = true;
  
   if(check_rfid_status == 0){
    //document.getElementById('rfid_msg').style.display = 'none';
    errornotify('4',"  RFID Reader is TURN OFF! Please Turn it ON.");
    
   // rfid_msg_status
    $('.rfid_msg_status').hide();
   //  console.log('off')
     //alert('naka off')
     
    //  $(".roff").focus();  
    //  $(".roff").tooltip({title:'Turn On the rfid reader.',placement:'top'});
     $(".roff").focus();  
     $(".roff").tooltip({title:'Turn On the rfid reader.',placement:'top'});
    // alert('off')
    
   }
   if(check_rfid_status == 1){
    // console.log('on')
    //alert('naka on')
  
    //document.getElementById('rfid_msg').style.display = 'block';
   
   
   //$('.rfid_msg_status').fadeOut('slow');
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


  // $(document).ready(function(){


  //   // $('#checkall').click(function(){
  //   //  // alert('click');

  //   // });
  
  
  
  $(document).on('click', '.offrfid', function(){

    ('.active').removeClass('active');
$(this).addClass('active');
    //  $('#rfid_status').html('<i style="color:skyblue; font-size:20px;" class="fa fa-toggle-on onrfid"></i> Rfid Reader')

  });
  $(document).on('click', '.onrfid', function(){

//$('#rfid_status').html('<i style="color:skyblue; font-size:20px;" class="fa fa-toggle-on offrfid"></i> Rfid Reader')

});

  //  $(document).on('click', '.btnfilter', function(){

  //      var year = $('.year').val();
  //      var course = $('.course').val();
  //      var eventid = $('.txteventid').val();
  //      var trace = "";
  //     if(course != "" && year != "")
  //     { // alert(' naa duha:'+year+course);
  //         trace = '1';
  //     }
  //      else
  //      {
  //         if(course != "")
  //         {
  //           trace = '2';
  //         }
  //        else if (year != "")
  //         {
  //           trace = '3';
  //         }
  //         else
  //         {
  //             trace = '4';
  //         }
  //      }

  //               $.ajax({
  //                         url:"action/filter_student_attendance.php",
  //                         method:"POST",
  //                         data: {trace:trace,year:year,course:course,eventid:eventid},
  //                         cache: false,
  //                         beforeSend:function(){
  //                                   //  $('.addeventmodal').val("Saving...");
  //                         },
  //                         success:function(data){
  //                               data =  $.parseJSON(data);

  //                             //  console.log(data);

  //                                   if(data.status == 'success')
  //                                   {
  //                                        $('.datarow').html(data.html);
  //                                  }
  //                                  else
  //                                  {
  //                                   alert('error');
  //                                  }

  //                                }
  //                          });



  //               id_array = [];


  //  });


  // $(document).ready(function(){
  // realtimeclock();
  //   });


   // $(document).on('click', '#checkall', function(){


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


  //  });

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

                // successnotify('2',"Success <br> Attendance All Successfully!");
                   // data =  $.parseJSON(data);

                   // if(data.status == 'success')
                   //  {
                   //    // $('.tdamount1').text("12");


                   //    $('#confirm').modal('hide');
                   //     // $('#exampleattend').html(data.html);
                   //     $('.datarow').html(data.html);

                   //


                   //    //   showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");

                   //   }
                   //  else
                   //   {
                   //    alert('error');
                   //   }



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
                     $(".loader").html('<img src="../images/loading.gif">');
                   //  $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
                  },
                  success:function(data){

                   // alert('okayaaa');
                    $(".loader").html('');
                     $('#confirm').modal('hide');
                      loadstudent();
                    //  $('#loading_modal').modal('hide');
                      //  alert('success not all');
                  //$('#exampleattend').html(data);
                 // alert('1111');
                    // data =  $.parseJSON(data);

                    // if(data.status == 'success')
                    // {
                    //   // $('.tdamount1').text("12");


                    //     $('#confirm').modal('hide');
                    //    // $('#exampleattend').html(data.html);
                    //     $('.datarow').html(data.html);

                     //  successnotify('2',"Success <br> Attendance Successfully!");


                    //    // showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");

                    //  }
                    //  else
                    //  {
                    //     alert('error');
                    //  }



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

                  //$('#exampleattend').html(data);
                 // alert('1111');
                  //  data =  $.parseJSON(data);

                  // $('.datarow').html(data.html);
                  //  console.log(data.html);

                 //if(data != 0){
                   // alert('success')
                    $('.datarow').html(data);
                 // }

                    // if(data.status == 'success')
                    // {
                    //   // $('.tdamount1').text("12");

                    //  alert('success')
                    //   //  $('#attend').modal('hide');
                    //    // $('#exampleattend').html(data.html);
                    //      $('.datarow').html(data.html);

                    //    //  showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");

                    //  }
                    //  else
                    //  {
                    //   $('.datarow').html('<tr>No data</tr>');
                    //  }



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

                  //$('#exampleattend').html(data);
                 // alert('1111');
                  //  data =  $.parseJSON(data);

                  // $('.datarow').html(data.html);
                  //  console.log(data.html);

                 //if(data != 0){
                   // alert('success')
                    $('.datarow').html(data);
                 // }

                    // if(data.status == 'success')
                    // {
                    //   // $('.tdamount1').text("12");

                    //  alert('success')
                    //   //  $('#attend').modal('hide');
                    //    // $('#exampleattend').html(data.html);
                    //      $('.datarow').html(data.html);

                    //    //  showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");

                    //  }
                    //  else
                    //  {
                    //   $('.datarow').html('<tr>No data</tr>');
                    //  }



                     }
               });
    }


    

});
  

  // $(document).ready(function(){
  //
  //   $('.search').change(function(){
  //     var rfid =  $(this).val();
  //     getinfo();getbalance();
  //     $('.search').val('');
  //     //
  //   });

//   $('.txtrfid').change(function(){
// // $(document).on('click', '.okay', function(){

//   //var eventid = $('.eventid').val();
//   //var rfid = $('#taprfid').val();


//   var eventid = $('.txteventid').val();
//   var rfid = $('.txtrfid').val();
// //  var rfid = $(this).val();

//   if(rfid != "" && eventid != ''){
//   //alert(''+eventid);
//   //alert(''+rfid);

//             $.ajax({
//                   url:"action/attendance_student_tap.php",
//                   method:"POST",
//                   data: {rfid:rfid,eventid:eventid},
//                   cache: false,
//                   beforeSend:function(){
//                             //  $('.addeventmodal').val("Saving...");
//                   },
//                   success:function(data){

//                   //$('#exampleattend').html(data);
//                   //  alert('rfid'+rfid);
//                     data =  $.parseJSON(data);

//                     if(data.status == 'success')
//                     {
//                       // $('.tdamount1').text("12");

//                     //  alert(''+data.firstname.toUpperCase())
//                       //  $('#attend').modal('hide');
//                        // $('#exampleattend').html(data.html);
//                        console.log(data);
//                          $('.datarow').html(data.html);

//                          showNotification1(2,"  <b>  "+data.firstname.toUpperCase()+" "+data.lastname.toUpperCase()+" </b> <br> "+data.course.toUpperCase()+" <br> "+data.year+" - "+data.section.toUpperCase()+" "+data.major.toUpperCase()+" <br>");

//                      }
//                      else
//                      {
//                       alert('Something Wrong try again.');
//                      }



//                      }
//                });


// }




//  });


$(document).on('click', '.unfucos', function(){
    //window.close();
    alert('unfocus')
    blurall();

});
//   $(document).on('click', '.popup', function(){
//     showNotification1(2,"ANTONIO P. DEPAZ JR <br> BS INFORMATION TECHNOLOGY <br> 4-B NETWORKING <br>");

// });
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

                  //$('#exampleattend').html(data);
                 // alert('1111');
                  //  data =  $.parseJSON(data);

                  // $('.datarow').html(data.html);
                  //  console.log(data.html);

                    if(data.status == 'success')
                    {
                      // $('.tdamount1').text("12");

                     // alert('success')
                      //  $('#attend').modal('hide');
                       // $('#exampleattend').html(data.html);
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

// function realtimeclock() {

//  var rtclock = new Date(); 
//  //var rtclock = new Date().toLocaleString('en-US', { timeZone: 'Asia/Manila' });
 
//  var hours = rtclock.getHours();
//  var minutes = rtclock.getMinutes();
//  var seconds = rtclock.getSeconds();

//  var ampm = (hours < 12) ? "am" : "pm";

//  if(hours > 12)
//  {
//   hours -= 12;
//  }
//  else{
//    hours = 12;
//  }

//   hours = ('0' + hours).slice(-2);
//  minutes = ('0' + minutes).slice(-2);
//  seconds = ('0' + seconds).slice(-2);

//  document.getElementById('time').innerHTML = hours + " : " + minutes + " : " + seconds + "  " + ampm;
//  var t = setTimeout(realtimeclock,500);

// }



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







// function toggleFullScreen() {
//           var doc = window.document;
//           var docEl = doc.documentElement;

//           var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
//           var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

//           if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
//             requestFullScreen.call(docEl);
//           }
//           else {
//             cancelFullScreen.call(doc);
//           }
//         }



      });

</script>
