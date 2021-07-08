
<!-- <script src="../dist/jquery/js/jquery-3.5.1.js"></script> -->

<script src="../dist/jquery/jquery.js"></script>


<script src="../dist/jquery/jquery.min.js"></script>
<script src="../dist/jquery/js/jquery-ui.min.js"></script>
<script src="../dist/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../dist/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="../dist/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>



<!-- <script src="../dist/jquery/js/jquery.dataTables.min.js"></script> -->
 <!-- <script src="../dist/jquery/js/dataTables.bootstrap.min.js"></script> -->

 <script src="../dist/jquery/print/print.min.js"></script>
 <script src="../dist/js/bootstrap-validate.js"></script>

 
<!--<script src="../dist/jquery/js/datatables.min.js"></script> -->



<!-- <script src="../dist/jquery/js/pdfmake.min.js"></script>
<script src="../dist/jquery/js/dataTables.buttons.min.js"></script> -->

<!-- <script src="../dist/jquery/js/jszip.min.js"></script> -->

<!-- <script src="../dist/jquery/js/vfs_fonts.js"></script>
<script src="../dist/jquery/js/buttons.html5.min.js"></script>
<script src="../dist/jquery/js/buttons.print.min.js"></script> -->



<!-- jQuery 3 -->
<!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- iCheck 1.0.1 -->

<!-- Moment JS -->
<!-- <script src="../bower_components/moment/moment.js"></script> -->
<!-- DataTables -->
<!-- <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<!-- ChartJS -->
<!-- <script src="../bower_components/chart.js/Chart.js"></script> -->
<!-- ChartJS Horizontal Bar -->
<!-- <script src="../bower_components/chart.js/Chart.HorizontalBar.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<!-- <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- bootstrap time picker -->
<!-- <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script> -->
<!-- Slimscroll -->
<!-- <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="../bower_components/fastclick/lib/fastclick.js"></script> -->
<!-- AdminLTE App -->
<script src="../dist/js/onscan.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../dist/popup/js/bootstrap-notify.js"></script>
    
    <!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
    <script src="../dist/popup/js/demo.js"></script>

    <script src="../dist/croppie/croppie.js"></script>

<!-- Active Script -->
<script>
   $(document).ready(function(){
    $('.bold').hover(function(){
       var name =  $(this).data('id');
       $(this).tooltip({title:''+name,placement:'left'});
    });
    
  });
$(function(){
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
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      'ordering'    : false
     })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true
    })
  })
</script>
<!-- Date and Timepicker -->
<script>
// $(function(){
//   //Date picker
//   $('#datepicker_add').datepicker({
//     autoclose: true,
//     format: 'yyyy-mm-dd'
//   })
//   $('#datepicker_edit').datepicker({
//     autoclose: true,
//     format: 'yyyy-mm-dd'
//   }) 
// });
</script>
<script>


(function ($) {
 // $('#loading_modal').modal({ backdrop: 'static', keyboard: false }, 'show');
})(jQuery);

//$('#loading_modal').modal( 'hide');



