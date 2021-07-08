<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ballot Position
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ballot Preview</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        // if(isset($_SESSION['error'])){
        //   echo "
        //     <div class='alert alert-danger alert-dismissible'>
        //       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //       <h4><i class='icon fa fa-warning'></i> Error!</h4>
        //       ".$_SESSION['error']."
        //     </div>
        //   ";
        //   unset($_SESSION['error']);
        // }
        // if(isset($_SESSION['success'])){
        //   echo "
        //     <div class='alert alert-success alert-dismissible'>
        //       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //       <h4><i class='icon fa fa-check'></i> Success!</h4>
        //       ".$_SESSION['success']."
        //     </div>
        //   ";
        //   unset($_SESSION['success']);
        // }
      ?>

     <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a  class="btn btn-primary btn-sm btn-flat printpop"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table  id="example1" class="table table-bordered">
                <thead>
                  <th>#</th>
                  <th>ID Number</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Year</th>

                  
                   <?php
                   
                    $sql = "SELECT * FROM new_feevent";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                        echo "<th>".$row['description']."</th>";

                        
                    } ?>
                    <!-- <th>action</th> -->
                </thead>
                <tbody>
                  <?php
                  // $savearray = array();

                  //  $sql = "SELECT * FROM fees";
                  //   $query = $db->query($sql);
                  //   $it = 0;
                  //   while($row2 = $query->fetch_assoc()){
                  //     $id =  $row2['id'];
                  //     $tw = $row2['amount'];
                  //       $savearray[$it] = $tw; 
                  //       $it++;   
                  //   }
                  //     $arrlenght = count($savearray);
                     $countz = 1;
                  //   $is = 0;
                   
                  
                    //$sql = "SELECT s.idnumber,  s.firstname ,s.lastname, s.year, s.major, f.des , f.amount FROM students s inner join feestatus fs on s.year = fs.yearlvl left join fees f on f.id = fs.fee_id";

                    //$sql = "SELECT s.idnumber,  s.firstname ,s.lastname, s.year, s.major, f.des , f.amount FROM students s left join feestatus fs on s.year = fs.yearlvl left join fees f on f.id = fs.fee_id where f.des = 'multa'";

                        // $sql = "SELECT f_year,f_major FROM fees";
                        // $query = $db->query($sql);
                        // while($row = $query->fetch_assoc())
                        // {
                        //   $amountfee = $row['f_year'];
                        //   $idfee = $row['f_major'];
                        // }
                        // $strings = "1,2,3,4,5";
                        // $pieces = explode(',',$strings);
                        // for($i = 0; $i < count($pieces) ; $i++)
                        // {
                        //   echo $pieces[$i];
                        // } 
                        // $strings = "Proramming,Networking";
                        // $pieces = explode(',',$strings);
                        // for($i = 0; $i < count($pieces); $i++)
                        // {
                        //   echo $pieces[$i];
                        // } 







                     //SELECT s.firstname , s.lastname, c.payamount from students s inner join chargecost c



                      $amountfee = array();
                      $idfee = 0;
                      $rowindex = 0;


                       $eventida = array();
                       $feeida = array();
                       $eventamount = array();
                       $feeamount = array();
                       $eida = 0;$fida = 0;
                    //    $sql = "SELECT * FROM events order by id";
                    // $query = $db->query($sql);
                    // while($row = $query->fetch_assoc()){
                    //   $eventida[$eida] = $row['id'];
                    //   $eventamount[$eida] = $row['fines'] * $row['num'];
                    //   $eida++;
                    // }
                     $sql = "SELECT * FROM new_feevent where type = 2 order by id";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                      $feeida[$fida] = $row['id'];
                      $feeamount[$fida] = $row['amount'];
                      $fida++;
                    }


                    
                     $sql = "SELECT * FROM new_feevent where type = 1 order by id";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                      $eventida[$eida] = $row['id'];
                      $eventamount[$eida] = $row['amount'];
                      $eida++;
                    }




                    $event_amount = array();
                    $event_year = array();
                    $event_studentid = array();
                    
                    $event_amount_index = 0;
                     $sql10 = "SELECT distinct(nf.id), nf.description , fs.event_id,fs.yearlevel, nf.amount , s.lastname , s.year FROM new_feevent nf left join eventstatus fs on nf.id = fs.event_id right join students s on s.year = fs.yearlevel where nf.type = 1";
                     $query10 = $db->query($sql10);
                    while($row10 = $query10->fetch_assoc())
                     {
                        if(!is_null($row10['amount']))
                        {
                          $event_amount[$event_amount_index] = $row10['amount'];
                          $event_year[$event_amount_index] = $row10['yearlevel'];
                          $event_amount_index++;
                        }
                      }
                   

                    $fee_amount = array();
                    $fee_year = array();
                    $fee_studentid = array();
                    $fee_amount_index = 0;
                    $fee_ids = array();
                    $student_id = array();
                    
                    $sql20 = "SELECT * FROM new_feevent nf left join feestatus fs on nf.id = fs.fee_id right join students s on s.year = fs.yearlvl where type = 2";
                      $query20 = $db->query($sql20);
                    while($row20 = $query20->fetch_assoc())
                    {
                       if(!is_null($row20['amount']))
                       {
                          $fee_ids[$fee_amount_index] = $row20['id'];
                          $fee_amount[$fee_amount_index] = $row20['amount'];
                          $fee_year[$fee_amount_index] = $row20['yearlvl'];
                          $student_id[$fee_amount_index] = $row20['student_id'];
                          $fee_amount_index++;
                        }
                    }
                    

                    // for($i = 0;$i < count($fee_year); $i++){
                    //   echo " ".$fee_year[$i];echo " ".$fee_amount[$i];
                    //   echo " id ".$fee_ids[$i];
                    // }








                    // for($f=0;$f<count($eventida);$f++){
                    //   echo " 1 ".$eventida[$f];
                    // }
                    //  for($e=0;$e<count($feeida);$e++){
                    //   echo " 2 ".$feeida[$e];
                    // }



                    //   $sql = "SELECT * FROM chargecost order by id";
                    // $query = $db->query($sql);
                    // while($row = $query->fetch_assoc()){
                    //       $amountfee[$rowindex++] = $row['payamount'];
                    //       $idfee = $row['id'];}
                 //  $sql1 = "SELECT * FROM masterlist";
                  //  $sql = "SELECT s.idnumber,  s.firstname ,s.lastname, s.year, s.major , ml.fee20  FROM students s left join masterlist ml on s.id = ml.student_id";
                       
                    // $sql = "SELECT * FROM students s left join masterlist ml on s.id = ml.student_id";
                         
                       //   $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3, es.yearlevel , es.major FROM students s inner join eventstatus es on s.year = es.yearlevel and s.major = es.major left join activities_fines ef on s.id = ef.afstudent_id and ef.eventfee_id = es.event_id";


                    $indexsod = 0;
                          $sql = "SELECT *  FROM students s left join activities_fines a on a.afstudent_id = s.student_id";
                   // $query = $db->query($sql);
                    // $sql = "SELECT * FROM new_feevent nf left join feestatus fs on nf.id = fs.fee_id right join students s on s.year = fs.yearlvl where type = 2";
                       $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){

                      ?>
                        <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['idnumber'];?></td>
                          <td><?php echo$row['firstname'];?></td>
                          <td><?php echo$row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          

                          
                         
                         
                        </tr>
                     
                   <?php
                    $indexsod++;        
                    }   // end whileloop
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </section>

    
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php  include 'includes/scripts.php'; ?>
<script>
  
  $(document).on('click', '.printpop', function(e){
    e.preventDefault();
    alert('hello');
   /// window.open('printsample.php?prnt=82cc75faaf7cda1','name','width=600,height=400,toolbar=0');
  });
