<?php 
  include 'includes/conn.php';
   include 'model/connection.php';
if(!isset($_SESSION['admin_id']))
 {
  header('location: index.php');
 } 
 $dbb= new Database();
 ?>
<?php include 'includes/header.php'; ?>


<style type="text/css">
.addschoolyear{
  background-color: transparent;
  color: #0080ff;
}
  .addschoolyear:hover{
    color: #0080ff;
    background-color: transparent;
     border: 1px solid #0080ff;
  }
  
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1 style='font-size:20px;'>
    <i class="fa fa-gears"></i> Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           <!--  <div class="box-header with-border">
              <p>hello</p>
            </div> -->
            <div class="box-body">
              <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                          <li class="active"><a href="#home" data-toggle="tab">Accounts</a></li>
                          <li><a href="#category" data-toggle="tab">Manage Categories </a></li>
                          <li><a href="#database" data-toggle="tab">Manage Academic Year</a></li>
                      </ul>
                  </div>
              </div>
              <div id="my-tab-content" class="tab-content">

                 

                  <div class="tab-pane active" id="home">
                      <div class="content">
                        <div class="container-fluid">



                          <form id="form_add_admin" class="form-horizontal" method="POST" enctype="multipart/form-data" name="datas">
                    
                      <div class="row">
                              <div>
                                <h4 class="title">Administrator Information</h4>    
                               </div>
                                
                            <div class="col-lg-4 col-md-5 text-center">    <!-- column 4 -->
                                              <div class="card card-user">
                                                   <div class="content">
                                                        <div class="author">
                                                          <div id="uploadedimage">
                                                            <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>
                                                          </div>
                                                         <!--  <form method="post" enctype="multipart/form-data">  -->
                                                          
                                                          <div class="form-group">
                                                          <p class="title">Profile Photo</p>
                                                          <!-- <input type="file" id="file" name="file"  class="custom-file getimage"   onchange="showPreview(event);" > -->
                                                          <input style=" content: 'T-Shirt'; font-size: 10px; margin-left: 40%; color: white; clip: rect(0,0,0,); " type="file" name="uploadimage" id="uploadimage" accept="image/*">
                                                         </div>
                                                         <!-- </form> -->
                                                        </div>   
                                                   </div>
                                                   <br>
                                                 <hr> 
                                               </div> 
                                </div>
                                <div class="col-lg-8 col-md-7">     <!--  column 8 -->
                                    <div class="card">
                                      <!--  <form id="form_add_admin" class="form-horizontal" method="POST" enctype="multipart/form-data"> -->
                                        <a style=" cursor: pointer; margin-top:-10px; margin-left: 10px;color: red; font-size: 12px;" class="cancel_admin_profile pull-right">Cancel</a>
                                        <a style="cursor: pointer; margin:-10px 0 10px 0;font-size: 12px;" class="update_admin_profile pull-right">Update My Profile</a>
                                        
                                          <div class="content">
                                          <!-- <form id="form_admin" class="form-horizontal" method="POST" enctype="multipart/form-data"> -->
                                              <input type="hidden" name="admin_id" class="admin_id">
                                             <input type="hidden" name="photopath" class="photopath">
                                              <div class="row">
                                                            <div class="col-md-5">
                                                                   <!--  <div class="form-group"> -->
                                                                        <label>RFID Tag Code</label>
                                                                        <input type="text" name="rfid" class="form-control form-control-sm border-input rfid" placeholder="RFID No." required pattern=".*\S.*"> 
                                                                   <!--  </div> -->
                                                            </div><div class="col-md-3">
                                                                <label>Stu.ID Number</label>
                                                                <input type="text" name="idnumber" class="form-control form-control-sm border-input idnumber" placeholder="ID Number" required pattern=".*\S.*">
                                                            </div>
                                                             <div class="col-md-4 pull-right">
                                                                   <!--  <div class="form-group"> -->
                                                                        <label>Officer Position</label>
                                                                        <select name="position" class="form-control position" required pattern=".*\S.*">
                                                                          <option></option>
                                                                          <option>President</option>
                                                                          <option>Vice President</option>
                                                                          <option>Senator</option>
                                                                          <option>Other</option>
                                                                        </select>
                                                                   <!--  </div> -->
                                                            </div>
                                                </div>
                                                <br>
                                                <div class="row">  <!-- row 2 -->
                                                        <div class="col-md-4">
                                                            <!-- <div class="form-group"> -->
                                                                <label>First Name</label>
                                                                <input type="text" name="firstname" class="form-control firstname" placeholder="Enter Firstname" required  pattern=".*\S.*">
                                                           <!--  </div> -->
                                                        </div>
                                                        <div class="col-md-4">
                                                           <!--  <div class="form-group"> -->
                                                                <label>Middle Name</label>
                                                                <input type="text" name="middlename" class="form-control middlename" placeholder="(Optional)">
                                                           <!--  </div> -->
                                                        </div>
                                                        <div class="col-md-4">
                                                            <!-- <div class="form-group"> -->
                                                                <label>Last Name</label>
                                                                <input type="text" name="lastname" class="form-control lastname" placeholder="Enter Last Name" required pattern=".*\S.*">
                                                           <!--  </div> -->
                                                        </div>
                                                   </div>  <!-- row 2 close -->
                                                   <br>
                                                <div class="row"> 
                                                    <div class="col-md-5">
                                                       <!--  <div class="form-group"> -->
                                                            <label>Username</label>
                                                            <input type="text" name="username" class="form-control username" placeholder="Enter Username" required pattern=".*\S.*">
                                                          <input type="hidden" class="dup_username">
                                                       <!--  </div> -->
                                                    </div>  
                                                    <div class="col-md-7">
                                                        <div class="form-password">
                                                            <label>Password</label>
                                                            <input type="password" name="password" class="form-control password" placeholder="Enter Password" required pattern=".*\S.*"> 
                                                        </div>
                                                        <p style="margin-top:10px;font-size: 12px; font-weight: 500; color: red;" class="wrongpass"></p>
                                                    </div>
                                                    <!-- <div class="col-md-2">
                                                        
                                                    </div> -->
                                                </div><!--  row 3 close -->
                                                <h6 class="errormsg"></h6>
                                                <hr>
                                                <div class="text-center adminbtn">
                                                    <button type="submit" class="btn btn-success btn-sm pull-right save_admin"><i class="fa fa-save"></i> Add Admin</button>
                                                </div>

                                            <div class="clearfix"></div>
                                            <!-- </form> -->
                                        </div> <!-- content close -->

                                     
                                    </div>
                                   
                                </div>
                            </form>
                        </div>  <!-- main row close -->
                
                     

                       <button type="button" class="btn btn-default btn-fill btn-xs pull-left text-info show_admin"><i class="fa fa-show"></i> Show All Account(s)</button>
                       <button style="display: none;" type="button" class="btn btn-default btn-fill btn-xs pull-left text-info hide_admin"><i class="fa fa-show"></i> Hide All Admin</button><hr>
                <div class="row row_admin" style="display: none;">
                  <div class="col-md-12">
                    <div class="boxs">
                      <div class="box-header with-border">
                          <input class="form-control pull-right " type="text" id="search_fee" name="" placeholder="search.." style="width: 200px;">
                         <!--  <label class="pull-left">Fun Run T-Shirt</label> -->
                          <!-- <a class="btn btn-primary btn-sm pull-left modaladdnew"><i class="fa fa-plus"></i> Add Fees</a>
                          <label class="fee_description"></label> -->
                        </div>
                        
                      <div class="box-body">
                        <div  id="student_table">
                        <table id="example12" class="table table-responsive table-striped table-bordered">
                          <thead >
                            <th style="height: 50px;" >#</th>
                            <th>Photo</th>
                            <th>Rfid</th>
                            <th>Firsname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Position</th>
                            <th class="access" ></th>
                          </thead>
                          <tbody id="account_table">
                            <?php

                              $countz = 1;
                              $sql = "SELECT * FROM admin";
                             $query = $db->query($sql);
                             while($row = $query->fetch_assoc()){
                               ?>
                                  <tr>
                                    <td><?php echo $countz++;  ?> </td>
                                    <td> <?php 
                                      if(empty($row['photo']))
                                      {
                                        echo "<img src='images/profile.jpg' width='50' height='50'  style='border-radius: 50%;'> </td>";
                                      }else{
                                        echo "<img src='images/".trim($row['photo'])."' width='50' height='50'  style='border-radius: 50%;'> </td>";
                                      }

                                     ?> 
                                     
                                    <td><?php echo $row['rfid']; ?></td>
                                    <td><?php echo $row['firstname']; ?></td>
                                    <td><?php echo $row['middlename']; ?></td> 
                                    <td><?php echo $row['lastname']; ?></td> 
                                    <td><?php echo ucwords($row['position']); ?></td>  
                                    <td class="access"><a style="color: red;" class='btn btn-default btn-xs admin_del' id="<?php echo ''.$row['firstname'].' '.$row['lastname']; ?>" data-id="<?php echo ucwords($row['admin_id']); ?>"> <i style="font-weight: 900; font-size:12px;" class='fa fa-trash-o'> Remove Account</i></a>
                                    </td>  

                                  </tr>
                               <?php } ?>
                          </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>







































                            
                        </div> <!-- container fluid close -->
                      </div>  <!-- content close -->
                  </div> <!-- tab pane close -->
             



              <!--   CATEGORY TAB -->




                  <div class="tab-pane" id="category" style="min-height: 350px;">
                    <div class="row" style="margin-top: 10px;">
                        <h4 style="margin-left: 20px; margin-bottom: 10px;" >Manage Category</h4>
                      <div class="col-md-4">
                        <div class="row">
                          <div class="col-md-3 col-sm-3 col-xs-6">
                                <ul class="nav nav-stacked" role="tablist" style="font-size: 12px;">
                                  <!-- <li class="active">
                                       <a href="#ay" role="tab" data-toggle="tab">
                                           SY
                                       </a> 
                                    </li> -->
                                    <li class="active">
                                        <a href="#info" role="tab" data-toggle="tab">
                                            Course
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#description" role="tab" data-toggle="tab">
                                            Major
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#concept" role="tab" data-toggle="tab">
                                            Year Level
                                        </a>
                                    </li>
                                    <li>
                                       <a href="#support" role="tab" data-toggle="tab">
                                           Section
                                       </a>
                                    </li>
                                </ul>
                            </div>
                          <div class="col-md-9 col-sm-9 col-xs-6" >
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="info">
                                        <div class="col-md-11" style="margin-top: 40px;">
                                            <div class="form-group">
                                                  <label>Course</label>
                                                  <input type="text" class="form-control border-input input-sm" id="txtcourse" placeholder="Enter Course" >
                                             </div>
                                             <button type="button" class="btn btn-success btn-fill btn-xs saved"><i class="fa fa-save"></i> Save</button>
                                        </div>     
                                    </div>
                                    <div class="tab-pane" id="description">
                                        <div class="col-md-11" style="margin-top: 40px;">
                                            <div class="form-group">
                                                  <label>Major</label>
                                                  <input type="text" class="form-control border-input input-sm" id="txtmajor" placeholder="Enter Major" >
                                             </div>
                                             <button type="button" class="btn btn-success btn-fill btn-xs saved"><i class="fa fa-save"></i> Save</button>
                                        </div> 
                                    </div>
                                    <div class="tab-pane" id="concept">
                                       <div class="col-md-11" style="margin-top: 40px;">
                                            <div class="form-group">
                                                  <label>Year Level</label>
                                                  <input type="text" class="form-control border-input input-sm" id="txtyear" placeholder="Enter Year Level" >
                                             </div>
                                             <button type="button" class="btn btn-success btn-fill btn-xs saved"><i class="fa fa-save"></i> Save</button>
                                        </div> 
                                    </div>
                                    <div class="tab-pane" id="support">
                                        <div class="col-md-11" style="margin-top: 40px;">
                                            <div class="form-group">
                                                  <label>Section</label>
                                                  <input type="text" class="form-control border-input input-sm" id="txtsection" placeholder="Enter Section" >
                                             </div>
                                             <button type="button" class="btn btn-success btn-fill btn-xs saved"><i class="fa fa-save"></i> Save</button>
                                        </div> 
                                    </div>


                                    <!-- <div class="tab-pane  active" id="ay"> -->
                                      <!--   <div class="col-md-11" style="margin-top: 40px;"> -->
                                            <!--  <div class="form-group"> -->
                                                 <!--  <label>Academic Year &nbsp</label>
                                                  <br> -->
                                                 <!--  <div class="row"> -->
                                                      <!--  <div class="col-sm-5">
                                                        </div> -->
                                                       <!--  <div class="col-sm-1">
                                                          <h5><b>&nbspto</b></h5>
                                                        </div> -->
                                                        <!-- <div class="col-sm-5">



                                                        </div> -->
                                                        
                                                 <!--  </div> -->
                                             <!--    </div> -->

                                             <!-- <button type="button" class="btn btn-success btn-fill btn-xs sy_saved"><i class="fa fa-save"></i> Save</button> -->
                                       <!--  </div>  -->
                                   <!--  </div> -->
                                </div>
                            </div>
                        </div>
                      </div>




                     

                      <div class="col-md-8" id="tablemain" style=" max-height: 450px; overflow-y: scroll; font-size: 12px;">
                        <!-- <div class="col-sm-2">
                          <table class="table">
                            <th>Academic_Year</th>
                            <th></th>
                             <?php 
                                // $sql = "SELECT * FROM sy_status order by sy_range" ;
                                // $query = $db->query($sql);
                                // while($row = $query->fetch_assoc()){

                                 ?>
                            <tr>
                              
                              <td><?php// echo strtoupper($row['sy_range']); ?></td>
                            </tr>
                          <?php // } ?>
                          </table>
                        </div> -->
                        <div class="col-sm-4">
                          <table class="table">
                            <th colspan="2" >Course</th>
                             <?php 
                                $sql = "SELECT cat_id ,c_course FROM category where c_course <> '' order by c_course  " ;
                                $query = $db->query($sql);
                                while($row = $query->fetch_assoc()){

                                 ?>
                            <tr>
                              <td><a title="delete" class="fa fa-trash-o del"  id="<?php echo $row['cat_id']; ?>" data-id="c_course" data-name="<?php echo $row['c_course']; ?>" data-type="course"></a></td>
                              <td><?php echo strtoupper($row['c_course']); ?></td>
                            </tr>
                          <?php } ?>
                          </table>
                        </div>
                        <div class="col-sm-3">
                          <table class="table">
                            <th colspan="2">Major</th>
                             <?php 
                                $sql = "SELECT cat_id ,c_major FROM category where c_major <> '' order by c_major  " ;
                                $query = $db->query($sql);
                                while($row = $query->fetch_assoc()){

                                 ?>
                            <tr>
                              <td><a title="delete" class="fa fa-trash-o del" data-name="<?php echo $row['c_major']; ?>" data-type="major"  id="<?php echo $row['cat_id']; ?>" data-id="c_major"></a></td>
                              <td><?php echo strtoupper($row['c_major']); ?></td>
                            </tr>
                          <?php } ?>
                          </table>
                        </div>
                        <div class="col-sm-1">
                          <table class="table">
                            <th colspan="2">Year</th>
                             <?php 
                                $sql = "SELECT cat_id ,c_year FROM category where c_year <> '' order by c_year  " ;
                                $query = $db->query($sql);
                                while($row = $query->fetch_assoc()){

                                 ?>
                            <tr>
                              <td><a title="delete" class="fa fa-trash-o del" data-name="<?php echo $row['c_year']; ?>"  data-type="year" id="<?php echo $row['cat_id']; ?>" data-id="c_year"></a></td>
                              <td><?php echo strtoupper($row['c_year']); ?></td>
                            </tr>
                          <?php } ?>
                          </table>
                        </div>
                        <div class="col-sm-2">
                            <table class="table">
                            <th colspan="2">Section</th>
                             <?php 
                                $sql = "SELECT cat_id ,c_section FROM category where c_section <> '' order by c_section  " ;
                                $query = $db->query($sql);
                                while($row = $query->fetch_assoc()){

                                 ?>
                            <tr>
                              <td><a title="delete" class="fa fa-trash-o del" data-type="section" data-name="<?php echo $row['c_section']; ?>"  id="<?php echo $row['cat_id']; ?>" data-id="c_section"></a></td>
                              <td><?php echo strtoupper($row['c_section']); ?></td>
                            </tr>
                          <?php } ?>
                          </table>
                        </div>
                        <div class="col-sm-1">
                            <table class="table">
                            <th colspan="2">Tshirt Sizes</th>
                             <?php 
                                $sql = "SELECT cat_id ,tshirt_size FROM category where tshirt_size <> '' order by tshirt_size  " ;
                                $query = $db->query($sql);
                                while($row = $query->fetch_assoc()){

                                 ?>
                            <tr>
                              <td><a title="delete" class="fa fa-trash-o del" data-type="tshirt size" data-name="<?php echo $row['tshirt_size']; ?>" id="<?php echo $row['cat_id']; ?>" data-id="tshirt_size"></a></td>
                              <td><?php echo strtoupper($row['tshirt_size']); ?></td>
                            </tr>
                          <?php } ?>
                          </table>
                        </div>
                      </div>
                      </div> 
                  </div>



                  <div class="tab-pane " id="database">
                    <a style="margin: 20px; border-style: none; " href="#add_school_year" data-toggle="modal"  class="btn btn-default btn-xs addschoolyear"><i class="fa fa-plus"></i> Add School Year</a>



          <div class="col-sm-3 pull-right">
            <div class="dropdown" style="margin-top: 20px;">
               <label>Select Active Semester</label>
                <a href="#" class="btn btn-default dropdown-toggle tt_sem" data-toggle="dropdown">
                   <?php 
                     $sql = "SELECT * FROM sem_status where sem_status = 1 " ;
                     $query = $dbb->conn->query($sql);
                     while($row = $query->fetch_assoc()){ 
                     echo strtoupper($row['semester']);
                     $_SESSION['sem_id'] = trim($row['sem_id']);
                     } ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <?php 
                     $sql = "SELECT * FROM sem_status " ;
                     $query = $dbb->conn->query($sql);
                     while($row = $query->fetch_assoc()){ 
                      echo "<li><a href='action/sem_status.php?id=".$row['sem_id']."'><b>".strtoupper($row['semester'])."</b></a></li>";
                     } ?>
                </ul>
          </div>
        </div>        
        <div class="col-sm-4 pull-right">
          <div class="dropdown" style="margin-top: 20px;">
                <label>Select Active Academic Year</label>
                <a href="#" class="btn btn-default dropdown-toggle tt_ay" data-toggle="dropdown">
                  <?php 
                   // $data = $datas->show_active_ay();
                 // echo $data;
                    $sql = "SELECT * FROM sy_status where sy_status = 1 " ;
                    $query = $dbb->conn->query($sql);
                    while($row = $query->fetch_assoc()){ 
                   // foreach($data as $row){
                     // echo $data;
                     echo strtoupper($row['sy_range']);
                      $_SESSION['sy_id'] = trim($row['sy_id']);
                      $_SESSION['sy_range'] = trim($row['sy_range']);
                      } 
                      ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <?php 
                     //$data = $datas->showall_ay();
                     //echo $data;
                     // if(!empty($data)){
                       // foreach ($data as $datas) {
                        //  echo $datas[0];
                    $sql = "SELECT * FROM sy_status " ;
                    $query = $dbb->conn->query($sql);
                    while($datas = $query->fetch_assoc()){ 
                    echo "<li><a href='action/sy_status.php?id=".$datas['sy_id']."'><b>".strtoupper($datas['sy_range'])."</b></a></li>";
                        // } 
                      // }
                     }
                    
                    ?>
                </ul>
          </div>
        </div>
       
    



                      <!-- <button style="margin: 20px;" type="button" class="btn btn-default btn-simple btn-xs add_schoolyear"><i class="fa fa-plus"></i> Add School Year</button> -->
                      <p class="text-center text-info" style="margin-top: 10px; font-style: italic; font-size: 20px; font-weight: 300;" ><!--CLEAR DATA--></p>
                      <div class="content table-responsive table-full-width" style="margin-top: 20px; height: 330px; overflow: auto;">
                          <table class="table table-striped">
                              <thead style="font-style: italic;" >
                                <th>Academic Year</th>
                                <th>Students Data</th>
                                <th>Events Data</th>
                                <th>Fees Data</th>
                                <th></th>
                              </thead>
                              <tbody id="database_table" >
                                <?php 
                               // $count_student = 0;
                                // $sql = "SELECT * FROM students".$_SESSION['sy_id']."";
                                // $query = $db->query($sql);
                                // $count_student = $query->num_rows;
                                  $sql = "SELECT * FROM sy_status order by sy_status desc";
                                 $query = $db->query($sql);
                                 while($row = $query->fetch_assoc()){
                                 ?>
                                  <tr> 
                                    <?php if($row['sy_status'] == 1){ ?>
                                    <td><b style="font-weight: 700;"><?php echo $row['sy_range']; ?></b> <span class="text-success"> (active)</span> </td>
                                    <?php } else { ?>
                                      <td><b style="font-weight: 700;"><?php echo $row['sy_range']; ?></b></td>
                                      <?php } ?>
                                    <td style="font-weight: 700;" > <a data-sy="<?php echo $row['sy_id']; ?>" style="color: red; cursor: pointer; " class="cdata_students" ><i class="fa fa-trash-o"></i></a> &nbsp; <?php
                                      $sql1 = "SELECT * FROM students".trim($row['sy_id'])."";
                                      $query1 = $db->query($sql1);
                                      $count_student = $query1->num_rows;
                                       echo $count_student; ?></td>
                                    <td style="font-weight: 700;"> <a data-sy="<?php echo $row['sy_id']; ?>" style="color: red; cursor: pointer; " class="cdata_events" ><i class="fa fa-trash-o"></i></a> &nbsp; <?php
                                      $sql1 = "SELECT * FROM fee_event where type = 1 and sy_id = ".$row['sy_id']."  ";
                                      $query1 = $db->query($sql1);
                                      $count_student = $query1->num_rows;  
                                       echo $count_student; ?> </td>
                                    <td style="font-weight: 700;"> <a data-sy="<?php echo $row['sy_id']; ?>" style="color: red; cursor: pointer; " class="cdata_fees" ><i class="fa fa-trash-o"></i></a> &nbsp; <?php
                                      $sql1 = "SELECT * FROM fee_event where type = 2 and sy_id = ".$row['sy_id']."  ";
                                      $query1 = $db->query($sql1);
                                      $count_student = $query1->num_rows;
                                       echo $count_student; ?> </td>
                                    <td><a style="color: red; cursor: pointer; " class="sy_range" data-id="<?php echo $row['sy_range']; ?>"  id="<?php echo $row['sy_id']; ?>"  ><i style="font-size: 15px; font-weight: 600;" class="fa fa-hdd-o"></i> Clean All Data</a></td>
                                  </tr>
                                 <?php } ?>
                              </tbody>
                          </table>

                        </div>

                  </div> <!-- close tab database -->











              </div>


            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
  <style type="text/css">
    .del{
      color: red;
      font-weight: 600;
    }
   
   #br{
     background-color: #ffddcc;
       border-radius: 10px;
   }
   
    tr td {
      font-weight: 200;
    }
    .hide_admin, .show_admin{
      background-color: transparent;
      border-style: none;
      color: blue ;
    }
    .hide_admin:hover, .show_admin:hover{
      background-color: transparent;
      border-style: none;
      color: blue ;
    }
   

  </style>



    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/cropimage_modal.php'; ?>
  <?php include 'includes/scripts.php'; ?>
  <?php include 'includes/setting_modal.php'; ?>
