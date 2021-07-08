<?php 

include '../includes/session.php';



if(isset($_POST['description']) && isset($_POST['amount']) && isset($_POST['academicyear_id']) && isset($_POST['semester_id']))
{	
	$academic_year = $_POST['academicyear_id'];
	$semester = $_POST['semester_id'];
	$fee_status = $_POST['option'];
	$description = $_POST['description'];
	 $amount = $_POST['amount'];
	 $amount = $amount;
	 $today = date('Y-m-d');

	 echo " amount".$amount;

// echo " ".$description." ".$amount;

// echo " fee_status:".$fee_status;
// echo " semester:".$semester;
// echo " academicyear_id:".$academic_year;

	 $query = "INSERT INTO `fee_event`(`Description`, `date`, `amount`, `type`, `sem_id`, `sy_id`, `fe_status`) VALUES ('$description','$today','$amount','2','$semester','$academic_year', '$fee_status')";
	   mysqli_query($conn, $query);



	 $fee_id = 0;
	$sQuery = "SELECT fe_id FROM fee_event order by fe_id";
	$result = $conn->query($sQuery);
	while($row = mysqli_fetch_array($result))
	{
	  $fee_id = trim($row['fe_id']);
	}

	   $sq = "ALTER TABLE masterlist".$_SESSION['sy_id']." ADD column pay".$fee_id." decimal(10,2)";
	   mysqli_query($conn, $sq);

	if($fee_status == 1)
	{
		$sq = "ALTER TABLE tshirt_size".$_SESSION['sy_id']." ADD column size".$fee_id." varchar(200)";
	    mysqli_query($conn, $sq);
	}
	else
	{
		$sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = '$amount'  WHERE 1 ";
			if($conn->query($sql))
			{
				$_SESSION['success'] = 'Fee updated successfully';
			}
			else
			{
				$_SESSION['error'] = $conn->error;
			}
	}


}
else{

header('location: ../logout.php');

}

 ?>