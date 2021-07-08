<?php 
  include 'includes/session.php';
if(!isset($_SESSION['admin_id']))
 {
  header('location: index.php');
 } 
 ?>
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
        Students Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              <a href="events.php" class="btn btn-default btn-sm"><i class="fa fa-minus"></i> Back</a>
              <a href="#attend"  data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> attendance</a>
              <a href="#actived" data-toggle="modal" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> activate</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th width="1%">#</th>
                  <th>ID Number</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th width="2%">Year</th>
                  <th width="2%">Section</th>
                  <th>Major</th>
                  <th>Course</th>
                 
                  

                  <?php 

                 //  $eventid = $_GET['id'];


                  //  $sql2 = "SELECT major FROM eventstatus where event_id = '$eventid'";
                  //   $query2 = $db->query($sql2);
                  //   $row2 = $query2->fetch_assoc();
                  //   $major = $row2['major'];











                    //  $sql1 = "SELECT num FROM events where id = '$eventid'";
                    // $query1 = $db->query($sql1);
                    // $row1 = $query1->fetch_assoc();
                    // $pon = $row1['num'];


                    $sql1 = "SELECT num FROM new_feevent where id = '25'";
                    $query1 = $db->query($sql1);
                    $row1 = $query1->fetch_assoc();
                    $pon = $row1['num'];




                    
                    //echo "remainder: ".$p;
                       for($t = 0; $t < $pon; $t++)
                       {
                        if($t % 2 == 0)
                        {
                         // echo "<th>Time In</th>";
                          // $sql1 = "ALTER TABLE students add Timein decimal(10,2)";
                          // $query1 = $db->query($sql1);
                        }
                        else
                         {
                         // echo "<th>Time Out</th>";
                          // $sql1 = "ALTER TABLE students add Timeout decimal(10,2)";
                         // $query1 = $db->query($sql1);
                          
                         }
                        
                       }


                        
                    
                   ?>
                  <!--  <th>Total Fines</th> -->
                </thead>
                <tbody style="font-size: 12px;">
                  <?php 


                $db  = mysqli_connect('localhost','root','', 'test_login');




                //     $eventid = $_GET['id'];

                    // $sql1 = "SELECT * FROM events where id = '$eventid'";
                    // $query1 = $db->query($sql1);
                    // $row1 = $query1->fetch_assoc();
                    // $pon = $row1['num'];
                    // $finesamount = $row1['fines'];





                  //   $dash = "-";
                  // //  $year = array();
                  //   $index=0;
                  //   $sqles = "SELECT * FROM `eventstatus` where event_id = '$eventid' ";
                  //   $queryes = $db->query($sqles);
                  //   while($rowes = $queryes->fetch_assoc())
                  //   {
                  //     $yearar = $rowes['yearlevel'];
                  //     $year[$index]=$yearar;
                  //     //echo "year01: ".$yearar;
                  //     $index++;
                  //   }
                   // echo "count array :".count($year);
                    // for($i = 0; $i < count($year); $i++ )
                    // {
                    //   echo "year: ".$year[$i];

                    // }
                    
                    // SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.year FROM students s left join eventfine e ON s.id = e.student_id left JOIN eventstatus es on s.year = es.year where e.event_id = 1



                    // SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.year FROM students s left join eventfine e ON s.id = e.student_id left JOIN eventstatus es on s.year = es.year where e.event_id = 1 and s.year not in (select year from eventstatus where event_id = 1 )

                    $is = 0;
                    $arraycount = 0;
                    $countz = 1;

                    // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3 FROM students s left join eventfine e ON s.id = e.student_id and e.event_id = '$eventid'";

                   // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.year FROM students s left join eventfine e ON s.id = e.student_id left JOIN eventstatus es on s.year = es.year where e.event_id = '$eventid' and s.year not in (select year from eventstatus where event_id = '$eventid' )";



                    //try this
                    //SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.yearlevel FROM students s inner join eventfine e ON s.id = e.student_id and e.event_id = 1 right JOIN eventstatus es on s.year = es.yearlevel









                  // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3, es.yearlevel FROM students s left join eventfine e ON s.id = e.student_id and e.event_id = '$eventid' left JOIN eventstatus es on s.year = es.yearlevel ";



                   // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , es.yearlevel FROM students s left join eventstatus es on s.year = es.yearlevel where event_id = '$eventid'";
                    //$query = $db->query($sql);










                 //   $foundcontent = false;




                     // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join eventstatus es on s.year = es.yearlevel left join eventfine ef on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid' ";


                    // this area is to filter by year and major 


                    //$sqles = "SELECT * FROM new_feevent where id = '$eventid' ";
                    // $sqles = "SELECT * FROM eventstatus where event_id = '$eventid' ";
                    // $queryes = $db->query($sqles);
                    // while($rowes = $queryes->fetch_assoc());
                    // {

                    // }
                    // $yearlvl = $rowes['yearlevel'];
                    // $majors = $rowes['major'];

                    //$year = explode(',',$yearlvl);
                   // $major = explode(',',$majors);

                    




                 //   $fg = false;




                   // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join eventstatus es on s.year = es.yearlevel left join eventfine ef on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid' and s.major = '$major' ";

                    //$sql ="SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s left join new_feevent nf  on s.id = ef.student_id left join eventfine ef  on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid' and s.major = '$major'";

                   // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major FROM students s left join new_feevent nf  on s.year in (".$yearlvl.") left join eventfine ef on s.id = ef.student_id  and ef.event_id = nf.id where nf.id =  '$eventid' and s.major in ('$majors') ";



                    $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major,s.course, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3, es.yearlevel , es.major FROM students s inner join eventstatus es on s.year = es.yearlevel and s.major = es.major left join eventfine ef on s.student_id = ef.student_id and ef.event_id = es.event_id where es.event_id =  25 ";
                    
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    {   
                    //  $fg = true;
                      ?>
                      <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['idnumber'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo $row['section'];?></td>
                          <td><?php echo $row['major'];?></td>
                          <td><?php echo $row['course'];?></td>
                          <td><?php// echo $row['Timein1'];?></td>
                          

                          </tr>
                            
                 <?php    } ?>





                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php  include 'includes/voters_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'voters_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