</body>
</html>
<div class = "modal fade" id = "delete_admin_modal" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST" action="">
               <input type="hidden" class="data1">
               <input type="hidden" class="data2">
              <center><h5>Are you sure you want to delete this account <span class=" text-info admin_delete_info1" style="font-style: italic;"></span> ?</h5></center>
              <br />
              <center><span class="btn_del_category" ><button type="button" class="btn btn-danger btn-sm del_student" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button></span> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>
    <div class = "modal fade" id = "delete_category_modal" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <form class="form-horizontal" method="POST" action="">
               <input type="hidden" class="deladminid" name="deladminid">
              <center><h5>Are you sure you want to delete <span class=" text-info category_delete_info" style="font-style: italic; text-transform:uppercase;"></span> ?</h5></center>
              <br />
              <center><span class="btn_del_admin" ><button type="button" class="btn btn-danger btn-sm del_student" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button></span> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>

  



<script>

  $(document).ready(function() {


    if("<?php echo ucwords($_SESSION['position']); ?>" != "President"){
      $('.access').hide();
    }



  
 $(".cdata_students").tooltip({title:'Clear all Students Data',placement:'top'});
 $(".cdata_fees").tooltip({title:'Clear all Fee Data',placement:'top'});
 $(".cdata_events").tooltip({title:'Clear all Events Data',placement:'top'});
 

});


