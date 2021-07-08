  <!-- Add -->

 <?php //include 'model/category.php'; $category = new category(); ?>
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Students Information</b> <span style="font-size: 12px; font-style:italic;"> for S.Y <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sy_range']; } ?> </span> </h4>
            </div>
             <form id="form_add_student" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             
                <div class="form-group">
                    <label for="rfid" class="col-sm-3 control-label">RFID Tag</label>
                    <div class="col-sm-9"> 
                      <input type="text" class="form-control input-sm" id="rfid" name="rfid" required pattern=".*\S.*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="idnumer" class="col-sm-3 control-label">IDNumber</label>
                    <div class="col-sm-4">
                      
                      <input type="text" class="form-control input-sm" id="idnumber" name="idnumber" required pattern=".*\S.*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="firstname" name="firstname" required pattern=".*\S.*">
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="middlename" class="col-sm-3 control-label">Middlename</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="middlename" name="middlename" placeholder="Optional">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="lastname" name="lastname" required pattern=".*\S.*">
                    </div>
                </div>
                      <div class="form-group">
                              <label for="section" class="col-sm-3 control-label">Section</label>
                               <div class="col-sm-3">
                                <select class = "form-control input-sm" name = "section" id="section" required>
                                  <option></option>
                                  <?php 
                                 
                                  $result = $category->section();
                                  foreach($result as $row){
                               // $sql = "SELECT * FROM category where c_section <> '' order by c_section  " ;
                                //$query = $conn->conn->query($sql);
                               // while($row = $query->fetch_assoc()){ 
                                  echo "<option>".ucwords($row['c_section'])."</option>";
                                } ?>
                                </select>
                               </div>
                               <label for="yearlevel" class="col-sm-2 control-label">Year_Level</label>
                                 <div class="col-sm-4">
                                  <select class = "form-control input-sm" name = "yearlevel" id="yearlevel" required>
                                    <option></option>
                                     <?php 
                                     // $sql = "SELECT * FROM category where c_year <> '' order by c_year ";
                                     // $query = $conn->conn->query($sql);
                                     // while($row = $query->fetch_assoc()){ 
                                       $result = $category->year();
                                       foreach($result as $row){
                                        echo "<option>".$row['c_year']."</option>";  
                                       } ?>
                                  </select>
                                 </div>
                      </div>
                     
                
                <div class="form-group">
                        <label for="course" class="col-sm-3 control-label">Course</label>
                         <div class="col-sm-4">
                          <select class = "form-control input-sm" name = "course" id="course" required>
                            <option></option>
                             <?php 
                               // $sql = "SELECT * FROM category where c_course <> '' order by c_course" ;
                                //$query = $conn->conn->query($sql);
                               // while($row = $query->fetch_assoc()){ 
                                 $result = $category->course();
                                 foreach($result as $row){
                                  echo "<option>".ucwords(strtolower($row['c_course']))."</option>";
                                 } ?>
                            
                          </select>
                        </div>
                        <label for="major" class="col-sm-1 control-label">Major</label>
                         <div class="col-sm-4">
                          <select class = "form-control input-sm" name = "major" id="major" required>
                            <option></option>
                             <?php 
                             $result = $category->major();
                             foreach($result as $row){
                               // $sql = "SELECT * FROM category where c_major <> '' order by c_major  " ;
                               // $query = $conn->conn->query($sql);
                               // while($row = $query->fetch_assoc()){ 
                                  echo "<option>".ucwords(strtolower($row['c_major']))."</option>";
                                 } ?>
                          </select>
                        </div>
                </div>
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                       <h6 class="errormsg"></h6>
                    </div>
             
            </div>

            <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-sm pull-right" id="addstudent" name="addstudent"><span class="btnsave12"><i class="fa fa-save"></i> Save</span></button>
           
             
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Students</b></h4>
            </div>
            <div class="modal-body">
              <form id="form_edit_student" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="id" name="edit_id">
                <div class="form-group">
                    <label for="edit_rfid" class="col-sm-3 control-label">RFID Tag</label>
                    <div class="col-sm-9">
                      <input type="hidden" id="drfid" name="drfid">
                      <input type="text" class="form-control input-sm" id="edit_rfid" name="edit_rfid" required pattern=".*\S.*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_idnumber" class="col-sm-3 control-label">IDNumber</label>
                    <div class="col-sm-4">
                      <input type="hidden" id="didnumber" name="didnumber"> 
                      <input type="text" class="form-control input-sm" id="edit_idnumber" name="edit_idnumber" required pattern=".*\S.*">
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="edit_firstname" name="edit_firstname" required pattern=".*\S.*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_middlename" class="col-sm-3 control-label">Middlename</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="edit_middlename" name="edit_middlename" placeholder="Optional">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="edit_lastname" name="edit_lastname" required pattern=".*\S.*">
                    </div>
                </div>
                      <div class="form-group">
                              <label for="edit_section" class="col-sm-3 control-label">Section</label>
                               <div class="col-sm-3">
                                <select class = "form-control input-sm" name = "edit_section" id="edit_section">
                                  <option></option>
                                      <?php 
                                      $result = $category->section();
                                    //$sql = "SELECT * FROM category where c_section <> '' order by c_section  " ;
                                   // $query = $conn->conn->query($sql);
                                   // while($row = $query->fetch_assoc()){
                                     foreach($result as $row){
                                        echo "<option>".strtoupper($row['c_section'])."";
                                     } ?>
                                </select>
                              </div>
                               <label for="edit_yearlevel" class="col-sm-2 control-label">Year_Level</label>
                                 <div class="col-sm-4">
                                  <select class = "form-control input-sm" name = "edit_yearlevel" id="edit_yearlevel">
                                    <option></option>
                                    <?php 
                                   // $sql = "SELECT * FROM category where c_year <> '' order by c_year  " ;
                                    //$query = $conn->conn->query($sql);
                                    //while($row = $query->fetch_assoc()){
                                      $result = $category->year();
                                      foreach($result as $row){
                                        echo "<option>".$row['c_year']."";
                                     } ?>
                                  </select>
                                 </div>
                      </div>
                  
                
                <div class="form-group">
                        <label for="edit_course" class="col-sm-3 control-label">Course</label>
                         <div class="col-sm-4">
                          <select class = "form-control input-sm" name = "edit_course" id="edit_course">
                            <option></option>
                            <?php 
                                   // $sql = "SELECT * FROM category where c_course <> '' order by c_course  " ;
                                   // $query = $conn->conn->query($sql);
                                  //  while($row = $query->fetch_assoc()){
                                    $result = $category->course();
                                    foreach($result as $row){
                                        echo "<option>".strtoupper($row['c_course'])."";
                                     } ?>
                          </select>
                        </div>
                        <label for="edit_major" class="col-sm-1 control-label">Major</label>
                         <div class="col-sm-4">
                          <select class = "form-control input-sm" name = "edit_major" id="edit_major">
                            <option></option>
                            <?php 
                                  //  $sql = "SELECT * FROM category where c_major <> '' order by c_major  " ;
                                  //  $query = $conn->conn->query($sql);
                                   // while($row = $query->fetch_assoc()){
                                     $result = $category->major();
                                     foreach($result as $row){
                                        echo "<option>".strtoupper($row['c_major'])."";
                                     } ?>
                          </select>
                        </div>
                </div>
                 <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                      <h6 class="errormsg"></h6>
                    </div>
                
            </div>
            <div class="modal-footer">
              <!-- <button type="submit" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button> -->
              <button type="submit" class="btn btn-primary btn-sm btn_edit_student" name="edit"><span class="btnsave13"><i class="fa fa-check-square-o"></i> Save Changes</span></button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->


