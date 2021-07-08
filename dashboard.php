<?php  
  include 'includes/session.php'; 
  include 'includes/header.php'; 
  include 'model/connection.php';
  include 'model/dashboard.php';?>

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
              ?>

              <p>No. of Students</p>
            </div>
            <div class="icon">
              <i style="color:lightseagreen;"  class="fa fa-users"></i>
            </div>
            <a href="students.php" class="small-box-footer"> <span class="text-info"> More info </span> <i  class="fa fa-arrow-circle-right text-danger"></i></a>
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
              ?>
          
              <p>No. of Events</p>
            </div>
            <div class="icon">
              <i style="color:lightseagreen;" class="fa fa-calendar-check-o"></i>
            </div>
            <a href="events.php" class="small-box-footer"> <span class="text-info">More info</span> <i class="fa fa-arrow-circle-right text-danger"></i></a>
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
              ?>

              <p>No. of Fees</p>
            </div>
            <div class="icon">
              <i style="color:lightseagreen;" class="fa fa-money"></i>
            </div>
            <a href="fee.php" class="small-box-footer"><span class="text-info">More info</span> <i class="fa fa-arrow-circle-right text-danger"></i></a>
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
               echo "<h3>".($data)."</h3>";
              }
              else{
               echo "<h3>0</h3>";
              }            
              ?>
             
              <p>Total Officers</p>
            </div>
            <div class="icon">
              <i style="color:lightseagreen;" class="fa fa-user"></i>
            </div>
            <a href="setting.php" class="small-box-footer"><span class="text-info">More info</span> <i class="fa fa-arrow-circle-right text-danger"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>

      <div class="row" style="padding-left: 20px;">
        <div class="col-md-5" style=" height: 255px; overflow-y: auto; margin: 10px;  background-color: #fff; box-shadow:0px 0px 1px black;">
          <table class="table" >
            
              <th>Upcoming Events </th>
              <th></th>
              <th></th>
            
             <tbody style="border-top: 3px solid lightseagreen;">
              <?php
                $data = $dashboard->upcoming_events();
                if(!empty($data)){
                foreach($data as $datas){
              ?>
            <tr style="font-size: 12px; ">
            <td ><?php echo ucwords(strtolower($datas['Description'])); ?></td>
            <td><?php echo date('F d Y',strtotime($datas['date'])) ; ?></td>
            <td><?php echo date('g:i a', strtotime($datas['time'])); ?></td>
            </tr>
          <?php } }else{ ?>
            <tr>
              <td> <?php  echo '<h6 style="font-family: cursive;" class="text-danger"> No Upcoming Event(s) </h6>';  ?> </td>
            </tr>
            <?php } ?>
           </tbody>
           
          </table>
           
          
        </div>
        
        <div class="col-md-4" style="margin: 10px;  background-color: #fff;  height: 255px; box-shadow:0px 0px 1px black; overflow: auto;">
         <table class="table">
            <tr style="border-bottom: 3px solid lightseagreen;">
              <th>Todays Events </th>
              <th colspan="2" style="font-size: 12px;"><?php echo "".date('D, M. j, Y').""; ?></th>
            </tr>
            
              <?php
              $data = $dashboard->today_events();
              if(!empty($data)){
                foreach($data as $datas){
              ?>
              <tbody >
            <tr style="font-size: 12px;" >
            <td><?php echo  $datas['Description'];?></td>
            <td class="pull-right"><?php echo date('g:i a', strtotime($datas['time']));?></td>
            <td ><a  style=" margin-bottom: 5px; border-color: green;" data-id = "<?php echo $datas['fe_id'];  ?>"  class="btn btn-default btn-xs pull-right startat"><i class="fa fa-calendar-check-o"></i></a></td>
            </tr>
          <?php } } else { ?>
            <tr>
              <td> <?php  echo '<h6 style="font-family: cursive;"  class="text-danger"> No Event(s) Todays </h6>';  ?> </td>
            </tr> </tbody>
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
              
              echo '<h6 style="font-size: 11px;" ><i class="fa fa-info-circle"></i><span class="text-info"> '.$datas['log_admin_name'].'</span>; <span>'.$datas['log_action'].' '.$datas['log_action_name'].' , </span> <span style="font-style: italic;"> '.$datas['log_description'].'</span>,<span style="font-size: 9px; color: red;"> '.$newdate.'</span> </h6>';
                }
              } ?>
  
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
<?php   include 'includes/active_event.php'; ?>
</body>
</html>
<script src="assets/dashboard.js"></script>

<style>
  .small-box{
   border-radius: 10px; box-shadow:4px 4px 4px 4px #888888;
   border-left: 5px solid lightseagreen;
   background-color: #fff;
  }
  .inner:hover{
    color:lightseagreen;
  }
</style>