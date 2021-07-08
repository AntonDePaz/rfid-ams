<!-- Reset -->
<style type="text/css">
  label {
    font-size: 12px;
    font-weight: 600;
  }
</style>
<div class="modal fade" id="reset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Events Information</b></h4>
            </div>
            <form method="post" id="add_event_form" action="">
            <div class="modal-body">
             
                          <!-- <input type="hidden"   name="sem" value="<?php //echo $_SESSION['sem_id']; ?> ">
                          <input type="hidden"   name="sy" value="<?php //echo $_SESSION['sy_id']; ?> ">  -->
                          <!-- <div class="radio pull-right">
                             <input type="hidden" id="option" name="option" value="0">
                          </div> -->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label" for="eventname">Events:</label>
                                <input type="text" class="form-control" name="eventname" id="eventname" placeholder="e.g Intrams Day 1" required pattern=".*\S.*" > 
                            </div>
                          </div>
                        </div>
                            
                          <!-- <div class="col-md-12">
                             <label>Events Name</label>  
                          <input type="text" name="eventname" id="eventname"  class="form-control" placeholder="e.g Intrams Day 1"> 
                          <br />
                          </div>  -->
                      <div class="row">
                         <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label" for="eventname">Date:</label>
                              <input type="date" class="form-control" name="date" id="date" placeholder="e.g Intrams Day 1" required>
                          </div>
                         </div>
                         <div class="col-sm-6">
                         <div class="form-group">
                         <label class="control-label" for="eventname">Time Start:</label>
                         <input type="time" name="time" id="time"  class="form-control" required pattern=".*\S.*"> 
                         </div>
                          </div>
                          <!-- <div class="col-sm-3">
                          <div class="form-group">
                            <label class="control-label" for="eventname">AM/PM:</label>
                            <select class='form-control' name='apm' id='apm' required>
                                 <option value='am'>am</option>";
                                 <option value='pm'>pm</option>";
                              </select>
                          </div>
                         </div>  -->
                         
                        </div>  <!--row end -->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                  <label class="control-label" for="eventname"># of Attendance per Event:</label>
                                  <select class='form-control' name='tap' id='tap' required>
                                      <option></option>";
                                      <option value='1'><b>1</b></option>";
                                      <option value='2'><b>2</b></option>";
                                      <option value='3'><b>3</b></option>";
                                      <option value='4'><b>4</b></option>";
                                      <option value='5'><b>5</b></option>";
                                      <option value='6'><b>6</b></option>";
                                    </select> 
                                </div>
                            </div>   
                          <div class="col-sm-7">
                            <div class="form-group">
                              <label class="control-label" for="fines">Fines per attendance:</label>
                                <input type="text" class="form-control" name="fines" id="fines" placeholder="&#8369 0.00" required pattern=".*\S.*" >
                            </div>
                          </div> 
                          <div class="col-sm-1"></div> 
                      </div> <!--row end -->
                          <!-- <div class="form-group">
                            <label>Fines per attendance</label>  
                          <input type="text" name="fines" id="fines"  class="form-control" placeholder="&#8369 0.00">  
                          </div> -->
                            <p style="font-weight: 200; font-size: 12px;" id="errormsg"></p>
                          <!-- <div class="col-md-5">
                            <label>Date</label>  
                          <input type="Date" name="date" id="date" class="form-control"> 
                           <br />
                          </div> -->
                           
                          
                             <!-- <label>Time Start</label>  
                          <input type="text" name="time" id="time" class="form-control" placeholder="e.g 7:30"> 
                           <br /> -->
                          
                             <!-- <label>AM/PM</label> 
                             <select class='form-control' name='apm' id='apm' >";
                                 <option value='am'>am</option>";
                                 <option value='pm'>pm</option>";
                              </select>
                           <br /> -->
                          

                             <!-- <label># of attendance per event</label>  
                          <select class='form-control' name='tap' id='tap' >;
                                 <option value=''></option>";
                                 <option value='1'><b>1</b></option>";
                                 <option value='2'><b>2</b></option>";
                                 <option value='3'><b>3</b></option>";
                                 <option value='4'><b>4</b></option>";
                                 <option value='5'><b>5</b></option>";
                                 <option value='6'><b>6</b></option>";
                              </select>  
                          <br /> -->
                          
                    
                     
            </div>

            <div class="modal-footer">
               <div class="btnevent"> 
                <button style="margin:10px" type="submit" class="btn btn-success btn-sm pull-right addeventmodal" name="btn_addeventmodal"><i class="fa fa-save"></i> Save Event</button>
                </div>
              <!-- <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"> <i style="color: red;" class="fa fa-close"></i> Close</button>  -->
                         
            </div>
            </form>
        </div>
    </div>
</div>






