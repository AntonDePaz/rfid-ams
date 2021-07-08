<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

  $db  = mysqli_connect('localhost','root','', 'test_login');



<td> <?php echo strtoupper($row['description']); ?>   </td>
                          <td >&#8369 <?php echo "0.00"; //$row['amount'];?></td>
                          <td><input id="chk" type="checkbox" name="amount[]"></td>



<?php

//if(!$fg)
{


             // $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major,ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join new_feevent nf  on s.year in (".$yearlvl.") left join eventfine ef on s.id = ef.student_id  and ef.event_id = nf.id where nf.id =  '$eventid' ";


                //    $sql = "SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, ef.Timein1, ef.Timeout1, ef.Timein2, ef.Timeout2 ,ef.Timein3, ef.Timeout3 FROM students s inner join eventstatus es on s.year = es.yearlevel left join eventfine ef on s.id = ef.student_id and ef.event_id = es.event_id where es.event_id =  '$eventid'";
                   //  $query = $db->query($sql);
                   // while($row = $query->fetch_assoc())
                    {   
                     ?>
                        <tr>
                          <td><?php //echo $countz++;?></td>
                          <td><?php// echo $row['idnumber'];?></td>
                          <td><?php// echo $row['firstname'];?></td>
                          <td><?php// echo $row['lastname'];?></td>
                          <td><?php// echo $row['year'];?></td>
                          <td><?php// echo $row['section'];?></td>
                          <td><?php //echo $row['major'];?></td>
                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          //echo $row['Timein1'];
                           // }

                          ?></td>


                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          //echo $row['Timeout1'];
                           // }

                          ?></td>



                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                         // echo $row['Timein2'];
                           // }

                          ?></td>



                          <td><?php  
                          // if(is_null($row['Timeout1'])){
                          //       echo '--';
                          //   }
                          //   else {
                         // echo $row['Timeout2'];
                           // }
                            ?></td>

                          <td><?php 
                         // echo $row['Timein3'];
                           // }
                            ?></td>



                          <td><?php 
                          //echo $row['Timeout3'];
                           // }
                            ?></td>

                          <?php 
                            // $totalfines = 0;
                            // for($i = 0; $i < $pon; $i++)
                            // {
                            //  // if($i == $is){
                            //  echo'<td>'.$dash.'</td>';

                            //  $totalfines += $finesamount;
                            //  //  } 
                            //   // else{
                            //   //  echo'<td>'.$savearray[$i].'</td>';
                            //  //  }  
                            // }
                            ?>
                           
                        </tr>
                     <?php 

                     //  }
                      
                  //$foundcontent = true;
                    }


               if(!$foundcontent){

                       $sql = " SELECT s.idnumber,s.firstname,s.lastname,s.year , s.section,s.major, e.Timein1 , e.Timeout1,e.Timein2 , e.Timeout2,e.Timein3 , e.Timeout3 FROM students s left join eventfine e ON s.id = e.student_id and e.event_id = '$eventid' ";
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    {
                   
                     
                     ?>
                        <tr>
                          <td><?php echo $countz++;?></td>
                          <td><?php echo $row['idnumber'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['year'];?></td>
                          <td><?php echo $row['section'];?></td>
                          <td><?php echo $row['major'];?></td>

                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein1'];
                           // }

                          ?></td>


                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timeout1'];
                           // }

                          ?></td>



                          <td><?php 
                            // if(is_null($row['Timein1'])){
                            //     echo '--';
                            // }
                            // else {
                          echo $row['Timein2'];
                           // }

                          ?></td>



                          <td><?php  
                          // if(is_null($row['Timeout1'])){
                          //       echo '--';
                          //   }
                          //   else {
                          echo $row['Timeout2'];
                           // }
                            ?></td>

                          <td><?php 
                          echo $row['Timein3'];
                           // }
                            ?></td>



                          <td><?php 
                          echo $row['Timeout3'];
                           // }
                            ?></td>

                         
                           
                        </tr>





<?php
                   
}

}


} // if end #bg



 ?>















































  // $yr = ['1','2','3','4'];
  // $mj = ['1','1','1','Programming'];


  //   $vr[0] = "Programming";
  //   $vr[1] ="Networking";
  //  	for($i = 0; $i < count($yr); $i++)
  //   {

  //  		if(trim($yr[$i])  != '')
  //  		{
  //  			$year = $yr[$i];
  //  			$major = $mj[$i];
  //  			//$section = $_POST['section'][$i];

  //       //echo ' major: '.$major;
  //       if($major == '1')
  //       {
  //         for($a = 0;$a < 2; $a++)
  //         {
  //          // $query = "INSERT INTO `eventstatus`( `yearlevel`, `vr[$i]`, `section`, `event_id`) VALUES ('$year','$major','$section','$ev_id')";
  //           echo " yr ".$year." major ".$vr[$a];
  //         }
  //       }
  //       else{

  //  		 echo " yr2 ".$year." major2 ".$major;
  //  			//$query = "INSERT INTO `eventstatus`( `yearlevel`, `major`, `section`, `event_id`) VALUES ('$year','$major','$section','$ev_id')";
  //  			  //	mysqli_query($db, $query);
  //  		}
  //  		}

  //  	}


















// $v[0] = "Programming";
//       $v[1] ="Networking";

//       for($a = 1;$a < 6; $a++)
//       {
         
//           for($b = 0; $b < 2; $b++)
//           {
//          	echo " ".$a."  "."$v[$b]"." ";
//           }
//       }

// $num = 2;

// if($num > 1 && $num != 1)
//    {
//    	echo'no';
//    }
//    else
//    {
//    	echo 'yes';
//    }











// $ar = ['1','2','3','4','5,'];
// $co = '';

// for($i=0;$i < count($ar); $i++){
     
//        $co .= ''.$ar[$i].',';
// }
// //$r = rtrim($ar,',')
// $rt = rtrim($co,',');
//    echo " ".$rt;
//   $yr = 0;
//   $sq = "SELECT yearlevel from new_feevent where id = 15";
//   $quer = $db->query($sq);
//  $ro = $quer->fetch_assoc();
//  $yr = $ro['yearlevel'];
 
//   $foundyl = false;
// $sql = "SELECT lastname,year FROM `students` where id = 5 and year in (".$yr.")";
//  $query = $db->query($sql);
//  while($row = $query->fetch_assoc()){
//  $foundyl = true;

//  }
//  if(!$foundyl)
// {
// 	echo " not insert ";
// }
// else {
// 	echo "saved attendance";
// }
// $sql = "SELECT * FROM `new_feevent` where id = 7";
// 				        $query = $db->query($sql);
// 				    	$row = $query->fetch_assoc();
// 				    	$cost = $row['fines'];
// 				    	$yearlvl = $row['yearlevel'];


// echo " ".$yearlvl;





	


	 //  $sqles = "SELECT * FROM new_feevent where id = 6 ";
  //                   $queryes = $db->query($sqles);
  //                   $rowes = $queryes->fetch_assoc();
                    
  //                   $yearlvl = $rowes['major'];

  //                 //  $strings = $yearlvl;
  //                   $pieces = explode(',',$yearlvl);
  //                   for($i = 0; $i < count($pieces) ; $i++)
  //                   {
  //                    echo $pieces[$i];
  //                   } 










	//$timez = date("h:i:s");
	//$timez = date("m/d/y");
	//$today = strtotime($timez);

	//echo " string ".;

	//echo "Time: ".$timez;
	//$word = ' fee1';
	//$cut = substr(trim($word),3,20);

	//echo "cut: ".$cut;


  

	// $strings = "1,2,3,4,5";
	// $pieces = explode(',',$strings);
	// for($i = 0; $i < count($pieces) ; $i++)
	// {
	// 	echo $pieces[$i];
	// } 
	// $strings = "Proramming,Networking";
	// $pieces = explode(',',$strings);
	// for($i = 0; $i < count($pieces); $i++)
	// {
	// 	echo "peso : &#8369 :". $pieces[$i];
	// } 
// $arr1 = array();
// $arr2 = array();
// $a1 = 0;
// $a2 = 0;
// $db  = mysqli_connect('localhost','root','', 'test_login');
//   $sql1 = "SELECT * FROM `chargecost`";
//   $query1 = $db->query($sql1);
//   while($row1 = $query1->fetch_assoc())
//     {  
//     	$arr1[$a1++] = $row1['payamount'];
//     }
//    $sql = "SELECT * FROM `students`";
//    $query = $db->query($sql);
//    while($row = $query->fetch_assoc())
//     {  
//     	$arr2[$a2] = $row['lastname'];
//     	$a2++;
//     }


// for($i = 0; $i < count($arr2); $i++){
// 	for($b=0;$b<count($arr2);$b++){
// 		$multiarray = array(
// 			array($arr2[$b], $arr1[$b]),
// 			array($arr2[$b],$arr1[$b]),
// 			array($arr2[$b], $arr1[$b])
// 	);
// 	}
	
// }
	


// 	for($a = 0; $a < count($multiarray); $a++){
// 		echo "<th";
// 		for($b = 0; $b < count($multiarray); $b++){
// 			echo "<li>".$multiarray[$a][$b]."</li>";
// 		}
// 		echo "</ul>";
// 	}


	//$lastname = array_column($ar,'lastname');
	//print_r($lastname);

	// echo "".$multiarray[0][0];
	// echo "".$multiarray[0][1];

	// echo "".$multiarray[1][0];
	// echo "".$multiarray[1][1];
	// foreach ($multiarray as $key) {
	// 	foreach ($key['lastname'] as $value) {
	// 		echo $value[''];
	// 	}
	// }







 




















	 ?>

	  <!--  <td>&#8369 <?php// echo "100"; ?></td>
       <td>&#8369 <?php //echo 2 * 200; ?> -->
<!-- <table>
	<th>id</th>
	<th>lastname</th>

	<tr>
		<td>1</td>
		<td>depaz</td>
	</tr>
</table> -->
</body>
</html>