$('.rfid').on('change', function(){
  data = $(this).val();
  type = "rfid";
check_duplicate(data,type);

});
$('.username').on('change', function(){
  data = $(this).val();
  type = "username";
check_duplicate(data,type);
});



$(document).on('click','.admin_del',function(){
var nameadmin = $(this).attr('id');
//alert(''+nameadmin);
 var adminid = $(this).data('id');
 $('.deladminid').val(''+adminid);
 const myid = <?php echo $_SESSION['admin_id']; ?>
 // alert(nameadmin)
 if(myid == adminid){
  $('.admin_delete_info1').text(''+nameadmin+' (you)');
 }else{
$('.admin_delete_info1').text(''+nameadmin);}
$('#delete_admin_modal').modal('show');

  });
 $(document).on('click','.btn_del_admin',function(){
      var adminid = $('.deladminid').val();
      //alert(''+adminid);
       $.ajax({
           type: 'POST',
           url: 'action/admin.php',
           data: {del_admin_id:adminid},
           success: function(response){
             
                if(response == 1){
                 //  window.location.href = "setting.php";
                 load_account_table();
                 $('#delete_admin_modal').modal('hide');
                }
                else{
                  alert('ERROR: ADEL:Error');
                }

              }
        });
 });

     
 $(document).on('click','.cdata_students',function(){
   var sy_id = $(this).data('sy');
   //alert('students:'+sy_id)
   $('#cdtype').val('1');
    $('#sy_id107').val(sy_id);
    $('#data_type107').val('101');
   $('.sy_range_data').text('All Students');
   $('#cleardatamodal').modal('show');
  });
  $(document).on('click','.cdata_fees',function(){
    var sy_id = $(this).data('sy');
    $('#cdtype').val('1');
    $('#sy_id107').val(sy_id);
    $('#data_type107').val('102');
   $('.sy_range_data').text('All Fees');
   $('#cleardatamodal').modal('show');
  });
  $(document).on('click','.cdata_events',function(){
    var sy_id = $(this).data('sy');
    $('#cdtype').val('1');
    $('#sy_id107').val(sy_id);
    $('#data_type107').val('103');
   $('.sy_range_data').text('All Events');
   $('#cleardatamodal').modal('show');
  });
  


   $(document).on('click','.sy_range',function(){
    var sy = $(this).data('id');
     var sy_id = $(this).attr('id');
    $('.SY_id').val(""+sy_id);
    $('#cdtype').val('2');
    $('.sy_range_data').text(""+sy+" Academic Year ");
    $('#cleardatamodal').modal('show');

  });
  $(document).on('click','.clear_data',function(){
    var cdtype = $('#cdtype').val();
    var sy_id = $('#sy_id107').val();
    var data_type = $('#data_type107').val();
    $('#ccdtype').val(cdtype);
    $('#sy_id109').val(sy_id);
    $('#data_type109').val(data_type);
    $('#cleardatamodal').modal('hide');
   $('#confirm_cleardatamodal').modal('show');

  });
  $(document).on('click','.confirm_clear_data',function(){
   
    
   //$('#confirm_cleardatamodal').modal('hide');
  // alert('clear data confirm');
   //document.getElementById('cleardatamodal_hide').style.display = 'none';
   var ccdtype = $('#ccdtype').val();
   var sy_id101 = $('#sy_id109').val();
   var datatype = $('#data_type109').val();
   //alert(ccdtype);
  var sy_range_des = $('.sy_range_data').text();
   var table_id = $('.SY_id').val();
   var password = $('#confirm_password').val();

   if(password == ''){
                $(".sy_error").css("color"," red");
                $(".sy_error").text("Empty Field");

            setTimeout(function(){
               $(".sy_error").css("color","transparent");
            } , 2000); 
   }else{

   $.ajax({
        type: 'POST',
        url: 'action/admin.php',
        data: {check_password:password},
        success: function(response){
          if(response == 1){ 

              if(ccdtype == 1){

                //alert('student or else:'+);
                $.ajax({  
                    url:"action/data.php",  
                    method:"POST",  
                    data:{sy_id101:sy_id101,datatype:datatype},
                    beforeSend:function(){  
                       $('.sy_loading').html('<img src="images/loading.gif">'); 
                         document.getElementById('cleardatamodal_hide').style.display = 'none';
                         $("#ccdbtn201").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...'); 
                         document.getElementById('ccdbtn202').style.display = 'none';
                             },  
                    success:function(data){  
                                 if(data == 1){


                                 

                                
                                   addloghistory('CLear','All Data',sy_range_des);
                                   window.location.href = "setting.php";
                                  // load_ay_table();
                                  // $('#confirm_cleardatamodal').modal('hide');
                                  // $('.sy_loading').html(''); 

                                     

                                  //  $.ajax({
                                  //         type: 'POST',
                                  //         url: 'action/log_history.php',
                                  //         data: {action:"Clear",action_name:" All Data",description:sy_range_des},
                                  //         success: function(response){
                                            
                                  //           // window.location.href = "setting.php";
                                  //         }
                                  //       });
                                  
                                 }  
                                else{
                                  $('#confirm_cleardatamodal').modal('hide');
                                  $('.sy_loading').html(''); 
                                //  alert('ERROR: CLDer:408;');
                                  
                                 }
                             }  
                         });
              }
              if(ccdtype == 2){
               // alert('all data')
             
           
               $.ajax({  
                    url:"action/data.php",  
                    method:"POST",  
                    data:{table_id:table_id}, 
                    beforeSend:function(){  
                       $('.sy_loading').html('<img src="images/loading.gif">'); 
                         document.getElementById('cleardatamodal_hide').style.display = 'none';
                         $("#ccdbtn201").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...'); 
                         document.getElementById('ccdbtn202').style.display = 'none';
                             },  
                    success:function(data){  
                                 if(data == 1){


                                 


                                   addloghistory('CLear','All Data',sy_range_des);
                                  // load_ay_table();
                                  // $('#confirm_cleardatamodal').modal('hide');
                                  // $('.sy_loading').html(''); 

                                     window.location.href = "setting.php";

                                  //  $.ajax({
                                  //         type: 'POST',
                                  //         url: 'action/log_history.php',
                                  //         data: {action:"Clear",action_name:" All Data",description:sy_range_des},
                                  //         success: function(response){
                                            
                                  //           // window.location.href = "setting.php";
                                  //         }
                                  //       });
                                  
                                 }  
                                else{
                                  alert('error');
                                 }
                             }  
                         });


              }



            
          } else{
            $('#confirm_password').val('');
                $(".sy_error").css("color"," red");
                $(".sy_error").text("Incorrect Password");

            setTimeout(function(){
               $(".sy_error").css("color","transparent");
            } , 5000); 
          }
        }
      });


   } //else end

  });
  

  $(document).on('click','.cancel_admin_profile',function(){
    window.location.href = "setting.php";

  });
  $(document).on('click','.update_admin_profile',function(){  

      // <?php// if(isset($_SESSION['imagepath'])){ unset($_SESSION['imagepath']); } ?>
     // $('#uploadimage').val('');
      $('#form_add_admin')[0].reset();  

      $('.admin_id').val("<?php echo $_SESSION['admin_id']; ?>");
      $('.rfid').val("<?php echo $_SESSION['rfid']; ?>");
      $('.position').val("<?php echo ucwords($_SESSION['position']); ?>");
      $('.firstname').val("<?php echo $_SESSION['firstname']; ?>");
      $('.middlename').val("<?php echo $_SESSION['middlename']; ?>");
      $('.lastname').val("<?php echo $_SESSION['lastname']; ?>");
      $('.username').val("<?php echo $_SESSION['username']; ?>");
      $('.dup_username').val("<?php echo $_SESSION['username']; ?>");
      

      $('.form-password').html('<label>Current Password</label><input type="password" name="password" class="form-control border-input password" placeholder="Enter Your Password to Save Changes">');
      var photopath = '<?php echo $_SESSION['photo']; ?>';
    //  console.log(""+photopath);
      if(photopath != ''){
      $('#uploadedimage').html('<img style="border-radius: 20px; border: 2px solid black;" width="150" height="150" class="avatar border-white" src="images/'+photopath+'"  class="img-thumbnail" />');
         $('.photopath').val(''+photopath);
        }
        $('.adminbtn').html('<button type="button" class="btn btn-primary btn-sm pull-right update_admin"><i class="fa fa-edit"></i> Update</button>');
      //  var preview = document.getElementById('img_view');
      // preview.src = src;




     
    

   //  $(".errormsg").css("color"," white");

 });

 $(document).on('click','.show_admin',function(){

  //load_account_table();
 


    $('.row_admin').css('display','flex');
    $('.hide_admin').css('display','flex');
    $('.show_admin').css('display','none');
    

   //  $(".errormsg").css("color"," white");

 });
 $(document).on('click','.hide_admin',function(){
  //load_account_table();
    $('.row_admin').css('display','none');
    $('.hide_admin').css('display','none');
    $('.show_admin').css('display','flex');

   //  $(".errormsg").css("color"," white");

 });






  function showPreview(event) {
   if(event.target.files.length > 0)
   {
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById('img_view');
      preview.src = src;
      //preview.style.display = "block";
   }
  }


