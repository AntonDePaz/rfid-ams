<?php 
  include 'includes/session.php';
  include 'model/connection.php';
  include 'model/masterlist.php';
  include 'model/category.php';
// if(!isset($_SESSION['admin_id']))
//  {
//   header('location: index.php');
//  } 
//  else{ $masterlist = new masterlist(); $category = new category();  }
$db = new Database(); 
 ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">
  td {
    font-size: 12px;
  }
  .bold{
    background-color: #e6ffff;;
    font-weight: 700;
    text-align: center;
  }
   #print-btn {
   border:1px solid #fff;
    margin-left: 5px;
    color: #000;
    background-color: transparent;
  }
  #print-btn:hover {
  border:1px solid green;
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
       <i class="fa fa-list"></i> Master List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     <div class="row">
      <?php if(isset($_SESSION['sy_id'])){ ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->
             <!--  <p class="pull-left"><?php// echo "sy".$_SESSION['sy_id'].""; ?></p>
              <p class="pull-left"><?php// echo "sem".$_SESSION['sem_id']; ?></p> -->
              <a class="btn btn-success btn-xs pull-right" id="print-btn"><i class="fa fa-print"></i> Print Report</a>
            </div>
            <div class="box-body" id="printhis" style="overflow-y: scroll;">
              <table id="example1" class="table table-striped table-bordered">
                <thead>
                  <th>no.</th>
                  <th>Idnumber</th>
                  <th>Fullname</th>
                  <th>Year/Major</th>
                  <!-- <th>Course</th> -->

                  
                   <?php
                   
                    $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."";
                    $query = $db->conn->query($sql);
                   while($row = $query->fetch_assoc()){
                    // $data = $masterlist->view_events();
                     //if(!empty($data)){
                     //  foreach($data as $row){
                        echo "<th>".$row['Description']."</th>";
                     //  }
                        
                    } ?>
                    <th>&nbsp;Total_Amount&nbsp;</th>
                </thead>
                <tbody>
                  <?php
                 
                     $countz = 1;
                     $grosstotal = 0;
                

                      $amountfee = array();
                      $idfee = 0;
                      $rowindex = 0;

                        $countcolumn = 4;
                       $eventida = array();
                       $feeida = array();
                       $eventamount = array();
                       $feeamount = array();
                       $eida = 0;$fida = 0;

                       $eventall_id = array();
                       $eventall_amount = array();
                       $event_index = 0;
                       //$event_amount = 0;
                       //type 1 is event type
                       $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                   $query = $db->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      //$data = $masterlist->view_events101();
                     // if(!empty($data)){
                      //  foreach($data as $row){
                      $eventall_id[$event_index] = $row['fe_id'];
                      $eventall_amount[$event_index] = number_format($row['amount'],2);
                      $event_index++;
                      $countcolumn++;
                      //  }
                    }




                   $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                   $query = $db->conn->query($sql);
                   while($row = $query->fetch_assoc()){
                     // $data = $masterlist->view_events102();
                     // if(!empty($data)){
                     //   foreach($data as $row){
                      $eventida[$eida] = $row['fe_id'];
                      $eventamount[$eida] = $row['fines'] * $row['tap'];
                      $eida++;
                      //  }
                    }
                    $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id";
                   $query = $db->conn->query($sql);
                   while($row = $query->fetch_assoc()){
                   // $data = $masterlist->view_events103();
                   // if(!empty($data)){
                     // foreach($data as $row){
                      $feeida[$fida] = $row['fe_id'];
                      $feeamount[$fida] = $row['amount'];
                      $fida++;
                  // }
                  }
                    $total = 0;
                   $var = 'sem'.$_SESSION["sem_id"];
                   $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1  order by s.year , firstname ";
                   $query = $db->conn->query($sql);
                   if($query){
                   while($row = $query->fetch_assoc()){
                    //$data = $masterlist->view_events103();
                   // if(!empty($data)){
                    //  foreach($data as $row){
                        // if($row[$var] == 1){
                      ?>
                        <tr>
                          <td><?php echo number_format($countz++);?></td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                          <td><?php echo$row['year'].'-'.$row['major'] ;?></td>
                         <!--  <td><?php// echo ucwords(strtolower($row['course']));?></td> -->
                          <?php 
                          for($i = 0; $i < count($eventall_id); $i++)
                          {
                            if($row['pay'.trim($eventall_id[$i]).''] > 0)
                            {
                            echo "<td> &#8369 ".number_format($row['pay'.trim($eventall_id[$i]).''],2)."</td>";
                              $total += $row['pay'.trim($eventall_id[$i]).''];
                          
                             }
                             else
                             {
                                 echo "<td> &#8369 &nbsp -- </td>";
                             }


                          }



                           $grosstotal += $total;

                           ?>




                          
                          <td style="cursor:pointer;" class="bold" data-id="<?php echo $row['firstname']." ".$row['lastname'];?>"> &#8369 <?php echo number_format($total,2);?></td>
                        </tr>
                     
                   <?php
                      $total = 0;
                  //  }
               // }
              }
            }
                    //$is++;
                  ?>
                  
                </tbody>
                <tfoot style="font-weight: 800; background-color: #e6ffff;" >
                  <td colspan="<?php echo $countcolumn; ?>" >Gross Total</td>
                  <td style="text-align: center; "> &#8369 <?php echo number_format($grosstotal,2);?></td>
                </tfoot>
              </table>

            </div>
          </div>

        </div>
      <?php } ?>
      </div>
      
    </section>

    
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php  include 'includes/scripts.php'; ?>
<?php  include 'includes/students_modal.php'; ?>
<script src="assets/masterlist.js"></script>
</body>
</html>
<script type="text/javascript">
  
</script>


