<?php 


$db  = mysqli_connect('localhost','root','', 'test_login');




   // $number = count($_POST['year']);

   // if($number > 0)
   // {

   // 	for($i = 0; $i < $number; $i++)
   //  {

   // 		if(trim($_POST['year'][$i])  != '')
   // 		{
   // 			$year = $_POST['year'][$i];
   // 			$major = $_POST['major'][$i];
   // 			//$section = $_POST['section'][$i];
   // 			//$event_id = "1";
   // 		//	$query = "INSERT INTO `feestatus`(`yearlvl`, `major`, `fee_id`) VALUES ('$year','$major','$fee_id')";
   //         //   mysqli_query($db, $query);

   // 		}

   // 	}


   	

   // }
   // else {

   // 	//	$query = "INSERT INTO `feestatus`(`yearlvl`, `major`, `fee_id`) VALUES ('all','all','$fee_id')";
   //         //   mysqli_query($db, $query);

   // 	}




 $description = $_POST['description'];
 $amount = $_POST['amount'];
 $today = date("m/d/y");
 
 //$yl = "1,2,3,4,5";
 //$pn = "Programming,Networking";


 
 //$query = "INSERT INTO `fees`(`des`, `amount`, `semester`) VALUES ('$description','$amount','1')";
   //mysqli_query($db, $query);



   //$query = "INSERT INTO `chargecost`( `payamount`,`descriptions`) VALUES ('$amount','$description')";
   ///mysqli_query($db, $query);



  $query = "INSERT INTO `new_feevent`(`description`, `date`, `amount`, `type`) VALUES ('$description','$today','$amount','2')";
   mysqli_query($db, $query);












$ev_id = 0;
$sQuery = "SELECT id FROM new_feevent order by id ";
$result = $db->query($sQuery);
while($row = mysqli_fetch_array($result))
{
  $fees_id = $row['id'];
}

   $number = count($_POST['year']);
   $cmajor = count($_POST['major']);

   //echo ' number year: '.$number;
    //echo ' number major: '.$cmajor;

   if($number > 1 && $number != 1)
   {
    //echo"number is greater than 0";
      $vr[0] = "Programming";
      $vr[1] ="Networking";
    for($i = 0; $i < $number; $i++)
    {

      if(trim($_POST['year'][$i])  != '')
      {
        $year = $_POST['year'][$i];
        $major = $_POST['major'][$i];
        //$section = $_POST['section'][$i];

        //  echo ' major: '.$major;
          if($major == '1')
          {
          //  echo " major == 1";
              for($x = 0;$x < 2;$x++) // 2 is number of majors 
              {
               // echo " major == 1 loop ".$vr[$x];
                $query = "INSERT INTO `feestatus`( `yearlvl`, `major`, `fee_id`) VALUES ('$year','$vr[$x]','$fees_id')";
                  mysqli_query($db, $query);
              }
            }

        else {
      
        $query = "INSERT INTO `feestatus`( `yearlvl`, `major`,  `fee_id`) VALUES ('$year','$major','$fees_id')";
          mysqli_query($db, $query);
          
      }
      }

    }


    

   }
   else
    {
     // echo"numb: ".$_POST['major'];
      
      for($s=0;$s< count($_POST['major']);$s++)
      {
          if($_POST['major'][$s] == "1")
        {
              //echo 'all major';
              $v[0] = "Programming";
              $v[1] ="Networking";
              for($a = 1;$a < 6; $a++)
              {
                 
                  for($b = 0; $b < 2; $b++)
                  {
                  $query = "INSERT INTO `feestatus`( `yearlvl`, `major`, `fee_id`) VALUES ('$a','$v[$b]','$fees_id')";
                     mysqli_query($db, $query);




                  }
              }

        }
        else {
         // echo " major is: ".$_POST['major'][$s];
            //  $v[0] = "Programming";
             // $v[1] ="Networking";
              $getmajor = $_POST['major'][$s];
              for($a = 1;$a < 6; $a++)
              {
                 
                  
                  $query = "INSERT INTO `feestatus`( `yearlvl`, `major`, `fee_id`) VALUES ('$a','$getmajor','$fees_id')";
                    mysqli_query($db, $query);

                  
              }

        }

      }
      



      $query = "INSERT INTO `eventstatus`( `yearlevel`, `major`, `event_id`) VALUES ('1,2,3,4,5','Programming,Networking','$fees_id')";
           mysqli_query($db, $query);

    }









      $sq = "ALTER TABLE activities_fines ADD column a".$fees_id." decimal(10,2)";
    mysqli_query($db, $sq);























$ev_id = 0;
$sQuery = "SELECT id FROM new_feevent order by id ";
$result = $db->query($sQuery);
while($row = mysqli_fetch_array($result))
{
  $fees_id = $row['id'];
}


$studentyeararray = array();
$studentmajorarray = array();
$studentyearindex = 0;
$student_idm = "";
$student_idmerge = "";


$query = "SELECT nf.id, nf.description, fs.fee_id, fs.yearlvl, fs.major, nf.amount, s.student_id, s.year, s.firstname, s.year, s.major
FROM new_feevent nf
INNER JOIN feestatus fs ON fs.fee_id = '$fees_id'
AND nf.id = '$fees_id'
INNER JOIN students s ON s.year = fs.yearlvl
AND s.major = fs.major
";
$result = $db->query($query);
while($row = mysqli_fetch_array($result))
{  
  //$studentyeararray[$studentyearindex] = $row['yearlvl'];
 // $studentmajorarray[$studentyearindex] = $row['major'];
 // $studentyearindex++;
   //echo " id ".$row['student_id'];

    $student_idm = $row['student_id'].',';
    $student_idmerge .= $student_idm;
}

$r = rtrim($student_idmerge,',');
$rt = $r;




    $sQuery = "SELECT * FROM students where student_id not in (".$rt.")";
    $result = $db->query($sQuery);
    while($row = mysqli_fetch_array($result))
    {  
     
              echo " + ".$row['student_id'];
               $student_id = $row['student_id'];

               if($student_id != 0){
               $found1 = false;
              
                $sql = "SELECT * FROM `activities_fines`";
                  $query = $db->query($sql);
              while($row = $query->fetch_assoc())
             {
              if($row['afstudent_id'] == $student_id)
              {
                $found1 = true;
                echo " found true ";
              }
              }

                if(!$found1)
                { 
                  echo "insert into activities_fines";
                  $sql = "INSERT INTO activities_fines ( afstudent_id,eventfee_id, a".$fees_id.") VALUES ('$student_id','$fees_id','$amount')";
                  mysqli_query($db, $sql); 
              }
              else
              {
                     echo "update into activities_fines";
                  $tsql = "UPDATE `activities_fines` SET a".$fees_id." = '$amount' WHERE afstudent_id = '$student_id'";
                        mysqli_query($db,$tsql);
                
              
              }

            }


    }


// $s = '';
// $ss = '';
// for($in = 0; $in < count($_POST['year']); $in++){
 
//   $s = "".$_POST['year'][$in];
//   $ss .= $s.',';
// }

// $r = rtrim($ss,',');
// $rt = $r;

// echo " - ".$rt;


// $sQuery = "SELECT * FROM students where year not in(".$rt.")";
// $result = $db->query($sQuery);
// while($row = mysqli_fetch_array($result))
// {  
//   echo " id ".$row['student_id'];
// }



            
            





 ?>