$(document).on('click','.update_admin',function(){

 // alert('sadsad')
 
         var  rfid = $('.rfid').val();
         var  admin_id = $('.admin_id').val();
         var  firstname = $('.firstname').val();
         var  middlename = $('.middlename').val();
         var  lastname = $('.lastname').val();
         var  username = $('.username').val();
         var  password = $('.password').val();
         var dup_username = $('.dup_username').val();
         // console.log(rfid,firstname,lastname,middlename,username,password,dup_username);

          

           if($('.rfid').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("RFID Tag Code is Required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 3000);   
           } 
          // else if($('#idnumber').val() == "")  
          //  {  
          //       $(".errormsg").css("color"," red");
          //       $(".errormsg").text("ID Number is Required!");

          //   setTimeout(function(){
          //      $(".errormsg").css("color"," white");
          //   } , 2000);   
          //  }    
           else if($('.firstname').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Firstname is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 3000);   
           } 
           //  else if($('#middlename').val() == "")  
           // {  
           //      $(".errormsg").css("color"," red");
           //      $(".errormsg").text("Middlename is required!");

           //  setTimeout(function(){
           //     $(".errormsg").css("color"," white");
           //  } , 2000);   
           // } 
            else if($('.lastname').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Lastname is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 3000);   
           }
            
            else if($('.username').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".username").css("border-color"," red");
                $(".errormsg").text("Username is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 3000);   
           } 
           else if($('.password').val() == "")  
           {  
                $(".wrongpass").css("color"," red");
                $(".password").css("border-color"," red");
                $(".password").css("border-color"," red");
                $(".wrongpass").text("Password is required!");

            setTimeout(function(){
               $(".wrongpass").css("color"," white");
            } , 3000);   
           }  
           else
            {
              // $('.rfid').on('change', function(){
              //   data = $(this).val();
              //   type = "rfid";
              // check_duplicate(data,type);
              // });
              // $('.username').on('change', function(){
              //   data = $(this).val();
              //   type = "username";
              // check_duplicate(data,type);
              // });
            //  alert('updateddsdsdsad');

              $.ajax({
        type: 'POST',
        url: 'action/admin.php',
        data: {check_password:password},
        success: function(response){
          if(response == 1){ 

            console.log(admin_id,rfid,firstname,middlename,lastname,username)

            $.ajax({  
                             url:"action/admin.php",  
                             method:"POST", 
                            //  data: fd,
                           
                           //  data: $('#form_add_admin').serialize(),  
                          // data:{rfid:rfid,firstname:firstname,middlename:middlename,lastname:lastname,username:username,password:password}, 
                              data:{admin_id:admin_id,rfid:rfid,firstname:firstname,middlename:middlename,lastname:lastname,username:username},
                            //  data : fd,
                               // contentType: false,
                            //  processData: false,
                              beforeSend:function(){  
                                 // $('.addeventmodal').text("Saving.. Please wait a minute!");  
                                  //alert('saved events'); 
                             },  
                             success:function(responce){  

                            

                           // alert('success '+responce);

                             if(responce == 2){
                              $(".errormsg").css("color"," red");
                                            $(".errormsg").text("Username Already Used. Try Again!");
                                            $(".username").css("border-color"," red");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," gray");
                                        setTimeout(function(){
                                          $(".errormsg").css("color"," white");
                                        } , 4000);
                             }
                            else if(responce == 3){
                              $(".errormsg").css("color"," red");
                                            $(".username").css("border-color"," gray");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," red");
                                            $(".errormsg").text("RFID Tag Already Used!");

                                        setTimeout(function(){
                                          $(".errormsg").css("color"," white");
                                        } , 4000);
                             }
                             else if(responce == 4){
                              $(".errormsg").css("color"," red");
                                            $(".username").css("border-color"," gray");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," red");
                                            $(".errormsg").text("Idnumber Tag Already Used!");

                                        setTimeout(function(){
                                          $(".errormsg").css("color"," white");
                                        } , 4000);
                             } else{
                               window.location.href = 'setting.php';
                                showNotification('3','Updated Successfully!');
                                            load_account_table();
                                            $('#delete_admin_modal').modal('hide');
                                            $('#form_add_admin')[0].reset();
                                            $('#uploadedimage').html(' <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>');
                                            $(".username").css("border-color"," gray");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," gray");
                                            $(".errormsg").text('');
                             }


                          //  if(responce == 1){
                            
                          //    $(".wrongpass").css("color"," red");
                          //    $(".password").css("border-color"," red");
                          //       $(".wrongpass").text("Incorrect Password!");
                               

                          //   setTimeout(function(){
                          //      $(".wrongpass").css("color"," white");
                          //   } , 2000);  
                          //  //  errornotify('4',' Error<br> &nbsp &nbsp Cannot do update..<br> &nbsp &nbsp Incorrect Password! ');
                          //  }
                          //  else{
                                                  
                          //        //  $('#form_add_admin')[0].reset();  

                          //         // $('.addeventmodal').modal('hide');
                                                        
                          //        window.location.href = "setting.php";
                          //         //  load_account_table();
                          //         // $('#delete_admin_modal').modal('hide');
                          //         // $('#form_add_admin')[0].reset();
                          //      }
                             }  
                         });
            
          }else{
            $(".wrongpass").css("color"," red");
                $(".password").css("border-color"," red");
                $(".password").css("border-color"," red");
                $(".wrongpass").text("Incorrect Password!");

            setTimeout(function(){
               $(".wrongpass").css("color"," white");
            } , 5000);   
          }
        }
        });

          



            }

        
  });

  

  $(document).on('submit', '#form_add_admin', function(e){
    e.preventDefault();
 
  // $(document).on('click','.save_admin',function(){


     // var image = $('.getimage').val();
     // var img = document.getElementById('getimage');
     // var im  = '"'+image+'"';




     // alert(" filepath:"+image);
     // alert(" filepath2:"+img);
     // $('#iamge').attr('src',filepath);



      // var fd = new FormData();
      // var filex = $('#file')[0].files[0];
      // fd.append('file',filex);
      // fd.append('rfid',$('.rfid').val());
      // fd.append('firstname',$('.firstname').val());
      // fd.append('middlename',$('.middlename').val());
      // fd.append('lastname',$('.lastname').val());
      // fd.append('username',$('.username').val());
      // fd.append('password',$('.password').val());

      // console.log(filex);
      //  console.log(fd);


     




        //   var img = document.getElementById('img-view').src;
         // var  rfid = $('.rfid').val();
          //var  pos = $('.position').val();
         // var  middlename = $('.adminmiddlename').val();
         // var  lastname = $('.adminlastname').val();
          var  username = $('.username').val().toLowerCase();
         // var  password = $('.password').val();

         //alert('save admin:'+username);


         // console.log(rfid,firstname,lastname,middlename,username,password);
        // var  image = $('.getimage').val();
          
        //  console.log(img);

       // alert(''+pos);

          if($('.rfid').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("RFID Tag Code is Required!");
                $(".rfid").css("border-color"," red");

                

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           } 
          // else if($('#idnumber').val() == "")  
          //  {  
          //       $(".errormsg").css("color"," red");
          //       $(".errormsg").text("ID Number is Required!");

          //   setTimeout(function(){
          //      $(".errormsg").css("color"," white");
          //   } , 2000);   
          //  }   
          else if($('.position').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Position is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }  
           else if($('.firstname').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Firstname is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           } 
           //  else if($('#middlename').val() == "")  
           // {  
           //      $(".errormsg").css("color"," red");
           //      $(".errormsg").text("Middlename is required!");

           //  setTimeout(function(){
           //     $(".errormsg").css("color"," white");
           //  } , 2000);   
           // } 
            else if($('.lastname').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Lastname is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }
            
            else if($('.username').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Username is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           } 
          
           else if($('.password').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Password is required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }  
           else
            {
              
            // alert('add Successfully');
                   $.ajax({  
                             url:"action/admin.php",  
                             method:"POST", 
                            //  data: fd,
                           
                            data: $('#form_add_admin').serialize(),  
                           //   data:{rfid:rfid, position:position, firstname:firstname,middlename:middlename,lastname:lastname,username:username,password:password}, 
                            //  data : fd,
                               // contentType: false,
                            //  processData: false,
                              beforeSend:function(){  
                                 // $('.addeventmodal').text("Saving.. Please wait a minute!");  
                                  //alert('saved events'); 
                             },  
                             success:function(responce){  

                             
                           
                                      //   alert(responce);    
                                          if(responce == 2){
                                            $(".errormsg").css("color"," red");
                                            $(".errormsg").text("Username Already Used. Try Again!");
                                            $(".username").css("border-color"," red");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," gray");
                                        setTimeout(function(){
                                          $(".errormsg").css("color"," white");
                                        } , 4000);
                                          } 
                                         else if(responce == 3 || responce == 4){
                                            $(".errormsg").css("color"," red");
                                            $(".username").css("border-color"," gray");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," red");
                                            $(".errormsg").text("RFID Tag Already Used!");

                                        setTimeout(function(){
                                          $(".errormsg").css("color"," white");
                                        } , 4000);
                                          }  
                                         else if(responce == 1){
                                            // window.location.href = "setting.php";

                                            showNotification('3','Successfully Added!');
                                            load_account_table();
                                            $('#delete_admin_modal').modal('hide');
                                            $('#form_add_admin')[0].reset();
                                            $('#uploadedimage').html(' <img  style="border-radius: 20px; border: 2px solid black;" width="150" class="avatar border-white" src="images/profile.jpg" alt="..."/>');
                                            $(".username").css("border-color"," gray");
                                            $(".password").css("border-color"," gray");
                                            $(".rfid").css("border-color"," gray");
                                          
                                          }  
                                          else{
                                            aLert('ERROR: 9807')
                                          }
                                 //  $('#form_add_admin')[0].reset();  

                                  // $('.addeventmodal').modal('hide');
                                                        
                                

                             }  
                         });


                      // $.ajax({

                      //      url:"action/add_admin_user.php",
                      //      type:'post',
                      //      data: fd,
                      //     // data : new FormData('#form_add_admin'),
                      //      contentType: false,
                      //      processData: false,
                      //      success: function(responce){
                      //       if(responce != 0){
                      //           alert('okay');
                      //         }else{
                      //           alert('file not uploaded');
                      //         }
                      //      }

                      //    });


                  

                     // $.ajax({  
                     //         url:"action/add_admin_user.php",  
                     //         method:"POST",  
                     //         data:$('#form_add_admin').serialize(), 
                     //          beforeSend:function(){  
                     //             // $('.addeventmodal').text("Saving.. Please wait a minute!");  
                     //              //alert('saved events'); 
                     //         },  
                     //         success:function(data){  
                                                  
                     //             //  $('#form_add_admin')[0].reset();  

                     //              // $('.addeventmodal').modal('hide');
                                                        
                     //            //  window.location.href = "events.php";

                     //         }  
                     //     });
           } 

   });