<div class="modal fade" id="modify">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Modify Events</b></h4>
            </div>
            <form method="post" id="modify_event_form">
            <div class="modal-body">
             
                          <input type="hidden"  class="event_id"  name="event_id" >
                          <!-- <input type="hidden"   name="sem" value="<?php// echo $_SESSION['sem_id']; ?> "> -->
                          <input type="hidden" class="eventdescription_edit">
                          <!-- <input type="hidden"   name="sy" value="<?php// echo $_SESSION['sy_id']; ?> ">  -->
                          <!-- <div class="radio pull-right">
                            <input type="hidden" id="option_edit" name="option" value="0">
                          </div> -->
                          
                          <div class="col-md-12">
                             <label>Events Name</label>  
                          <input type="text" name="edit_eventname" id="edit_eventname"  class="form-control" required pattern=".*\S.*"> 
                        
                          <br />
                          </div> 
                          <div class="col-md-5">
                            <label>Date</label>  
                          <input type="hidden" name="edit_date" id="edit_date"> 
                          <input type="Date" id="edit_date2" class="form-control" disabled> 
                           <br />
                          </div>
                          <div class="col-md-4">
                             <label>Time Start</label>  
                          <input type="text" name="edit_time" id="edit_time" class="form-control" required pattern=".*\S.*"> 
                           <br />
                          </div>
                          <div class="col-md-3">
                             <label>AM/PM</label> 
                             <select class='form-control' name='edit_apm' id='edit_apm' required>
                                 <option value='am'>am</option>";
                                 <option value='pm'>pm</option>";
                              </select>
                           <br />
                          </div>
                          <div class="col-md-5">
                             <label># of attendance per event</label>  
                          <select class='form-control' name='edit_tap' id='edit_tap' required>
                                 <option value=''></option>";
                                 <option value='1'>1</option>";
                                 <option value='2'>2</option>";
                                 <option value='3'>3</option>";
                                 <option value='4'>4</option>";
                                 <option value='5'>5</option>";
                                 <option value='6'>6</option>";
                              </select>  
                          <br />
                          </div>
                           <div class="col-md-1">
                          </div>   
                          <div class="col-md-6">
                            <label>Fines per attendance</label>  
                          <input type="text" name="edit_fines" id="edit_fines"  class="form-control" placeholder="&#8369 0.00" required pattern=".*\S.*">  
                          <br />
                          </div>   
                    
                     <p id="edit_errormsg"></p>
            </div>

            <div class="modal-footer">
               <br /> <br />
               <div class="edit_btn">
                <button style="margin-left: 5px;" type="submit" class="btn btn-primary btn-sm pull-right edit_eventmodal" name="btn_addeventmodal"><i class="fa fa-edit"></i> Update</button>
              </div>
               <div class="delete_btn"><button type="button" class="btn btn-danger btn-sm pull-left delete_eventmodal" name="btn_addeventmodal"><i class="fa fa-trash"></i> Delete</button></div>
                
                
              <!-- <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>  -->
                         
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm_delete_event_modal">
        <div class = "modal-dialog">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST">
               <input type="hidden" class="id" name="id">
              <center><h5>Are you sure you want to delete <b style="font-style: italic;"  class="eventdescription"></b>?</h5>
                <br>
                <h6 class="text-danger">Note: Be careful for deleting events it also remove the fines for every students in masterlist.</h6></center>
              <center>
                <span id="cyes">
                  <button type="button" class="btn btn-danger btn-sm confirm_delete_event" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button>
                </span>
               <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>








<!-- <div class="modal fade" id="resetddddddddddddddddddddddddddddddd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Events</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                  <form method="post" id="insert_form"> 
                          <label>Date</label>  
                          <input type="Date" name="date" id="date"  class="form-control" /> 
                          <br/>
                          <label>Events Name</label>  
                          <input type="text" name="eventname" id="eventname"  class="form-control" />  
                          <br />  
                          <label>Time Start</label>  
                          <input type="text" name="time" id="time" class="form-control"></input>  
                          <br />
                          <div class="form-group">
                            <select class="form-control" name="sex" id="sex" >
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>    
                     </form>
                     <p id="errormsg"></p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <a id="btnadd" type="button" class="btn btn-danger btn-sm btnadd"><i class="fa fa-plus"></i>  Add</a>
            </div>
        </div>
    </div>
</div> -->



<script type="text/javascript">
  // $(document).on('click', '.btnadd',function(){

  //   if($('#date').val() == "")  
  //          {  
  //               $("#errormsg").css("color"," red");
  //               $("#errormsg").text("Date is required!");

  //           setTimeout(function(){
  //              $("#errormsg").css("color"," white");
  //           } , 2000);   
  //          }  

  //       else  if($('#eventname').val() == "")  
  //          {  
  //               $("#errormsg").css("color"," red");
  //               $("#errormsg").text("Events Name is required!");

  //           setTimeout(function(){
  //              $("#errormsg").css("color"," white");
  //           } , 2000);   
  //          }
  //          else  if($('#time').val() == "")  
  //          {  
  //               $("#errormsg").css("color"," red");
  //               $("#errormsg").text("time is required!");

  //           setTimeout(function(){
  //              $("#errormsg").css("color"," white");
  //           } , 2000);   
  //          }
  //          else{
  //           alert('saved events');
  //          }  

  // });
</script>