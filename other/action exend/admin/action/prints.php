 
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
    <link rel="stylesheet" href="../../dist/jquery/print/print.min.css">
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link href="../bower_components/atatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="../../dist/jquery/print/print.min.js"></script>
    <script src="../../dist/jquery/jquery.min.js"></script>

   

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
<div class="table-responsive " id="myreportT" style="margin-top: 30px;">
       <table id="myTable-report" class="table table-bordered text-left" cellspacing="1" cellpadding="1">
       <a class="btn print">print</a>
    <thead class="text-left">
       <th>#</th>
        <th>IDNumber</th>
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
           // if(isset($_POST['year']) && isset($_POST['course']) )
           // {
               // echo 'hai';
               // $id = $_POST['getinfo'];
              // echo " alll id:";
                $year = $_SESSION['pyear'];
                $course = $_SESSION['pcourse'];
                $year = rtrim($year,',');
			    $course = strtolower(rtrim($course,','));

            //   echo $year."-";
            //   echo $course."-";
                //echo 'add sty';
                // $id = json_decode($_POST['delete_id'], true);
                //  print_r($year);
                //  print_r($course);
             //   $row = $student->print_student($year,$course);
                
              //   echo json_encode($row);
           // }

         //  if(!empty($year) && !empty($course)){


            if($course == 'all' && $year == 'all'){
                echo 'all all';
                $sql = "SELECT * FROM students".$_SESSION['sy_id']." ";
            }
        //    else if(!empty($course) && empty($year)){
        //         echo 'all course';
        //        // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE course IN (".$course.") ";
        //     }
        //     else if(!empty($year) && empty($course)){
        //         echo 'all year';
        //        // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE course IN (".$course.") ";
        //     }
            else if($course == 'all'){
                echo 'all course selected year';
                $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") order by year,firstname ";
            }
            else if($year == 'all'){
                echo 'all year selected course';
                $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE course IN (".$course.") order by year,firstname ";
            }
            else{
                echo 'selected course selected year';
                $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") AND course IN (".$course.") order by year,firstname ";
            }
            

        //     if(empty($course)){
        //         if($year == 'all') {
        //         echo ' All year and empty course';
        //         }
        //         else{
        //             echo ' selected year and empty course';
        //         }
        //        // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") ";
                
        //     }
        //     else if(empty($year)){
        //         if($course == 'all'){
        //             echo ' All course and empty year';
        //             }
        //             else{
        //                 echo ' Selected course and empty year';
        //             }
        //        // echo ' All course and empty year';
        //        // $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE LOWER(course) IN (".$course.") ";
            
        //    // else //if($year == 'all' && $course == 'all'){
                
        //        // $sql = "SELECT * FROM students".$_SESSION['sy_id']."  ";
        //     }
        //     else{
        //         echo 'ALL Course And All Year';
        //         //echo 'year,course';
        //         //$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE year IN (".$year.") AND LOWER(course) IN (".$course.") ";
        //     }
        // //   }
         //   //      $result = $this->conn->query($sql);
            //      if($result){
            //         if($result->num_rows > 0){
            //         while($row = $result->fetch_assoc()){
                    
            //             $data [] = $row;
            //         }
            //         return $data;
                
            //     }

            // } else { return 11;}
            
                    $count = 1;
                //    $var = 'sem'.$_SESSION["sem_id"];
                //     $sql = "SELECT *  FROM students".$_SESSION['sy_id']." where ".$var." = 1 ";
                     $query = $db->query($sql);
                     while($row = $query->fetch_assoc()){
                    // $data = $student->print_student($year, $course);
                    //  if(isset($_SESSION['sy_id'])){
                       
                       
                         //   if(!empty($data)){
                        //    foreach($data as $row){

                      ?>
                         <tr class="text-center"> 
                          <td><?php echo $count++.".";?></td>
                          <td><?php echo $row['id_number'];?></td>
                          <td><?php echo ucwords(strtolower($row['firstname']));?></td>
                          <td><?php echo ucwords(strtolower($row['middlename']));?></td>
                          <td><?php echo ucwords(strtolower($row['lastname']));?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo ucwords(strtolower($row['section']));?></td>
                          <td><?php echo ucwords(strtolower($row['course']));?></td>
                          <td><?php echo ucwords(strtolower($row['major']));?></td>
                        </tr>
                   <?php
                //    }
                //  }
             //   }
            }
                  ?>
                </tbody>
</table>
</div>


    <script type="text/javascript">
      //print();
     // printData();

function printData()
{
   var divToPrint=document.getElementById("myTable-report");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.focus();
   newWin.print();
   newWin.close();
}

$('.print').on('click',function(){
   // alert('click')
    printJS({ printable: 'myTable-report', type: 'html',header: 'PrintJS - Form Element Selection' })
})
    </script>
</body>
</html>



