<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Admin Profile</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" id="admin_update_form" action="" enctype="multipart/form-data">
                <div class="row text-center">
                  <div id="uploadedimageedit">
                     <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>
                  </div>
                   
                </div>
                <br>
                <div class="form-group text-center ">
                    <!-- <label for="photo" class="col-sm-3 control-label">Photo:</label> -->
                    <div class="col-sm-4"></div>
                    <div class="col-sm-7">
                      <input type="file" name="uploadimageedit" id="uploadimageedit">
                    </div>
                    <div class="col-sm-3"></div>
                    </div>
                    <input type="text" class="adminid" value=" <?php echo $_SESSION['admin_id']; ?> ">
                 <div class="form-group">
                    <label for="adminrfid" class="col-sm-3 control-label">RFID Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adminrfid" name="adminrfid" value=" <?php echo $_SESSION['rfid']; ?> ">
                    </div>
                </div>
                
                  <div class="form-group">
                    <label for="adminfirstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adminfirstname" name="adminfirstname" value="<?php echo $_SESSION['firstname']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="adminlastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adminlastname" name="adminlastname" value="<?php echo $_SESSION['lastname']; ?>">
                    </div>
                </div>
               
                
                <div class="form-group">
                    <label for="adminmiddlename" class="col-sm-3 control-label">Middlename</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="adminmiddlename" name="adminmiddlename" value="<?php echo $_SESSION['middlename']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">New Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" id="password" name="password" value="" placeholder="optional">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="current_password" class="col-sm-3 control-label">Current Password:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="current_password" name="current_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-success btn-flat admin_update" ><i class="fa fa-check-square-o"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="change-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Password</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" id="admin_changepass_form" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="npassword" class="col-sm-4 control-label">New Password</label>

                    <div class="col-sm-8"> 
                      <input type="password" class="form-control" id="npassword" name="npassword" value="" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpassword" class="col-sm-4 control-label">Confirm Password</label>

                    <div class="col-sm-8"> 
                      <input type="password" class="form-control" id="cpassword" name="cpassword" value="" placeholder="">
                    </div>
                </div>
                <h6 style="margin-left: 40px;" class="errormssg"></h6>
                <hr>
                <div class="form-group">
                    <label for="currentpassword" class="col-sm-4 control-label">Current Password:</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Enter Current Password to Save Changes" required>
                    </div>
                </div>
                <h6 style="margin-left: 40px;" class="errormsssg"></h6>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button> -->
              <button type="button" class="btn btn-success btn-sm change_password" ><i class="fa fa-check-square-o"></i> Save Changes</button>
              </form>
            </div>
        </div>
    </div>
</div>

  