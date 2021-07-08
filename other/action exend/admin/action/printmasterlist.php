 
<?php include '../includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php 



//require_once('../class/Item.php');
if(isset($_GET['prnt'])){
  // $choice = $_GET['choice'];

   //$reports = $item->item_report($choice);
    //echo '<pre>';
    // print_r($reports);
    //echo '</pre>';

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>Supreme Student Council</title>

    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link href="../bower_components/atatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">


</head>
<body id="fontSize">


<center>
    <img  src="..\..\images\logobg.png" class="img-circle pull-left" width="50">
    <h2>Master List</h2>
</center>

<br />
<div class="table-responsive">
       <table id="myTable-report" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
       <th>#</th>
        <th>ID Number</th>
        <th>Full Name</th>
        <th>Year/Major</th>
                   <?php
                   
                    $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']."  ";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                        echo "<th>".$row['Description']."</th>";

                        
                    } ?>
                    <th>Gross Total</th>
    </thead>
    <tbody>
            <?php
                     
                     $countz = 1;
                

                      $amountfee = array();
                      $idfee = 0;
                      $rowindex = 0;


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
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $eventall_id[$event_index] = $row['fe_id'];
                      $eventall_amount[$event_index] = $row['amount'];
                      $event_index++;
                    }




                    $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $eventida[$eida] = $row['fe_id'];
                      $eventamount[$eida] = $row['fines'] * $row['tap'];
                      $eida++;
                    }
                     $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $feeida[$fida] = $row['fe_id'];
                      $feeamount[$fida] = $row['amount'];
                      $fida++;
                    }

                    
                  $total = 0;
                  $grosstotal = 0;
                    $var = 'sem'.$_SESSION["sem_id"];
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1  order by s.year , firstname ";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                      ?>
                         <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                          <td><?php echo$row['year'].'-'.$row['major'] ;?></td>
                         <!--  <td><?php// echo ucwords(strtolower($row['course']));?></td> -->
                          <?php 
                          for($i = 0; $i < count($eventall_id); $i++)
                          {
                            if($row['pay'.trim($eventall_id[$i]).''] > 0)
                            {
                            echo "<td> &#8369 ".$row['pay'.trim($eventall_id[$i]).'']."</td>";
                               $total += number_format($row['pay'.trim($eventall_id[$i]).''],2);
                          
                             }
                             else
                             {
                                 echo "<td> &#8369 &nbsp -- </td>";
                             }
                             
                             // $total += number_format($row['pay'.trim($eventall_id[$i]).''],2);
                             
                          }

                           //$grosstotal += $total;
                              


                           ?>




                          
                          <td class="bold"> &#8369 <?php echo number_format($total,2);?></td>
                        </tr>

                   <?php
                   $total = 0;
                    }
                  ?>
                </tbody>
</table>
</div>


    
</body>
</html>
<?php  include '../includes/scripts.php'; ?>
<!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->



<?php 

}
 ?>
<script type="text/javascript">
    $(document).ready(function() {
    //  var countevent = '<?php// echo $event_index; ?>'; 
    // // alert(''+countevent);
    // var columncount = 5 + countevent;
    // var size = 0;
    // if(columncount == 11){
    //   size = 11;
    // }else if(columncount == 12){
    //   size = 10;
    // }else if(columncount == 13){
    //   size = 9;
    // }else if(columncount == 14){
    //   size = 8;
    // }else if(columncount == 15){
    //   size = 7;
    // }else if(columncount == 16){
    //   size = 6;
    // }else if(columncount == 17){
    //   size = 5;
    // }else if(columncount == 18){
    //   size = 4;
    // }else if(columncount == 19){
    //   size = 3;
    // }else if(columncount == 20){
    //   size = 2;
    // }else if(columncount == 21){
    //   size = 1;
    // }

    //$('#fontSize').css('font-size',12);
     //  print();
     });
    </script>