function showNotification(colour,msg){
   color = colour;
   

  $.notify({
      icon: "ti-check",
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
function successnotify(colour,msg){
   color = colour;
   
  // Please check the row(s) that you want to claim
  $.notify({
      icon: "ti-check-box",
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
function errornotify(colour,msg){
   color = colour;
   

  $.notify({
      icon: "ti-help-alt",
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


$(document).on('click', '.change_password', function(e){
    e.preventDefault();
   
   var npass = $('#npassword').val();
   var cpass = $('#cpassword').val();
   var current_password = $('#currentpassword').val();
   if(npass == ""){
          $(".errormssg").css("color"," red");
          $(".errormssg").text("New Password is required!");
            setTimeout(function(){
               $(".errormssg").css("color"," white");
            } , 2000);
   }
   else if(cpass == ""){
     $(".errormssg").css("color"," red");
     $(".errormssg").text("Confirm Password is required!");
            setTimeout(function(){
               $(".errormssg").css("color"," white");
            } , 2000);
   }
  else if(npass != cpass){
     $(".errormssg").css("color"," red");
     $(".errormssg").text("New password and confirm password not match!");
            setTimeout(function(){
               $(".errormssg").css("color"," white");
            } , 3000);
   }
    else if(current_password == ''){
     $(".errormsssg").css("color"," red");
     $(".errormsssg").text("Current Password is required!");
            setTimeout(function(){
               $(".errormsssg").css("color"," white");
            } , 2000);
   }

   else{

               $.ajax({  
              url:"action/change_password.php",  
              method:"POST",  
               // data:$('#admin_update_form').serialize(), 
               data: {cpass:cpass,current_password:current_password},
              beforeSend:function(){  
                        //  $('.addeventmodal').val("Saving...");  
              },  
              success:function(data){  

                if(data == 1){
                  $('#change-pass').modal('hide');
                   successnotify('2', 'Success<br> Password Successfully Updated.');

                }
                if(data == 11){
                   errornotify('4',' Error<br> Cannot Update Password.<br> Please Try again! ');
                }
                if(data == 2){
                  $(".errormsssg").css("color"," red");
                  $(".errormsssg").text("Incorrect Current Password!");
                          setTimeout(function(){
                             $(".errormsssg").css("color"," white");
                          } , 2000);
                  $('#currentpassword').val('');
                }
                if(data == 3){
                  errornotify('4',' Error<br> Cannot Update Password.<br> Administrator not found! ');
                }
                

                          
                      //  console.log(data);

               // $('#attendance_status_table').html(data);
              // if(data == "success")
                // showNotification('2',' &nbsp Successfully Added!<br><br>');

                     }  
               });

    
   }

  });
// $(document).on('click', '.admin_update', function(e){
//     e.preventDefault();
      
//       var adminid = $('.adminid').val();
//       var rfid = $('#adminrfid').val();
//       var adminfirstname = $('#adminfirstname').val();
//       var adminlastname = $('#adminlastname').val();
//       var adminmiddlename = $('#adminmiddlename').val();
//       var username = $('#username').val();
//       var password = $('#password').val();
//       var current_password = $('#current_password').val();


//        $.ajax({  
//               url:"action/admin_update.php",  
//               method:"POST",  
//                // data:$('#admin_update_form').serialize(), 
//                data: {adminid:adminid,rfid:rfid,adminfirstname:adminfirstname,adminmiddlename:adminmiddlename,adminlastname:adminlastname,username:username,password:password,current_password:current_password},
//               beforeSend:function(){  
//                         //  $('.addeventmodal').val("Saving...");  
//               },  
//               success:function(data){  

//                 if(data == 1){
//                   alert('correct password Successfully updated');  
//                 }
//                 if(data == 2){
//                   alert('wrong password');
//                 }
//                 if(data == 3){
//                   alert('admin not exist');
//                 }
//                 if(data == 22){
//                     alert('error while updating');
//                   }

                          
//                       //  console.log(data);

//                // $('#attendance_status_table').html(data);
//               // if(data == "success")
//                 // showNotification('2',' &nbsp Successfully Added!<br><br>');

//                      }  
//                });
      



// });
// $(document).ready(function(){
//     $image_crop = $('#image_demoedit').croppie({
//       enableExif: true,
//       viewport: {
//         width:200,
//         height:200,
//         type:'square'
//       },
//       boundary:{
//         width:300,
//         height:300
//       }
//     });
//     $('#uploadimageedit').on('change', function(){
//       var reader = new FileReader();
//       reader.onload = function(event){
//         $image_crop .croppie('bind',{
//           url: event.target.result
//         }).then(function(){
//           // alert('bind complete');
//         });
//       }
//       reader.readAsDataURL(this.files[0]);
//       $('#upload_imageModaledit').modal('show');
//     });
//     $('.crop_imageedit').click(function(event){
//       $image_crop.croppie('result',{
//         type: 'canvas',
//         size: 'viewport'
//       }).then(function(responce){
//         $.ajax({
//           url:'action/cropimage_update.php',
//           type: 'post',
//           data: {'imageedit':responce},
//           success:function(data){
//             $('#upload_imageModaledit').modal('hide');
//             $('#uploadedimageedit').html(data);
//            // alert(''+data);
//           }
//         });
//       });
//     });
//   });

// window.addEventListener('beforeunload',function(e){
//   e.preventDefault();
//   e.returnValue = '';

//     window.location.href = "../logout.php";



// });
</script>


