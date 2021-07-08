<?php 
//   include 'includes/session.php';
// if(!isset($_SESSION['admin_id']))
//  {
//   header('location: index.php');
//  } 
 ?>
 <?php 
   // include 'includes/conn.php';
   // include 'model/connection.php';
    // include 'model/event.php';
// if(!isset($_SESSION['admin_id'])){
//   header('location: index.php');
//  }
//   else{
//   $event = new event();
//   //$db = new Database();
//  }
 //echo " time:".time()."-".$_SESSION['time_login']."=".(time() - $_SESSION['time_login']);
 ?>
 <?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php  include 'model/event.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php  include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>



  <?php 

    if(!isset($_SESSION['sy_id']))
    {
      unset($_SESSION['sy_id']);
    }

   ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Manage Events
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Events</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row" >
        <?php  if(isset($_SESSION['sy_id'])) { ?>
        <div class="col-xs-12">
          <div class="box">
            
            <div class="box-header with-border"><!--  -->
              <a   class="btn btn-info btn-xs addevent"><i class="fa fa-plus"></i> Add Events</a>

              
            </div>
            <div class="box-body" style="height:100%; overflow-y: auto;">
            <h6>List Of Active Events</h6>
          <div id="load-container-data">
          </div>
           
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php  include 'includes/events_modal.php'; ?>
 
</div>
<?php include 'includes/scripts.php'; ?>
 <!--  loading end -->
</body>

</html>
<div class ="modal fade" id="confirm_remove_event" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
        <div class = "modal-dialog" role = "document">
          <div class = "modal-content ">
            <div class = "modal-body">
              <br>
              <form class="form-horizontal" method="POST" action="" id="confirm_remove_event_form">
                <div class="form-group">
                  <h6 class="text-info" style="margin-left: 50px; font-style: italic;">Need type the password because this event have already data stored.</h6>
                    <label for="confirm_password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Your Password to Confirm">
                      <h6 class="xpass"></h6>
                    </div>
                    
                </div>
              <br />
              <h6 style="margin-left: 50px; font-style: italic; color: red;">Note: After Deleting this event will not be recover again.</h6>
              <br />
              <center><span class="btn_del_event"><button type="button" class="btn btn-danger delete_event" name="delete"><span class = "glyphicon glyphicon-trash"></span> Delete Events </button></span> <button type="button" data-dismiss="modal" class="btn btn-warning cancel_confirm_password"><span class = "glyphicon glyphicon-remove"></span> Cancel</button></center>
            </form>
            </div>
          </div>
        </div>
      </div>
   

<script src="assets/event.js"></script>
<!-- <div class="modals" style="display: none">
    <div class="center">
        <img alt="" src="../images/load.gif" />
    </div>
</div> -->










<style type="text/css">
  
  /*.outer {
    width:itemName 450px;
    height: 200px;
    border: 2px solid gray;
  }*/
  /*.inner {
    width: 200px;
    height: auto;
    background-color: #fff;
    display: inline-block;
    margin: 10px;
    border: 2px solid gray;
  }*/



  .eventz{
    margin-top: 10px;
  }

  .inner {
      border:1px solid #33bbff;
       border-radius:5px;
        text-align:center;
        width:220px;
        min-height: 130px;
        margin:20px;
        padding:10px;
        float:left;
        cursor:pointer;
        position:relative;
       /* background: linear-gradient( #A9F1Df , #FFBBBB,#BFF098);*/

  }
  .inner2 {
      
      border:1px solid #ff8080;
       border-radius:5px;
        text-align:center;
        width:220px;
        min-height: 130px;
        margin:20px;
        padding:10px;
        float:left;
        cursor:pointer;
        position:relative;
       /* background: linear-gradient( #A9F1Df , #FFBBBB,#BFF098);*/

  }
   .inner2:hover{box-shadow:0px 0px 10px #ff8080;}
  .inner2:hover .menu{display:block !important;
    position:absolute;top:-4px;right:3px;}  
  .menu{
    font-size: 15px;
    color: #000;
  }
  .inner:hover{box-shadow:0px 0px 10px #33bbff;}
  .inner:hover .menu{display:block !important;
    position:absolute;top:-4px;right:3px;}  
  .menu{display:none !important;}


  
 
  
  /*.submenu {
    top:5px;left: 150px;
    font-size: 10px;
    width: 30px;
  }*/

  /* #loading {
   width: 100%;
   height: 100%;
   top: 0px;
   left: 0px;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}

#loading-content {
  position: absolute;
  top: 50%;
  left: 50%;
  text-align: center;
  z-index: 100;
}
.hide{
  display: none;
}
.modals
    {
        position: fixed;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.6;
        -moz-opacity: 0.8;
    }
    .center
    {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 130px;
        background-color: White;
        border-radius: 10px;
        filter: alpha(opacity=100);
        opacity: 1;
        -moz-opacity: 1;
    }
    .center img
    {
      position: relative;
        height: 100%;
        width: 100%;
        height: 128px;
        width: 128px; 
    } */


</style>


<?php 

//save to database
// $dex=0;
// //$sQuery = "SELECT * FROM events ";
//      //       $result = $db->query($sQuery);
//       //     while($row = mysqli_fetch_array($result))
//  $date = date("Y-m-d");
//  // echo " now:".$date;
// // $dateni = date('Y-m-d', strtotime('-1 day', strtotime($date)));
//  //echo " datepast:".$dateni;
//   echo "<div class='row'>";
 
// $sQuery = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and date >= '$date' order by date";
//             $result = $conn->query($sQuery);
//            while($row = mysqli_fetch_array($result))
// {
 
       
// echo '<div class="inner"> 
//             <a title="Edit/Delete"  class="btn menu" data-id="'.$row['fe_id'].'"><i class="fa fa-ellipsis-h"></i></a>
//             <a href="eventsliststudent.php?id='.$row['fe_id'].'" class="eventspanel" id='.$row['fe_id'].'>
//             <div class="eventz"><span style="font-size: 15x;  color: black;" >'.$row['Description'].'</span> <span class="code"></span></div> 
//             <div style="font-size: 11px; margin-top:5px;">Date: <span style="font-size: 12px; color: black;" ><strong>'.date('M j, Y',strtotime($row['date'])).'</strong></span> <span class="section"></span></div> 
//             <div style="font-size: 11px;">Time Start:<span style="font-size: 12px; color: black;" > '.$row['time'].' am</span> <span class="year"></span></div>
//           </a>
//           </div>
        
//           ';

// $dex++;
// }
// if($dex == 0){
//    echo "<h6 style='margin-left:20px;' class='text-info'> No Upcoming Event(s)</h6>";
// }
// echo "</div>";
// echo "<hr>";
// echo "<h6> Expired Events </h6>";
// echo "<div class='row'>";
//  $sQuery = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and date < '$date' order by date";
//             $result = $conn->query($sQuery);
//            while($row = mysqli_fetch_array($result))
// {
 
       
// echo '<div class="inner2"> 
//             <a title="Edit/Delete"  class="btn menu" data-id="'.$row['fe_id'].'"><i class="fa fa-ellipsis-h"></i></a>
//             <a href="eventsliststudent.php?id='.$row['fe_id'].'" class="eventspanel" id='.$row['fe_id'].'>
//             <div class="eventz"><span style="font-size: 15x;  color: black;" >'.$row['Description'].' '.$row['tap'].'</span> <span class="code"></span></div> 
//             <div style="font-size: 11px; margin-top:5px;">Date: <span style="font-size: 12px; color: black;" ><strong>'.date('M j, Y',strtotime($row['date'])).'</strong></span> <span class="section"></span></div> 
//             <div style="font-size: 11px;">Time Start:<span style="font-size: 12px; color: black;" > '.$row['time'].' am</span> <span class="year"></span></div>
//           </a>
//           </div>
//           ';

// $dex++;
// }

// echo "</div>";
 ?>
 
