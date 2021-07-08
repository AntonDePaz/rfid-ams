<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b class="feeheader"></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" id="form_addfee" enctype="multipart/form-data">
                <input type="hidden" class="gettype" name="option">
                <div class="radio pull-right">
                  <!-- <label><input type="radio" id="option" name="option" value="0" checked>Mandatory</label>
                   <label><input type="radio" id="option" name="option" value="1" >Optional</label> -->
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="description" name="description" required pattern=".*\S.*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="max_vote" class="col-sm-3 control-label">Amount Fee:</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control input-sm" id="amount" name="amount" required pattern=".*\S.*">
                    </div>
                </div>
                <!-- <input type="hidden" name="semester_id" value=" <?php //echo $_SESSION['sem_id'] ?> ">
                <input type="hidden" name="academicyear_id" value=" <?php //echo $_SESSION['sy_id'] ?> "> -->
                <label for="description" class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                      <h6 class="errormsg"></h6>
                    </div>
            </div>
            <div class="modal-footer">
             
              <div class="btn_fee">
                 <button type="button" class="btn btn-primary btn-sm  " id="addfee" name="addfee"><i class="fa fa-save"></i> Save Fee</button>
              </div>
             
             
            </div>
             </form>
        </div>
      </div>
    </div>
</div>
<!-- Add tshirt  -->
<!-- <div class="modal fade" id="addtshirt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add Fee</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" id="form_addfee_tshirt">
                <input type="text" class="gettype" name="option" >
                <div class="radio pull-right">
                </div><br><br>
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="tshirtdescription" name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="max_vote" class="col-sm-3 control-label">Amount Fee:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="tshirtamount" name="amount" required>
                    </div>
                </div>
                <input type="hidden" name="semester_id" value=" <?php// echo $_SESSION['sem_id'] ?> ">
                <input type="hidden" name="academicyear_id" value=" <?php// echo $_SESSION['sy_id'] ?> ">
                <p class="errormsg"></p>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="button" class="btn btn-primary btn-flat " id="btnaddtshirt" name="btnaddtshirt"><i class="fa fa-save"></i> Save</button>
             
            </div>
             
        </div>
    </div>
</div>
</div> -->
<!-- Edit -->
<div class="modal fade" id="edit_fee_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Fee</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" id="form_editfee" enctype="multipart/form-data">
                <input type="hidden" class="feeid" name="feeid">
                <div class="form-group">
                    <label for="edit_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_description" name="description" required pattern=".*\S.*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_amount" name="edit_amount" required pattern=".*\S.*">
                    </div>
                </div>
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                      <h6 class="errormsg"></h6>
                    </div>
            </div>
            <div class="modal-footer">
            
              <div class="btn_fee_edit">
                <button type="button" class="btn btn-success btn-sm" id="editfee" name="editfee"><i class="fa fa-check-square-o"></i> Save Changes</button>
              </div>
              
              </form>
            </div>
        </div>
    </div>
</div>




<!-- Delete -->
<!-- <div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Delete Fee</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="action/delete_fee.php">
                <input type="text" class="deleteid" name="deleteid">
                <div class="text-center">
                    <p>Are you sure want to delete this record?</p>
                    <h2 class="bold description"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div> -->



<div class = "modal fade" id = "confirm_del_fee_modal" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST">
                <input type="hidden" class="deleteid" name="deleteid">
                <input type="hidden" class="del_description">
              <center><label class = "text-danger">Are you sure you want to delete <span style="font-style: italic;" class="confirm_del_fee_modal_description"></span> ?</label></center>
              <br />
              <center><span class="btn_fee_del_load">
                <button type="button" class="btn btn-danger btn-sm btn_confirm_del_fee" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button></span>
                 <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>




<div class = "modal fade" id = "confirm_fee_student_modal" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST"> <!-- action="action/delete_fee.php"  -->
                <input type="hidden" class="deleteid" name="deleteid">
              <center><label class = "text-danger">Are you sure you want to remove this student(s) for this fee?</label></center>
              <br />
              <center><button type="button" class="btn btn-danger btn-sm confirm_fee_student_btn" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>

