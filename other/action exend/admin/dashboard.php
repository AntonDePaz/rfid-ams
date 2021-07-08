
<?php 
   // include 'includes/conn.php';
   // include 'model/connection.php';
   // include 'model/dashboard.php';
// if(!isset($_SESSION['admin_id'])){
//   header('location: index.php');
//  } else{
//   $dash = new dashboard();
//   $db = new Database();
//  }
 //echo " time:".time()."-".$_SESSION['time_login']."=".(time() - $_SESSION['time_login']);
 ?>

<?php  include 'includes/session.php'; ?>
<?php  include 'includes/header.php'; ?>
<?php include 'model/connection.php';
    include 'model/dashboard.php';
    ?>

<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">

  <?php  include 'includes/navbar.php'; ?>
  <?php  include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #fff !important;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>
      <i class="fa fa-dashboard"></i> Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>

      <!-- <div class="row">
        <div class="col-sm-3 pull-left">
          <div class="dropdown">
                 <label>Academic Year</label>
                <a href="#" class="btn btn-default dropdown-toggle tt_ay" data-toggle="dropdown">
                  <?php 
               //     $data = $datas->  ();
                 // echo $data;
                   // $sql = "SELECT * FROM sy_status where sy_status = 1 " ;
                   // $query = $db->conn->query($sql);
                   // while($row = $query->fetch_assoc()){ 
                   // foreach($data as $row){
                     // echo $data;
                   //  echo strtoupper($row['sy_range']);
                   //   $_SESSION['sy_id'] = trim($row['sy_id']);
                   //   $_SESSION['sy_range'] = trim($row['sy_range']);
                   //   } 
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
                  //  $sql = "SELECT * FROM sy_status " ;
                  //  $query = $db->conn->query($sql);
                  //  while($datas = $query->fetch_assoc()){ 
                  //  echo "<li><a href='action/sy_status.php?id=".$datas['sy_id']."'><b>".strtoupper($datas['sy_range'])."</b></a></li>";
                        // } 
                      // }
                   //  }
                    
                    ?>
                </ul>
          </div>
        </div>
        <div class="col-sm-2 pull-left">
            <div class="dropdown">
               <label>Semester</label>
                <a href="#" class="btn btn-default dropdown-toggle tt_sem" data-toggle="dropdown">
                   <?php 
                   //  $sql = "SELECT * FROM sem_status where sem_status = 1 " ;
                   //  $query = $db->conn->query($sql);
                   //  while($row = $query->fetch_assoc()){ 
                   //  echo strtoupper($row['semester']);
                  //   $_SESSION['sem_id'] = trim($row['sem_id']);
                   //  } ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <?php 
                  //   $sql = "SELECT * FROM sem_status " ;
                  //   $query = $db->conn->query($sql);
                    // while($row = $query->fetch_assoc()){ 
                   //   echo "<li><a href='action/sem_status.php?id=".$row['sem_id']."'><b>".strtoupper($row['semester'])."</b></a></li>";
                  //   } ?>
                </ul>
          </div>
        </div>
    </div> -->

    <br>
    </section>


    <!-- Main content -->

    

    <section class="content">
                      <?php #echo 'Sem:'.$_SESSION['sem_id']; ?>
                      <?php #echo 'Sy:'.$_SESSION['sy_id']; ?>
                      <?php  #echo date('Y-m-d');  ?>
                      
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
               <?php
               $data = $dashboard->countstudent();
               if(!empty($data)){
                echo "<h3>".number_format($data)."</h3>";
               }
               else{
                echo "<h3>0</h3>";
               }
             //  echo 'num:'.$data;
              //  if(isset($_SESSION['sy_id'])){
              //   $sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 ";
              //   $query = $conn->query($sql);
              //   echo "<h3>".$query->num_rows."</h3>";
              // } else{
              //   echo "<h3>0</h3>";
              //  }
              ?>

              <p>No. of Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="students_list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
             
               <?php
               $data = $dashboard->countevents();
               if(!empty($data)){
                echo "<h3>".number_format($data)."</h3>";
               }
               else{
                echo "<h3>0</h3>";
               }

              //  if(isset($_SESSION['sy_id'])){
              //  //echo "<h3> 10 </h3>";
              //   $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
              //   $query = $conn->query($sql);

              //   echo "<h3>".$query->num_rows."</h3>";
              // } else{
              //   echo "<h3>0</h3>";
              //  }
              ?>
          
              <p>No. of Events</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar-check-o"></i>
            </div>
            <a href="events.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
              <?php
               $data = $dashboard->countfee();
               if(!empty($data)){
                echo "<h3>".$data."</h3>";
               }
               else{
                echo "<h3>0</h3>";
               }
              //  if(isset($_SESSION['sy_id'])){
              //  //echo "<h3> 10 </h3>";
              //   $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
              //   $query = $conn->query($sql);

              //   echo "<h3>".$query->num_rows."</h3>";
              //  }
              //  else{
              //   echo "<h3>0</h3>";
              //  }
              ?>

              <p>No. of Fees</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="fee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box">
            <div class="inner">
             <?php
              $data = $dashboard->countadmin();
              if(!empty($data)){
               echo "<h3>".$data."</h3>";
              }
              else{
               echo "<h3>0</h3>";
              }
              //  //echo "<h3> 10 </h3>";
              //   $sql = "SELECT * FROM admin";
              //   $query = $conn->query($sql);

              //   echo "<h3>".$query->num_rows."</h3>";
            
              ?>
             
              <p>Total Officers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="setting.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>

       
     
      <div class="row" style="padding-left: 20px;">
        <div class="col-md-5" style=" height: 200px; overflow-y: auto; margin: 10px;  background-color: #fff;   box-shadow:0px 0px 1px black;">
          <table class="table">
            
              <th>Upcoming Events </th>
              <th></th>
              <th></th>
            
             <tbody>
              <?php
              //if(isset($_SESSION['sy_id'])){
              //$date = date("m/d/Y", strtotime('tomorrow'));
              //$mod_date = strtotime($date."+ 15 days");
              //$date_afte15days = date("m/d/Y",$mod_date);
               //echo $date."-".$date_afte15days;
               // $today = date('m/d/Y');
               // $todays = date('Y/m/d', strtotime($today, ' + 1 day '));
               // echo " today".$today;
               // echo " today15".$todays;
               //echo "<h3> 10 </h3>";
               //$sql = "SELECT * FROM fee_event WHERE DATE_FORMAT( date, '%m/%d/%Y' ) BETWEEN DATE_FORMAT( date, '".$date."' ) AND DATE_FORMAT( date, '".$date_afte15days."' ) and type = 1 and  sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." order by date ";
               // $sql = "SELECT * FROM fee_event where CONVERT(date,'YYYY-MM-DD') = and type = 1 and  sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." order by date  ";
               // $query = $conn->query($sql);
              //while($row = $query->fetch_assoc()){

                $data = $dashboard->upcoming_events();
                if(!empty($data)){
                foreach($data as $datas){
              ?>
            <tr style="font-size: 11px; ">
            <td><?php echo $datas['Description'] ; ?></td>
            <td><?php echo date('F d Y',strtotime($datas['date'])) ; ?></td>
            <td><?php echo date('g:i a', strtotime($datas['time'])); ?></td>
            </tr>
          <?php } }else{ ?>
            <tr>
              <td> <?php  echo '<h6 class="text-danger"> No Upcoming Event(s) </h6>';  ?> </td>
            </tr>
            <?php } ?>
           </tbody>
           
          </table>
           
          
        </div>
        
        <div class="col-md-4" style="margin: 10px;  background-color: #fff;  height: 200px; box-shadow:0px 0px 1px black; overflow: auto;">
         <table class="table">
            
              <th>Todays Events </th>
              <th colspan="2" style="font-size: 12px;"><?php echo "".date('D, M. j, Y').""; ?></th>
              
            
              <?php
              $data = $dashboard->today_events();
              if(!empty($data)){
               //if(isset($_SESSION['sy_id'])){
               //$sql = "SELECT * FROM fee_event where DATE_FORMAT( date, '%m/%d/%Y' ) = DATE_FORMAT( NOW(), '%m/%d/%Y' ) and type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
                //$sql = "SELECT * FROM fee_event where DATE_FORMAT( date, '%m/%d/%Y' ) = NOW()  and type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
                //$query = $conn->query($sql);
                // while($row = $query->fetch_assoc()){
             // $row = $query->fetch_assoc();
              //$_SESSION['event_id'] = $row['fe_id'];
                foreach($data as $datas){
              ?>
            <tr style="font-size: 12px;">
            <td><?php echo  $datas['Description'];?></td>
            <td class="pull-right"><?php echo date('g:i a', strtotime($datas['time']));?></td>
            <td ><a  style=" margin-bottom: 5px; border-color: green;" data-id = "<?php echo $datas['fe_id'];  ?>"  class="btn btn-default btn-xs pull-right startat"><i class="fa fa-calendar-check-o"></i></a></td>
            </tr>
          <?php } } else { ?>
            <tr>
              <td> <?php  echo '<h6 class="text-danger"> No Todays Event(s) </h6>';  ?> </td>
            </tr>
            <?php } ?>
          </table>
              
              
              <!-- href="#actived" data-toggle="modal" -->
           
        </div>
          <div class="col-md-2" style="padding: 0; padding: 0 5px 5px 10px; background-color: #fff; margin-left: 35px; margin-top: 10px;  box-shadow:0px 0px 1px black;">
            <div style="background-color: #fff; height: 25px;">
              Log History
            </div>
            <div style="overflow-y: auto;  height: 225px; background-color: #fff;">
              <?php 
              $data = $dashboard->log_history();
              if(!empty($data)){
                foreach($data as $datas){
                  $datan = $datas['log_time'];
                    $newdate = date('D, M j, Y, h:i A',strtotime($datan));
              
              echo '<h6 style="font-size: 11px;" ><i class="fa fa-check-circle"></i><span class="text-info"> '.$datas['log_admin_name'].'</span>; <span>'.$datas['log_action'].' '.$datas['log_action_name'].' , </span> <span style="font-style: italic;"> '.$datas['log_description'].'</span>,<span style="font-size: 9px; color: red;"> '.$newdate.'</span> </h6>';
                }
              }
            //   if(isset($_SESSION['sy_id'])){
            //     $sql = "SELECT * FROM log_history".$_SESSION['sy_id']." where sem_status = ".$_SESSION['sem_id']." order by log_time desc";
            //      $query = $conn->query($sql);
            //       while($row = $query->fetch_assoc()){
            //         $datan = $row['log_time'];
            //         $newdate = date('D, M j, Y, h:i A',strtotime($datan));
              
            //   echo '<h6 style="font-size: 11px;" ><i class="fa fa-check-circle"></i><span class="text-info"> '.$row['log_admin_name'].'</span>; <span>'.$row['log_action'].' '.$row['log_action_name'].' , </span> <span style="font-style: italic;"> '.$row['log_description'].'</span>,<span style="font-size: 9px; color: red;"> '.$newdate.'</span> </h6>';

            //  } } ?>
  
            </div>     
          </div>
      </div>
      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php  include 'includes/scripts.php'; ?>
<?php  // include 'includes/students_modal.php'; ?>
<?php  // include 'includes/attendance_status_modal.php'; ?>
<?php   include 'includes/active_event.php'; ?>
</body>
</html>
<script src="assets/dash1.js"></script>

<style>
  .small-box{
   border-radius: 10px; box-shadow:4px 4px 4px 4px #888888;
   border-left: 5px solid lightseagreen;
   background-color: #fff;
  }
  .inner:hover{
    color:cyan;
  }
</style>