var year1 = "";
var year2 = "";
var column_name = "";
var column_value = "";

  $(document).on('click','#year1',function(){
    var year = $(this).data('id');
    $('#chooseyear1').text(""+year);
    $('#l1').text(""+year);
    year1 = year;
   });
    $(document).on('click','#year2',function(){

      var year = $(this).data('id');
       $('#chooseyear2').text(""+year);
       $('#l2').text(""+year);
       year2 = year;
   });

  
  $(document).on('click','.saved',function(){
   var course = $('#txtcourse').val();
   var major = $('#txtmajor').val();
   var year = $('#txtyear').val();
   var section =  $('#txtsection').val();
   // var ay =  $('#lall').text();


   if(!course == "")
   {
      column_name = "c_course";
      column_value = course;
       $('#txtcourse').val("");
   }
   if(!major == "")
   {
     column_name = "c_major";
      column_value = major;
      $('#txtmajor').val("");
   }
   if(!year == "")
   {
      column_name = "c_year";
      column_value = year;
      $('#txtyear').val("");
   }
   if(!section == "")
   {
      column_name = "c_section";
      column_value = section;
      $('#txtsection').val("");
   }
   // if(!year1 == "" && !year2 == "")
   // {
   //    column_name = "c_ay";
   //    column_value = ay;
   //    $('#l1').text("");$('#l2').text("");
   //    $('#chooseyear1').text("Select Year");
   //    $('#chooseyear2').text("Select Year");
   // }

   if(!column_name == "" && !column_value == "")
   {
      $.ajax({  
              url:"action/category1.php",  
              method:"POST",  
              data: {cname:column_name,cvalue:column_value},
              beforeSend:function(){  
                        //  $('.addeventmodal').val("Saving...");  
              },  
              success:function(data){  
                          
                        console.log(data);
                if(data == 1){
               // $('#tablemain').html(data);
               load_category_table()
              // if(data == "success")
                // showNotification('2',' &nbsp Successfully Added!<br><br>');

                 successnotify('2', 'Success<br> Successfully Added ');

                }else{
                  errornotify('4', ' Already Exist ');
                }

                     }  
               });
   }
   else
   {
    //showNotification('4',' &nbsp<b>Empty</b>  Field!!<br><br>Please Enter!!');
    errornotify('4','Empty Field!!  ');
   }


   

  });




 $(document).on('click','.sy_saved',function(){
   var ay =  $('#lall').text();
   var academic_year = ay.trim();
   var found = false;
   //alert(" ay:"+academic_year);
  if(!year1 == "" && !year2 == "")
   {
      column_name = "c_ay";
      column_value = ay;
      $('#l1').text("");$('#l2').text("");
      $('#chooseyear1').text("Select Year");
      $('#chooseyear2').text("Select Year");

       <?php include 'includes/conn.php'; $result=mysqli_query($db,"SELECT * from sy_status ");
                while ($row=mysqli_fetch_array($result)){ ?>
                 if(academic_year == "<?php echo $row['sy_range']; ?>")
                 {
                  found = true;
                 $(".error_sy").css("color"," red");
                 $('.error_sy').text('Academic Year Already Exist!!');

            setTimeout(function(){
               $(".error_sy").css("color"," white");
            } , 2000);

                  //errornotify('4',' &nbsp<b>Academic Year Already Exist!!</b>');
                 }
          <?php } ?>

              if(!found)
              { 
              // alert(' okay all year:'+ay+"<");
              
               $.ajax({  
                     url:"action/data.php",  
                     method:"POST",  
                     data: {academic_year:academic_year},
                     beforeSend:function(){  
                      document.getElementById('save_sy_hide').style.display = 'none';
                     // id=aybtn103 spin class then Please Wait... id=aybtn104 disable
                      $("#aybtn103").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Please wait...'); 
                      document.getElementById('aybtn104').style.display = 'none';
                        $('.db_loading').html('<img src="images/loading.gif">');

                     },  
                     success:function(data){  
                          
                      //  console.log(data);
                     // $('#save_sy_hide').modal('hide');
                     window.location.href = "setting.php";
                         // $('#add_school_year').modal('hide');
                         // load_ay_table();
                       //  $('.database_table').html(data);
                        // successnotify('2',' Success <br> <b>'+getcolumn_name+'</b> Successfully deleted!');
                        // $('.db_loading').html('');
                        // document.getElementById('save_sy_hide').style.display = 'block';

                            }  
                      });





               } 






   }
    else
   {
                $(".error_sy").css("color"," red");
                $('.error_sy').text('Please Select Academic Year first..');

            setTimeout(function(){
               $(".error_sy").css("color"," white");
            } , 2000);
   
    //errornotify('4',' Warning <br><br> Empty Field!!');
   }
   
});


