<?php 

include '../includes/session.php';

if(isset($_POST['deleteventid'])){

	$eventid = $_POST['deleteventid'];
                      $havevalue = 0;
				    	$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$eventid' ";
				          $query = $conn->query($sql);
				    	while($row = $query->fetch_assoc())
					     {
					    	if(!empty($row['timein1']))
					    	{
					    		$havevalue += 1;
					    	}
					    	if(!empty($row['timeout1']))
					    	{
					    		$havevalue += 1;
					    	}
					    	if(!empty($row['timein2']))
					    	{
					    		$havevalue += 1;
					    	}
					    	if(!empty($row['timeout2']))
					    	{
					    		$havevalue += 1;
					    	}
					    	if(!empty($row['timein3']))
					    	{
					    		$havevalue += 1;
					    	}
					    	if(!empty($row['timeout3']))
					    	{
					    		$havevalue += 1;
					    	}
					     }

					     echo $havevalue;



}





 ?>