<div class="modal fade" id="print_option_model">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"> &times;</span></button>
              <h5 class="modal-title">Print Record Option</h4>
            </div>
              <center> <button type="button" class="btn btn-success btn-xs cprint101" > <span id="xpbtntype"><i class="fa fa-print"></i> Print</span></button>     </center>  
            <div class="modal-body" id="panel_body">
           

            <form class="form-horizontal" method="POST" action="">
                                    
                <input type="hidden" id="pxtype">
                <div class="form-check radio-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ryear" value="option1">
                <label class="form-check-label" for="inlineRadio1">By Year</label>
                </div>
                <div class="form-check radio-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="rcourse" value="option1">
                <label class="form-check-label" for="inlineRadio1">By Course</label>
                </div>
                
                <hr>
               <div id="panel_course">
               <form  id="form11">
               <div class="form-check">
                   <input class="form-check-input" type="checkbox" id="chkall_course">
                   <label class="form-check-label" for="chk">All</label>
                </div>
                <?php
                    $result = $category->course();
                    foreach($result as $row){
                      ?>
                      <div class="form-check">
                        <input class="form-check-input chkcourse" name="chkcourse"  type="checkbox"  value="<?php echo strtoupper($row['c_course']); ?>">
                        <label style="font-weight:200" class="form-check-label" for="chk"><?php echo strtoupper($row['c_course']); ?></label>
                      </div>
                      <?php 
                    } ?>
                     </form>
                  </div>
                 
                  <div id="panel_year">
                  <div class="form-check">
                   <input class="form-check-input" type="checkbox" id="chkall_year">
                   <label class="form-check-label" for="chk">All</label>
                  </div>
                <?php
                    $result = $category->year();
                    foreach($result as $row){
                      ?>
                      <div class="form-check ch">
                        <input class="form-check-input chkyear" name="chkyear"  type="checkbox" value="<?php echo strtoupper($row['c_year']); ?>">
                        <label style="font-weight:200" class="form-check-label" for="chk"><?php echo strtoupper($row['c_year'])." Year"; ?></label>
                      </div>
                      <?php 
                    } ?>
                  </div>


                     </form>
               </div>
           
            <div class="modal-footer">
          
            </div>
        </div>
    </div>
</div>


<div class = "modal fade" id = "delete" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST" action="">
               <input type="hidden" class="id" name="id">
              <center><h5>Are you sure you want to remove <span class=" text-info student_delete" style="font-style: italic;"></span> for whole SEMESTER <?php echo $_SESSION['sem_id']." SY ".$_SESSION['sy_range']; ?>  ?</h5></center>
              <br />
              <center><span class="btn_del_stu" ><button type="button" class="btn btn-danger btn-sm del_student" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button></span> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>



     