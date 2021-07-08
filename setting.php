<?php 
  //include 'includes/conn.php';
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
      <input type="hidden" class="adminid" value="<?php echo $_SESSION['admin_id'] ?>">
      <input type="hidden" class="adminphoto" value="<?php echo $_SESSION['photo'] ?>">
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

                 
                    <input type="hidden" class="admin_type" value="<?php echo ucwords($_SESSION['position']); ?>" >
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
                                                                <input type="text" name="idnumber" class="form-control form-control-sm border-input id_num" placeholder="ID Number" required pattern=".*\S.*">
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
                            <th style="height: 50px;" >No.</th>
                            <th>Photo</th>
                            <th>ID Number</th>
                            <th>Firsname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Position</th>
                            <th class="access" >Action</th>
                          </thead>
                          <tbody id="account_table">
                            <?php

                              $countz = 1;
                              $sql = "SELECT * FROM admin WHERE admin_id <> 1";
                             $query = $dbb->conn->query($sql);
                             while($row = $query->fetch_assoc()){
                               ?>
                                <td><?php echo $countz++; ?></td>
                                   <td>
                                     <?php 
                                      if(empty($row['photo']))
                                      {
                                        echo "<img src='images/profile.jpg' width='50' height='50'  style='border-radius: 50%;'> </td>";
                                      }else{
                                        echo "<img src='images/".trim($row['photo'])."' width='50' height='50'  style='border-radius: 50%;'> </td>";
                                      }

                                     ?> 
                                     
                                    <td><?php echo $row['id_number']; ?></td>
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
                                $query = $dbb->conn->query($sql);
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
                                $query = $dbb->conn->query($sql);
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
                                $query = $dbb->conn->query($sql);
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
                                $query = $dbb->conn->query($sql);
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
                            <th colspan="2">Tshirt Sizes <i style="position:absolute;" class="fa fa-info-circle" title="To Add Tshirt Size, go to Fees Tab"></i></th>
                             <?php 
                                $sql = "SELECT cat_id ,tshirt_size FROM category where tshirt_size <> '' order by tshirt_size  " ;
                                $query = $dbb->conn->query($sql);
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
                                 $query = $dbb->conn->query($sql);
                                 while($row = $query->fetch_assoc()){
                                 ?>
                                  <tr> 
                                    <?php if($row['sy_status'] == 1){ ?>
                                    <td><b style="font-weight: 700;"><?php echo $row['sy_range']; ?></b> <span class="text-success"> (active)</span> </td>
                                    <?php } else { ?>
                                      <td><b style="font-weight: 700;"><?php echo $row['sy_range']; ?></b></td>
                                      <?php } ?> 
                                      
                                     
                                    <?php
                                      $sql1 = "SELECT * FROM students".trim($row['sy_id'])."";
                                      $query1 = $dbb->conn->query($sql1);
                                      $count_student = $query1->num_rows; ?>
                                     <td style="font-weight: 700;" > <a data-sum="<?php echo $count_student; ?>"  data-sy="<?php echo $row['sy_id']; ?>" style="color: red; cursor: pointer; " class="cdata_students" ><i class="fa fa-trash-o"></i></a> &nbsp; 
                                      <?php
                                       echo $count_student; ?></td>


                                   
                                    <?php
                                      $sql1 = "SELECT * FROM fee_event where type = 1 and sy_id = ".$row['sy_id']."  ";
                                      $query1 = $dbb->conn->query($sql1);
                                      $count_student = $query1->num_rows;  ?>
                                       <td style="font-weight: 700;"> <a data-sum="<?php echo $count_student; ?>" data-sy="<?php echo $row['sy_id']; ?>" style="color: red; cursor: pointer; " class="cdata_events" ><i class="fa fa-trash-o"></i></a> &nbsp; 
                                       <?php
                                       echo $count_student; ?> </td>


                                    <?php
                                      $sql1 = "SELECT * FROM fee_event where type = 2 and sy_id = ".$row['sy_id']."  ";
                                      $query1 = $dbb->conn->query($sql1);
                                      $count_student = $query1->num_rows;?>
                                     <td style="font-weight: 700;"> <a data-sum="<?php echo $count_student; ?>" data-sy="<?php echo $row['sy_id']; ?>" style="color: red; cursor: pointer; " class="cdata_fees" ><i class="fa fa-trash-o"></i></a> &nbsp;
                                     <?php  echo $count_student; ?> </td>
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
<script src="assets/setting.js"></script>
<div class = "modal fade" id = "delete_admin_modal">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
            
            <input type="hidden" class="deladminid" name="deladminid">
              <center><h5>Are you sure you want to delete this account <span class=" text-info admin_delete_info1" style="font-style: italic;"></span> ?</h5></center>
              <br />
              <center><span class="btn_del_admin" ><button type="button" class="btn btn-danger btn-sm del_student" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button></span> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
          
            </div>
          </div>
        </div>
      </div>
    <div class = "modal fade" id = "delete_category_modal">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
            
              
               <input type="hidden" class="data1">
               <input type="hidden" class="data2">
              <center><h5>Are you sure you want to delete <span class=" text-info category_delete_info" style="font-style: italic; text-transform:uppercase;"></span> ?</h5></center>
              <br />
              <center><span class="btn_del_category" ><button type="button" class="btn btn-danger btn-sm del_student" name="delete"><span class = "glyphicon glyphicon-trash"></span> Yes </button></span> <button type = "button" class = "btn btn-warning btn-sm" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
           
            </div>
          </div>
        </div>
      </div>

  



<script>




</script>

