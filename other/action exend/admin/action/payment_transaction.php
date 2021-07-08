<?php 


include '../includes/conn.php';


if(isset($_POST['student_id']))
{

	$student_id = $_POST['student_id'];
	$concat_fee_event_id = $_POST['concat_fee_event_id'];

	//echo " student_id: ".$student_id;
	//echo " concat_fee_event_id: ".$concat_fee_event_id;




	$stringval = trim(rtrim($concat_fee_event_id,','));

	$pieces = explode(",", $stringval);

    for($i = 0;$i< count($pieces);$i++)
	{
		$sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." where ml_student_id = '$student_id'";
        $query = $db->query($sql);
        $row = $query->fetch_assoc();
        $found = $row['ml_id'];
        $sql1 = "SELECT * FROM fee_event where fe_id = '$pieces[$i]'";
        $query1 = $db->query($sql1);
        $row1 = $query1->fetch_assoc();
        $amount = $row1['amount'];

		 if(is_null($found))
          {
          	//echo " pieces:".$pieces[$i];

		  	$sql = "INSERT INTO masterlist".$_SESSION['sy_id']." (ml_student_id,pay".$pieces[$i].") VALUES ('$student_id','$amount')";
				if($db->query($sql))
				{
					//$_SESSION['success'] = 'Voter added successfully';
					echo " insert successfully";
				}
				else
				{
					//$_SESSION['error'] = $db->error;
					echo " error: ".$db->error;
				}

		  	echo " wala dire insert";
	     }
	     else
	     {
	     	echo " pieces:".$pieces[$i];
		  	 $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$pieces[$i]." = '0.00' WHERE ml_student_id = '$student_id' ";
					if($db->query($sql))
					{
						//$_SESSION['success'] = 'Admin profile updated successfully';

						echo "updated successfully";
					}
					else{
						//$_SESSION['error'] = $db->error;
						echo " erro".$db->error;
					}
		  	//echo " naa update";

		  }


 }



}



 ?>
