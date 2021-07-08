<?php 


include '../includes/session.php';



if(isset($_POST['fee_eventid']) && isset($_POST['concat_studentid']) && isset($_POST['amount']) )
{

	$fee_id = trim($_POST['fee_eventid']);
	$amount = trim($_POST['amount']);
	$concat_studentid = trim($_POST['concat_studentid']);


    $concat_student_id = trim(rtrim($concat_studentid,','));
	$piece_student_id = explode(",", $concat_student_id);
	
	print_r($piece_student_id);


	for($i = 0;$i < count($piece_student_id); $i++)
	{

		// $found = false;
		// $sql = "SELECT * FROM `masterlist` WHERE ml_student_id = '$piece_student_id[$i]'";
		// 	$query = $conn->query($sql);
		//     while($row = $query->fetch_assoc())
		// 	{
		// 		$found = true;
		//     }
		// 	if(!$found)
		// 	{
		// 	$query = "INSERT INTO `masterlist`(`ml_student_id`, pay".$fee_id.") VALUES ('$piece_student_id[$i]', '$amount')";
		// 	   mysqli_query($conn, $query);
		// 	}
			//else
			{
				$sql = " UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = '0' WHERE ml_student_id = '$piece_student_id[$i]' ";
					if($conn->query($sql))
					{
						// $_SESSION['success'] = 'Students added successfully';
						echo "successfully insert into masterlist";
					}
					//else
					{
						//$_SESSION['error'] = $conn->error;
						echo "error".$conn->error;
					}

			}
	}


}




 //insert or update to marterlist;









 ?>