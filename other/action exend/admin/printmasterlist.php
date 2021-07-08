 
<?php include 'model/connection.php'; $db = new Database(); ?>
<!DOCTYPE html>
<html lang="en">
<?php 

if(isset($_SESSION['sy_id']) && isset($_SESSION['pyear']) && isset($_SESSION['pcourse'])){
  


//require_once('../class/Item.php');
//if(isset($_GET['prnt'])){
  // $choice = $_GET['choice'];

   //$reports = $item->item_report($choice);
    //echo '<pre>';
    // print_r($reports);
    //echo '</pre>';

?>
<head>

     <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="../dist/jquery/print/print.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    
    

    <script src="../dist/jquery/print/print.min.js"></script>

</head>
<body id="fontSize">


<center>
    <!-- <div class="row text-center" style="left: 40%; width: 300px;height: 50px; position: absolute; margin:10px 0px 50px 40px;"> -->
      <img width="34" height="34" src="../images/slsulogo.png" class="img-circle" alt="Admin image">
       <span style=" color: #000; font-size: 10px; " >Southern Leyte State University - Main Campus  </span><img width="30" height="30" src="../images/ssclogo.jpg" class="img-circle" alt="Admin image">
     <!-- <span style="position: relative; color: #000; font-size: 10px; bottom: 10px; " >Supreme Student Council</span> -->
     <div style=" color: #000; font-size: 10px; margin-top: -10px; " >Supreme Student Council</div>
      <h4>Students MasterList</h4>
    <!-- </div> -->
</center>

<br />
<div class="table-responsive">
<table id="myTable-report" class="table table-striped table-bordered">
                <thead>
                  <th>#</th>
                  <th>ID Number</th>
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


                  $year = $_SESSION['pyear'];
                  $course = $_SESSION['pcourse'];
                 $year = rtrim($year,',');
                 $course = strtolower(rtrim($course,','));
                    
                 

                    
                   
                


                    $total = 0;
                   $var = 'sem'.$_SESSION["sem_id"];



                   if($course == 'all' && $year == 'all'){
                    //echo 'all all';
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1  order by s.year , firstname ";
                    //$sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
                  }
                  else if($course == 'all'){
                    //echo 'all course selected year';
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1 AND s.year IN (".$year.")   order by s.year , firstname ";
                   // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") ";
                  }
                  else if($year == 'all'){
                    //echo 'all year selected course';
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1 AND s.course IN (".$course.")   order by s.year , firstname ";
                   // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE course IN (".$course.") ";
                  }
                  else{
                    //echo 'selected course selected year';
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1 AND s.year IN (".$year.") AND s.course IN (".$course.")   order by s.year , firstname ";
                   // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") AND course IN (".$course.")   ";
                  }
                   $query = $db->conn->query($sql);
                   if($query){
                   while($row = $query->fetch_assoc()){
                    //$data = $masterlist->view_events103();
                   // if(!empty($data)){
                    //  foreach($data as $row){
                        // if($row[$var] == 1){
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
                   <tr style="font-weight: 800; background-color: #e6ffff;" >
                  <td colspan="<?php echo $countcolumn; ?>" >Gross Total</td>
                  <td style="text-align: center; "> &#8369 <?php echo number_format($grosstotal,2);?></td>
                </tr>
                  
                </tbody>
               
              </table>
       
</div>


    
</body>
<?php } else{ header('location: logout.php'); } ?>
</html>
<?php  include 'includes/scripts.php'; ?>
<!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->



<?php 

//  }
 ?>
<script type="text/javascript">
    $(document).ready(function() {

     // printJS({ printable:'myTable-report',type:'html'});
   var countevent =  parseInt('<?php echo $event_index; ?>'); 
    var columncount = (5 + countevent);
     var size = 0;
    // if(columncount > 5 && columncount < 14){
    //   size = 12;
    // }
    // else if(columncount == 14){
    //   size = 11;
    // }else if(columncount == 15 || columncount == 16){
    //   size = 10;
    // }else if(columncount == 17 || columncount == 18){
    //   size = 9;
    // }else if(columncount == 19 || columncount == 20){
    //   size = 8;
    // }else if(columncount >= 21 && columncount <= 23){
    //   size = 7;
    // }else if(columncount >= 24 && columncount <= 27){
    //   size = 6;
    // }else if(columncount >= 27 && columncount <= 33){
    //   size = 5;
    // }else if(columncount >= 34 && columncount <= 41){
    //   size = 4;
    // }else if(columncount >= 42 && columncount <= 51){
    //   size = 3;
    // }else if(columncount >= 52 && columncount <= 71){
    //   size = 2;
    // }else if(columncount >= 72){
    //   size = 1;
    // }
    if(columncount > 5 && columncount < 12){
      size = 12;
    }
    else if(columncount == 13){
      size = 11;
    }else if(columncount == 14){
      size = 10;
    }else if(columncount == 15 || columncount == 16){
      size = 9;
    }else if(columncount == 17 || columncount == 18){
      size = 8;
    }else if(columncount == 19 && columncount == 20){
      size = 7;
    }else if(columncount >= 21 && columncount <= 25){
      size = 6;
    }else if(columncount >= 26 && columncount <= 30){
      size = 5;
    }else if(columncount >= 31 && columncount <= 38){
      size = 4;
    }else if(columncount >= 39 && columncount <= 48){
      size = 3;
    }else if(columncount >= 49 && columncount <= 65){
      size = 2;
    }else if(columncount >= 65){
      size = 1;
    }
    
   
   //alert(""+columncount+"-"+size);
    $('#fontSize').css('font-size',size);
      print();
     });
    </script>
