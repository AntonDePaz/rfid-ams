 
<?php include '../includes/conn.php'; 
// include '../model/student.php';
//$student = new student();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Supreme Student Council</title>

    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link href="../bower_components/atatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">


</head>
<body style="font-size: 10px;" >


<center>
    <!-- <div class="row text-center" style="left: 40%; width: 300px;height: 50px; position: absolute; margin:10px 0px 50px 40px;"> -->
      <img width="34" height="34" src="../../images/slsulogo.png" class="img-circle" alt="Admin image">
       <span style=" color: #000; font-size: 10px; " >Southern Leyte State University - Main Campus  </span><img width="30" height="30" src="../../images/ssclogo.jpg" class="img-circle" alt="Admin image">
     <!-- <span style="position: relative; color: #000; font-size: 10px; bottom: 10px; " >Supreme Student Council</span> -->
     <div style=" color: #000; font-size: 10px; margin-top: -10px; " >Supreme Student Council</div>
      <h3>Students MasterList</h3>
    <!-- </div> -->
</center>

<br />
<div class="table-responsive" style="margin-top: 30px;">
       <table id="myTable-report" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
       <th>#</th>
        <th>ID Number</th>
        <th>Firstname</th>
        <th>Middle</th>
        <th>Lastname</th>
        <th>Year</th>
        <th>Section</th>
        <th>Course</th>
        <th>Major</th>
    </thead>
    <tbody>
            <?php
                    $count = 1;
                   $var = 'sem'.$_SESSION["sem_id"];
                    $sql = "SELECT *  FROM students".$_SESSION['sy_id']." where ".$var." = 1 ";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                    // $data = $student->showall_student();
                     //if(isset($_SESSION['sy_id'])){
                       
                       
                         //   if(!empty($data)){
                        //    foreach($data as $row){

                      ?>
                         <tr>
                          <td><?php echo $count++;?></td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['middlename'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo $row['section'];?></td>
                          <td><?php echo $row['course'];?></td>
                          <td><?php echo $row['major'];?></td>
                        </tr>
                   <?php
                //    }
                //  }
                }
                  ?>
                </tbody>
</table>
</div>


    <script type="text/javascript">
       print();
    </script>
</body>
</html>

