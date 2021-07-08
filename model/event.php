<?php
require_once('connection.php');
// if(session_status() == PHP_SESSION_NONE)
// {session_start();}//start session if session not start
class event extends Database{



	
	public function check_event_active($eventid){
		if(isset($_SESSION['sy_id']) && !empty($eventid)){
		$havevalue = 0;
		$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$eventid' ";
		  $query = $this->conn->query($sql);
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

		 return $havevalue;
		}

	}
	public function add_event($data = []){
		//if(isset($_POST['data'])){
			//$data = json_decode($_POST['data'], true);
			if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']))
			{
			$eventname = $data[0];
			$date = $data[1];
			$time = $data[2];
			#$apm = $data[3];
			$tap = $data[3];
			$fines = $data[4];
			$amount = $data[5];
			#$amount = $tap * $fines;
			$sem = $_SESSION['sem_id'];
			$sy = $_SESSION['sy_id'];
			$type = 1;

				$query = "INSERT INTO `fee_event`(`Description`, `date`, `time`, `tap`, `fines`, `amount`, `type`,`sem_id`,`sy_id`)
				 VALUES (?,?,?,?,?,?,?,?,?)";
					$stmt = mysqli_stmt_init($this->conn);
					if(mysqli_stmt_prepare($stmt,$query))
					{
					mysqli_stmt_bind_param($stmt, 'sssiddiii', $eventname,$date,$time,$tap,$fines,$amount,$type,$sem,$sy);
					mysqli_stmt_execute($stmt);
				// 	}	



				// $result = $this->conn->query($query);
				// if($result){

					//return '1';
						$fee_id = 0;
						$sQuery = "SELECT fe_id FROM fee_event order by fe_id";
						$result = $this->conn->query($sQuery);
						while($row = mysqli_fetch_array($result))
						{
							$fee_id = $row['fe_id'];
						}
						$sql = "CREATE TABLE IF NOT EXISTS masterlist".$_SESSION['sy_id']."(
							ml_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
							ml_student_id INT(20)
						);";
						$this->conn->query($sql);
						
							$sq = "ALTER TABLE masterlist".$_SESSION['sy_id']." ADD column pay".$fee_id." decimal(20,2)";
								if($this->conn->query($sq))
								{
									$sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = ?  WHERE 1 ";
									$stmt = mysqli_stmt_init($this->conn);
									if(mysqli_stmt_prepare($stmt,$sql))
									{
									mysqli_stmt_bind_param($stmt, 'd',$amount);
									mysqli_stmt_execute($stmt);
									}
									
								}
							
						



							$sql = "CREATE TABLE IF NOT EXISTS attendance_tap".$_SESSION['sy_id']."(
								at_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
								at_fee_event_id INT(25),
								at_student_id INT(25),
								timein1 VARCHAR(100),
								timeout1 VARCHAR(100),
								timein2 VARCHAR(100),
								timeout2 VARCHAR(100),
								timein3 VARCHAR(100),
								timeout3 VARCHAR(100),
								at_status INT(10)
							 );";
							$this->conn->query($sql);
							
								$sem = 'sem'.trim($_SESSION['sem_id']);
								$student_id = 0;
								$sQuery = "SELECT * FROM students".$_SESSION['sy_id']."  where ".$sem." = 1";
								$result = $this->conn->query($sQuery);
								while($row = mysqli_fetch_array($result))
								{
								$student_id = $row['student_id'];

								$query = "INSERT INTO attendance_tap".$_SESSION['sy_id']."  (`at_fee_event_id`, `at_student_id`,`at_status`) VALUES (?,?,'0')";
								$stmt = mysqli_stmt_init($this->conn);
								if(mysqli_stmt_prepare($stmt,$query))
									{
									mysqli_stmt_bind_param($stmt,'ii',$fee_id,$student_id);
									mysqli_stmt_execute($stmt);
									}

									
								// echo "  s.id:".$student_id;
								// echo "  e.id:".$fee_id;
								}



							
						
							}
			}// end if isset sem_id and sy_id
		}

		public function edit_event($data = []){
		//if(isset($_POST['data'])){
			//$data = json_decode($_POST['data'], true);
			print_r($data);
			if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id'])){
				if(!empty($data)){
				
			$event_id = trim($data[0]);
			$date = $data[1];
			$eventname = $data[2];
			$time = $data[3];
			$fines = $data[4];
			$tap = $data[5];
			#$apm = $data[6];
			#$amount = $data[4] * $data[5];
			$amount = $data[6];
			$sem = $_SESSION['sem_id'];
			$sy = $_SESSION['sy_id'];
			//echo 'ok:'.$event_id." ".$date." ".$eventname." ".$time." ".$tap." ".$apm." ".$amount;
			$found_edit = false;
			$paylabel = "pay".$event_id;
			$sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id' ";
			$query = $this->conn->query($sql);
			while($row = $query->fetch_assoc())
			  {
				  // $fines_before =  $row['fines'];
				  // $tap_before =  $row['tap'];
				  // //$amount_before = $row['amount'];
  
				  if($row['tap'] == $tap && $row['fines'] == $fines){
					  $found_edit = true;
				  }
			   }
			   $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$paylabel." = ?  WHERE 1 ";
			   $stmt = mysqli_stmt_init($this->conn);
			   if(mysqli_stmt_prepare($stmt,$sql))
			   {
			   mysqli_stmt_bind_param($stmt, 'd',$amount);
			   mysqli_stmt_execute($stmt);
			   }
				 if(!$found_edit){
					$amountedit = 0;
					$counttap = 0;
				  // $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = '$event_id' ";
		 
				  $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = '$event_id' and (timein1 <> '' || timeout1 <> '' || timein2 <> '' || timeout2 <> '' || timein3 <> '' || timeout3 <> '')";
				   $query = $this->conn->query($sql);
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
		 
							   $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$paylabel." = ( ".$paylabel." - ?)  WHERE  ml_student_id = ? ";
							   if(mysqli_stmt_prepare($stmt,$sql))
							   {
							   mysqli_stmt_bind_param($stmt, 'di',$amountedit,$amountedit);
							   mysqli_stmt_execute($stmt);
							   }
							   //  echo $student_id.":".$amountedit."\n";
								 $counttap = 0;
		 
		 
				  }
		 
		 }
		 
		 
		 
				 $sql = "UPDATE `fee_event` SET `Description`= ? ,`date`= ? ,`time`= ? ,`tap`=?,`fines`=?,`amount`=?,`sem_id`= ?,`sy_id`= ? WHERE fe_id = ?  ";
				 $stmt = mysqli_stmt_init($this->conn);
				 if(mysqli_stmt_prepare($stmt,$sql))
				 {
				 mysqli_stmt_bind_param($stmt, 'sssiddiii',$eventname,$date,$time,$tap,$fines,$amount,$sem,$sy,$event_id);
				 mysqli_stmt_execute($stmt);
				 }
			
		 






	    } // end if data not empty

	   } // end for if isset sem and sy 


		} // end fuction edit event



		public function delete_event($eventid){

			if(isset($_SESSION['sy_id'])){

					$sql = "DELETE FROM fee_event WHERE fe_id = ? ";
					$stmt = mysqli_stmt_init($this->conn);
					if(mysqli_stmt_prepare($stmt,$sql))
					{
					mysqli_stmt_bind_param($stmt, 'i',$eventid);
					mysqli_stmt_execute($stmt);
						
					}

				//if($this->conn->query($sql)){
					$sql = "DELETE FROM attendance_tap".$_SESSION['sy_id']." WHERE at_fee_event_id = ? ";
					$stmt = mysqli_stmt_init($this->conn);
					if(mysqli_stmt_prepare($stmt,$sql))
					{
					mysqli_stmt_bind_param($stmt, 'i',$eventid);
					mysqli_stmt_execute($stmt);
					}
					$sql = "ALTER TABLE masterlist".$_SESSION['sy_id']." DROP pay".$eventid." ";
					$this->conn->query($sql);
				}
			
		//	}
			
		} # end function delete event



