$(document).on('click','.del',function(){
    const id = $(this).attr('id');
    const col = $(this).data('id');
    const name = $(this).data('name');
    const type = $(this).data('type');
    $('.data1').val(''+id);
     $('.data2').val(''+col);
     $('.category_delete_info').text(type+" - "+name);
   $('#delete_category_modal').modal('show');

});
   $(document).on('click','.btn_del_category',function(){

    var id = $('.data1').val();
    var col = $('.data2').val();
    var getcolumn_name = "";
    if(col == "c_ay"){
      getcolumn_name = "Academic Year";
    }else if(col == "c_course"){
      getcolumn_name = "Course";
    }
    else if(col == "c_major"){
      getcolumn_name = "Major";
    }
    else if(col == "c_year"){
      getcolumn_name = "Year Level";
    }
    else if(col == "c_section"){
      getcolumn_name = "Section";
    }

     // alert(" id:"+id);
     // alert(" col:"+col);
           $.ajax({  
                     url:"action/category1.php",  
                     method:"POST",  
                     data: {id:id,col:col},
                     beforeSend:function(){  
                        //  $('.addeventmodal').val("Saving...");  
                     },  
                     success:function(data){  
                          
                        //console.log(data);
                        $('#delete_category_modal').modal('hide');

                       // $('#tablemain').html(data);
                       load_category_table();
                        successnotify('2',' Success &nbsp<br><b>'+getcolumn_name+'</b> Successfully deleted!');



                            }  
                      });
   

  });





   $(document).ready(function(){
    $image_crop = $('#image_demo').croppie({
      enableExif: true,
      viewport: {
        width:200,
        height:200,
        type:'square'
      },
      boundary:{
        width:200,
        height:200
      }
    });
    $('#uploadimage').on('change', function(){
      var reader = new FileReader();
      reader.onload = function(event){
        $image_crop .croppie('bind',{
          url: event.target.result
        }).then(function(){
          // alert('bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#upload_imageModal').modal('show');
    });

    $('.crop_image').click(function(event){
      $image_crop.croppie('result',{
        type: 'canvas',
        size: 'viewport'
      }).then(function(responce){
        $.ajax({
          url:'action/cropimage.php',
          type: 'post',
          data: {'image':responce},
          success:function(data){
            $('#upload_imageModal').modal('hide');
            $('#uploadedimage').html(data);
           // alert(''+data);
          }
        });
      });
    });
  });


  function load_category_table(){
    var val = 'depaz';
  $.ajax({
    type: 'POST',
    url: 'action/category1.php',
    data: {val:val},
    dataType:'json',
    success: function(response){
      $('#tablemain').html(response);
    }
  });
}

function load_account_table(){
    var val = 'depaz';
  $.ajax({
    type: 'POST',
    url: 'action/admin.php',
    data: {showall:val},
    dataType:'json',
    success: function(response){

     // console.log(response);
      $('#account_table').html(response);
    }
  });
}

function load_ay_table(){ 
    var val = 'depaz';
  $.ajax({
    type: 'POST',
    url: 'action/data.php',
    data: {val:val},
    dataType:'json',
    success: function(response){
      $('#database_table').html(response);
    }
  });
}

function check_duplicate(data,type){ 
  //  var val = data;
 // var found = false;
 var status = $('.admin_id').val();

if(status == ''){

  $.ajax({
    type: 'POST',
    url: 'action/admin.php',
    data: {check_duplicate:data,type:type},
    dataType:'json',
    success: function(response){

      if(response == 2){
            $(".errormsg").css("color"," red");
          $(".username").css("border-color"," red");
          $(".password").css("border-color"," gray");
           $(".rfid").css("border-color"," gray");
           $(".errormsg").text("Username is Already Used!");
          // $('.update_admin').prop('disabled', true);
          // found = true;
      }
      else if(response == 3){
        $(".errormsg").css("color"," red");
          $(".username").css("border-color"," gray");
          $(".password").css("border-color"," gray");
           $(".rfid").css("border-color"," red");
           $(".errormsg").text("Rfid Tag is Already Used!");
         ////  $('.update_admin').prop('disabled', true);
          //// found = true;
     }
     else if(response == 4){
         $(".errormsg").css("color"," red");
          $(".username").css("border-color"," gray");
          $(".password").css("border-color"," gray");
           $(".rfid").css("border-color"," red");
           $(".errormsg").text("Id Number is Already Used!");
         //  $('.update_admin').prop('disabled', true);
          // found = true;

     }else {
      //$(".errormsg").css("color"," red");
          $(".username").css("border-color"," gray");
          $(".password").css("border-color"," gray");
           $(".rfid").css("border-color"," gray");
           $(".errormsg").text("");
        //   $('.admin_update').prop('disabled', false);
          // found = false;
           
     }
//return found;
     // alert(response)
     //$('#database_table').html(response);
    }
  });
}
}

function addloghistory(action,action_name,description){
                                      $.ajax({
                                            type: 'POST',
                                            url: 'action/log_history.php',
                                            data: {action:action,action_name:action_name,description:description},
                                            success: function(response){
                                                  // window.location.href = "events.php";
                                                 // alert('success')
                                              }
                                            });

                                  }







</script>

