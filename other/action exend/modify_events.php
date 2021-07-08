<?php 

include '../includes/session.php';


if(isset($_POST['sem']) && isset($_POST['sy']) && isset($_POST['edit_date']) && isset($_POST['edit_eventname']) && isset($_POST['option']) && isset($_POST['event_id']) )
{
	
		 $event_id = trim($_POST['event_id']);
         $event_status = $_POST['option'];
		 $sem = $_POST['sem'];
		 $sy = $_POST['sy'];
		 $date = $_POST['edit_date'];
		 $event = $_POST['edit_eventname'];
		 $time = $_POST['edit_time'];
		 $fines = $_POST['edit_fines'];
		 $tap = $_POST['edit_tap'];
		 $apm = $_POST['edit_apm'];
		 $amount = $fines * $tap;


		 // $amount_before = 0;
		 // $fines_before = 0;
		 $found_edit = false;
		  $paylabel = "pay".$event_id;
		  $sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id' ";
		  $query = $conn->query($sql);
		  while($row = $query->fetch_assoc())
			{
				// $fines_before =  $row['fines'];
				// $tap_before =  $row['tap'];
				// //$amount_before = $row['amount'];

				if($row['tap'] == $tap && $row['fines'] == $fines){
					$found_edit = true;
				}
			 }

			// if($amount > $amount_before)
			// {
			// 	echo " add sa fines";
			// 	 $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$paylabel." = ( ".$paylabel." + '$fines_before')  WHERE 1 ";
		 //         if($conn->query($sql))
		 //        {
		 //         // $_SESSION['success'] = 'Fee updated successfully';
		 //          echo " successfully";
		 //         }
		 //          else
		 //          {
		 //          echo "error".$conn->error;
		 //          }
          
			// }
			// else if($amount < $amount_before)
			// {
			// 	echo " minus sa fines";
			// 	echo " add sa fines";
			// 	 $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$paylabel." = ( ".$paylabel." - '$fines_before')  WHERE 1";
		 //         if($conn->query($sql))
		 //        {
		 //         // $_SESSION['success'] = 'Fee updated successfully';
		 //          echo " successfully";
		 //         }
		 //          else
		 //          {
		 //          echo "error".$conn->error;
		 //          }
			// }
			// else
			// {
			// 	echo "no changes";
			// }

			//echo " add sa fines";
				 $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$paylabel." = '$amount'  WHERE 1 ";
		        if($conn->query($sql))
		        {
		         // $_SESSION['success'] = 'Fee updated successfully';
		         echo " successfully";
		         }
		          else
		          {
		          echo "error".$conn->error;
		          }

      if(!$found_edit){
		   $amountedit = 0;
		   $counttap = 0;
		 // $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = '$event_id' ";

		 $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = '$event_id' and (timein1 <> '' || timeout1 <> '' || timein2 <> '' || timeout2 <> '' || timein3 <> '' || timeout3 <> '')";
		  $query = $conn->query($sql);
		  while($row = $query->fetch_assoc())
		 {
				          
				           if(!empty($row['timein1']))
					    	{
					    		$counttap += 1;
					    	}
					    	if(!empty($row['timeout1']))
					    	{
					    		$counttap += 1;
					    	}
					    	if(!empty($row['timein2']))
					    	{
					    		$counttap += 1;
					    	}
					    	if(!empty($row['timeout2']))
					    	{
					    		$counttap += 1;
					    	}
					    	if(!empty($row['timein3']))
					    	{
					    		$counttap += 1;
					    	}
					    	if(!empty($row['timeout3']))
					    	{
					    		$counttap += 1;
					    	}
					    $amountedit = $counttap * $fines;
					    $student_id = $row['at_student_id'];

					  $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$paylabel." = ( ".$paylabel." - '$amountedit')  WHERE  ml_student_id = '$student_id' ";
				         if($conn->query($sql)){
				          echo " successfully";
				         }else{
				          echo "error".$conn->error;
				          }
					  //  echo $student_id.":".$amountedit."\n";
					    $counttap = 0;


		 }

}



		$sql = "UPDATE `fee_event` SET `Description`= '$event' ,`date`='$date',`time`=' $time',`tap`='$tap',`fines`='$fines',`amount`='$amount',`sem_id`='$sem',`sy_id`='$sy',`apm`='$apm' WHERE fe_id = '$event_id'  ";

		if($conn->query($sql))
		{
		echo 'Events UPDATE successfully';
		}
		else
		{
			//echo $conn->error;
		}




		/*


		update masterlist1 pay31 amount to all

		select to attendancehen tap1 if kapila cxa nka tap then x sa amount then minus sa
		masterlist ang amount.

















		*/



		 







}






if(isset($_POST['deleteid']))
{
	$id = trim($_POST['deleteid']);

	//echo " id:".$id;
		$sql = "DELETE FROM fee_event WHERE fe_id = '$id'";
		if($conn->query($sql)){
			$sql = "DELETE FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = '$id'";
			if($conn->query($sql)){
				echo "deleted from attendance_tap";
			}
			else{
				echo "error 1";
			}
			$sql = "ALTER TABLE masterlist".$_SESSION['sy_id']." DROP pay".$id." ";
			if($conn->query($sql)){
				echo "deleted from masterlist";
			}
			else{
				echo "error 2";
			}

		}
		else{
			echo 2;
		}
		
	
}




 ?>