$(function(){
  fetch();

  $(document).on('click', '.reset', function(e){
    e.preventDefault();
    var desc = $(this).data('desc');
    $('.'+desc).iCheck('uncheck');
  });

  $(document).on('click', '.moveup', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#'+id).animate({
      'marginTop' : "-300px"
    });
    $.ajax({
      type: 'POST',
      url: 'ballot_up.php',
      data:{id:id},
      dataType: 'json',
      success: function(response){
        if(!response.error){
          fetch();
        }
      }
    });
  });

  $(document).on('click', '.movedown', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#'+id).animate({
      'marginTop' : "+300px"
    });
    $.ajax({
      type: 'POST',
      url: 'ballot_down.php',
      data:{id:id},
      dataType: 'json',
      success: function(response){
        if(!response.error){
          fetch();
        }
      }
    });
  });

});

function fetch(){
  $.ajax({
    type: 'POST',
    url: 'ballot_fetch.php',
    dataType: 'json',
    success: function(response){
      $('#content').html(response).iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
    }
  });
}
</script>
</body>
</html>


<table id="myTable-report" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
       <th>#</th>
        <th>ID Number</th>
        <th>Full Name</th>
        <th>Year/Major</th>
                   <?php
                   
                    $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']."  ";
                    $query = $db->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                        echo "<th>".$row['Description']."</th>";

                        
                    } ?>
                    <th>SubTotal</th>
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
                    $query = $db->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $eventall_id[$event_index] = $row['fe_id'];
                      $eventall_amount[$event_index] = $row['amount'];
                      $event_index++;
                    }




                    $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                    $query = $db->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $eventida[$eida] = $row['fe_id'];
                      $eventamount[$eida] = $row['fines'] * $row['tap'];
                      $eida++;
                    }
                     $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id";
                    $query = $db->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $feeida[$fida] = $row['fe_id'];
                      $feeamount[$fida] = $row['amount'];
                      $fida++;
                    }

                    
                  $total = 0;
                  $grosstotal = 0;
                    $var = 'sem'.$_SESSION["sem_id"];
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1  order by s.year , firstname ";
                    $query = $db->conn->query($sql);
                    while($row = $query->fetch_assoc()){

                      ?>
                         <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                          <td><?php echo $row['year'].'-'.$row['major'] ;?></td>
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
                   $grosstotal += $total; 
                   $total = 0;
                    }
                  ?>
                  <tr>
                  <td colspan="<?php echo ($event_index + 4); ?>" >Gross Total</td>
                  <td style="text-align: center; font-weight: 800; "> &#8369 <?php echo number_format($grosstotal,2);?></td>
                </tr>
                </tbody>
                 
</table>
