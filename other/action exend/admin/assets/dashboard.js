$(document).ready(function() {
    $(".startat").tooltip({title:'Click to start attendance',placement:'top'});
    $(".tt_ay").tooltip({title:'Academic Year Status',placement:'top'});
    $(".tt_sem").tooltip({title:'Semester Status',placement:'top'});
   });
   
    $(document).on('click', '.startat', function(e){
       e.preventDefault();
       var eventid = $(this).data('id');

       alert(eventid)
        // if(eventid == "")
        // {
        //  errornotify('4',' Error<br> &nbsp &nbsp No Event for this Day! ');
        // }
        //  else{
        //   $.ajax({  
        //          url:"action/jumpage.php",  
        //          method:"POST",  
        //          data: {jumpeventid:eventid},
        //          success:function(data){  
        //                      if(data == 1){
        //                        $('#actived').modal('show');
        //                      } else {
        //                        alert('ERROR: to set SESSION event(s) id.');
        //                      }
        //                 }  
        //           });
        //  }     
     });
    
     $(document).on('click', '.start', function(e){
       e.preventDefault();
       
       var get_status = $('.get_status').val();
       var eventid = $('.eventid').val();
       if(get_status == 1){
        // $('.tap_status').text(tap_status);
         $('#actived').modal('hide');
        window.open('attendance_event.php','name','width=1000,height=500,toolbar=0');
       }
   
       else{
         $(".errormsg").css("color"," red");
                   $(".errormsg").text("Please activated status first!");
   
               setTimeout(function(){
                  $(".errormsg").css("color"," white");
               } , 2000);  
         //showNotification(4," Please activated status first!");
       }
   
        
     });
     $(document).on('click', '.activate', function(e){
       e.preventDefault();
       ///$('#edit').modal('show');
      var id = $(this).data('id');
      var eventid = $('.eventid').val();
      var status = '';
        $.ajax({  
                 url:"action/attendance.php",  
                 method:"POST",  
                 data: {active_id:id,active_eventid:eventid,status:status},
                 dataType: 'json',
                 beforeSend:function(){  
                           //  $('.addeventmodal').val("Saving...");  
                 },  
                 success:function(data){  
                             
                           console.log(data);
   
                   $('#attendance_status_table').html(data);
                 // if(data == "success")
                   // showNotification('2',' &nbsp Successfully Added!<br><br>');
   
   
   
                        }  
                  });
   
   
     });
     $(document).on('click', '.deactivate', function(e){
       e.preventDefault();
       ///$('#edit').modal('show');
       var id = $(this).data('id');
       var eventid = $('.eventid').val();
       var status = 1;
    
       //alert('ideac:'+id+' '+eventid);
        $.ajax({  
                 url:"action/active_time.php",  
                 method:"POST",  
                 data: {id:id,eventid:eventid,status:status},
                 beforeSend:function(){  
                           //  $('.addeventmodal').val("Saving...");  
                 },  
                 success:function(data){  
                             
                           console.log(data);
   
                   $('#attendance_status_table').html(data);
                 // if(data == "success")
                   // showNotification('2',' &nbsp Successfully Added!<br><br>');
   
   
   
                        }  
                  });
     });
   
   
   
   