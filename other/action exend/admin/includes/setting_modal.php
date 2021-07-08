    <div class="modal fade" id="add_school_year" >
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST">
              <!--  <input type="hidden" class="id" name="id"> -->
              <center><label>School Year</label></center>
              
              <center><span id="lall" style="color: red;"><span id='l1'></span>-<span id="l2"></span></span></center>
              <br>
                                       <div class="row" id="save_sy_hide">
                                                      <div class="col-sm-6"> 
                                                       
                                                            <div class="dropdown pull-right" >
                                                                  <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                     <p id="chooseyear1">Select Year</p>
                                                                      <!-- <b class="caret"></b> -->
                                                                  </a>
                                                                  <ul class="dropdown-menu" style="cursor: pointer;">
                                                                     <?php 
                                                                      $currentyear = date('Y');
                                                                      $currentyear1 = $currentyear - 1;
                                                                      $currentyear2 = $currentyear + 2; 
                                                                      foreach (range($currentyear1,$currentyear2) as $value) {
                                                                        //echo " <option>".$value."</option>";
                                                                        echo "<li><a id='year1' data-id='".$value."' ><b>".$value."</b></a></li>";
                                                                      }
                                                                    ?>
                                                                  </ul>
                                                            </div>
                                                        </div>
                                                       <!--  <div class="col-sm-1"> -->
                                                          <h5 style="position: absolute; left: 48%;"><b>&nbspto</b></h5>
                                                       <!--  </div> -->
                                                        <div class="col-sm-6">
                                                            <div class="dropdown">
                                                                  <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <p id="chooseyear2">Select Year</p> 
                                                                      <!-- <b class="caret"></b> -->
                                                                  </a>
                                                                  <ul class="dropdown-menu" style="cursor: pointer;">
                                                                     <?php 
                                                                      $currentyear = date('Y');
                                                                      $currentyear1 = $currentyear - 1;
                                                                      $currentyear2 = $currentyear + 2; 
                                                                      foreach (range($currentyear1,$currentyear2) as $value) {
                                                                        //echo " <option>".$value."</option>";
                                                                        echo "<li><a id='year2' data-id='".$value."'><b>".$value."</b></a></li>";
                                                                      }
                                                                    ?>
                                                                  </ul>
                                                            </div>
                                                        </div>
                                                        
                                                  </div>
                                                </div>
                                                <center><h6 class="text-danger error_sy"></h6></center>
                                                <center>
                                                  <div class="db_loading">
                                                </div>
                                                </center>
                                                
                                               
                                                <br>                                                          
              <center><button type="button" class="btn btn-success btn-sm sy_saved"><span id="aybtn103"> <i class="fa fa-save"></i> Save</span></button> <button id="aybtn104" type = "button" class = "btn btn-warning btn-sm" data-dismiss="modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> Cancel</button></center>
              <br>
            </form>
            </div>
          </div>
        </div>
      </div>


    <div class="modal fade" id="cleardatamodal" >
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <br>
              <form class="form-horizontal" method="POST">
               <input type="hidden" class="id" name="id">
               <input type="hidden" id="cdtype">
               <input type="hidden" id="sy_id107">
               <input type="hidden" id="data_type107">
              <center><label>Are you sure you want to Clear all Data for <span class="text-info sy_range_data" style="font-style: italic;"></span> ?</label></center>
              <br />
              <h6 style="margin-left: 50px; font-style: italic; color: red;">Note: After Deleting Data will not be recover again.</h6>
              <br />
              <center><button type="button" class="btn btn-danger btn-sm clear_data" name="delete"><span class = "glyphicon glyphicon-trash"></span> Okay </button> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss="modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> Cancel</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>


      <div class ="modal fade" id="confirm_cleardatamodal">
        <div class = "modal-dialog">
          <div class = "modal-content ">
            <div class = "modal-body">
              <br>
              <form class="form-horizontal" method="POST">
               <input type="hidden" class="SY_id">
                <div class="form-group" id="cleardatamodal_hide">
                    <label for="confirm_password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9" >
                      <input type="hidden" id="ccdtype"> 
                      <input type="hidden" id="sy_id109">
                      <input type="hidden" id="data_type109">
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Your Password to Confirm">
                    </div>
                    <center><div class="sy_loading"></div></center>
                    <label class="col-sm-3"></label>
                    <div class="col-sm-9">
                      <h6 class="sy_error"></h6>
                    </div>
                </div>
                 <center><div class="sy_loading"></div></center>
              <br />
              <h6 style="margin-left: 50px; font-style: italic; color: red;">Note: After Deleting Data will not be recover again.</h6>
              <br />
              <center><button type="button" class="btn btn-danger btn-sm confirm_clear_data" name="delete"><span id="ccdbtn201"> <i class="fa fa-trash"></i> Clear Data </span></button> <button id="ccdbtn202" type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> Cancel</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>