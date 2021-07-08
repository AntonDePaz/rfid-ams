$(document).ready(function(){
    $(".username").focus();
})

$('#form_admin').on('submit',function(e){
  e.preventDefault();
                     $.ajax({  
                              url:"action/login.php",  
                                method:"POST",  
                               data: $('#form_admin').serialize(),  
                                // contentType : false,
                                // cache : false,
                                // processData : false,
                                beforeSend:function(){  
                                   $(".load").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Loading...'); 
                                },  
                                success:function(data){  
                                    // $('.footer').html(data);
                                    if(data == 2){
                                       $(".load").html('<i class="fa fa-sign-in"></i> Sign In');
                                       $(".errormsg").css("color"," red");
                                        $(".errormsg").text("Access Denied!");
                                         setTimeout(function(){
                                            $(".errormsg").css("color","Transparent");
                                         } , 2000);   $(".username").focus();
                                         $('#form_admin')[0].reset();  

                                    }
                                    if(data == 1){
                                       window.location.href = "dashboard.php";
                                    }
                                  
                                } 
                              });

});