# sample this all down

public function show_all_event(){
	if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id'])){
	$sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."  order by date";
	$result = $this->conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}
}
}
		



		public function showall_event(){
			if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id'])){
				$date = date("Y-m-d");
				$output = '';  $dex=0;
				$output .= "<div class='row container'>";
			$sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."  order by date";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					//$data[] = $row;
				


				////////////////////////////////////

			
			  if($row['date'] >= $date){
					
			 $output .= '<div class="inner"> 
						 <a title="Edit/Delete"  class="btn menu" data-id="'.$row['fe_id'].'"><i class="fa fa-ellipsis-h"></i></a>
						 <a  class="eventspanel" id='.$row['fe_id'].'>
						 <div class="eventz"><span style="font-size: 15x;  color: black;" >'.$row['Description'].'</span> <span class="code"></span></div> 
						 <div style="font-size: 11px; margin-top:5px;">Date: <span style="font-size: 12px; color: black;" ><strong>'.date('M j, Y',strtotime($row['date'])).'</strong></span> <span class="section"></span></div> 
						 <div style="font-size: 11px;">Time Start:<span style="font-size: 12px; color: black;" > '.date('g:i a', strtotime($row['time'])).'</span> <span class="year"></span></div>
					   </a>
					   </div>
					 
					   ';
 
			 $dex++;
			  }
			} # end while
		 }

		 if($dex == 0){
			$output .= "<h6 style='margin-left:20px;' class='text-info'> No Upcoming Event(s)</h6>";
		 }
		 $output .= "</div>";
		 $output .= "<hr>";
		 $output .= "<h6> Expired Events </h6>";
		 $output .= "<div class='row container'>";
		 $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."  order by date";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
			
			 // $sQuery = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and date < '$date' order by date";
				 //        $result = $conn->query($sQuery);
			   //         while($row = mysqli_fetch_array($result))
			  
			   if($row['date'] < $date){
				   
				$output .= '<div class="inner2"> 
							   <a title="Edit/Delete"  class="btn menu" data-id="'.$row['fe_id'].'"><i class="fa fa-ellipsis-h"></i></a>
							   <a href="eventsliststudent.php?id='.$row['fe_id'].'" class="eventspanel" id='.$row['fe_id'].'>
							   <div class="eventz"><span style="font-size: 15x;  color: black;" >'.$row['Description'].'</span> <span class="code"></span></div> 
							   <div style="font-size: 11px; margin-top:5px;">Date: <span style="font-size: 12px; color: black;" ><strong>'.date('M j, Y',strtotime($row['date'])).'</strong></span> <span class="section"></span></div> 
							   <div style="font-size: 11px;">Time Start:<span style="font-size: 12px; color: black;" > '.date('g:i a', strtotime($row['time'])).'</span> <span class="year"></span></div>
							 </a>
							 </div>
							 ';
 
				   $dex++;
				   }
			

				}
			}
			$output .= "</div>";
		//	return $data;
		return $output;




				/////////////////////////

		// 	}
		    }
		}

		public function show_event($id){
			$sql = "SELECT * FROM fee_event where fe_id = '$id'";
			
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data = $row;
				}
				return $data;
			}
		}

		public function login($data = []){
			session_start();
			$user = $data[0];
			$pass = $data[1];
			$pass = sha1($pass);
			$sql = "SELECT * FROM user WHERE user = '$user' and pass = '$pass' ";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$_SESSION['uid'] = $row['id'];
					$_SESSION['fn'] = $row['fn'];
					$_SESSION['ln'] = $row['ln'];
					$_SESSION['sex'] = $row['sex'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['address'] = $row['address'];
					$_SESSION['user'] = $row['user'];
				}
				return '1';
				//echo "1";
				}
				else{
					//echo "2";
					return '2';
				}


		}



		public function students_list_in_event($event_id){
				
			if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id'])){
				$data = array();
				$sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$event_id' and s.sem".$_SESSION["sem_id"]." = 1 order by at.at_status, s.year,s.firstname";
				$query = $this->conn->query($sql);
				while($row = $query->fetch_assoc())
				{  
					$data[] = $row;
				}
				return $data;
			}
		}


		


}

$event = new event();

//$model = new Model();







 ?>
