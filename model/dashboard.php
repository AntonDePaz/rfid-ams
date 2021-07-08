<?php
require_once('connection.php');
//if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start
class dashboard extends Database{

    public function countstudent(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
			$sql = "SELECT * FROM students".$_SESSION['sy_id']." where sem".$_SESSION['sem_id']." = 1 ";
			$result = $this->conn->query($sql);
		    if($result){
			 return $result->num_rows;
			  }
			else{
				return false;
			}
	  }
    }
    public function countevents(){
		if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
        $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
        $query = $this->conn->query($sql);
		if($query){
          return $query->num_rows;
		} else{
			return false;
		}
        }
        
    }
    public function countfee(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
        $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
        $query = $this->conn->query($sql);
        return $query->num_rows;
        }
        else{
            return false;
        }
    }
    public function countadmin(){
		if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
        $sql = "SELECT * FROM admin where admin_id <> 1";
        $query = $this->conn->query($sql);
		if($query){
			if($query->num_rows > 0){
				return $query->num_rows;
				}
				else{
					return false;
				}
	   }
	  }
    }

	public function show_active_ay(){
		$sql = "SELECT * FROM sy_status where sy_status = 1 ";
		$result = $this->conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data = strtoupper($row['sy_range']);
				$_SESSION['sy_id'] = $row['sy_id'];
				$_SESSION['sy_range'] = $row['sy_range'];
			}
			return $data;
		}
		else{
			return false;
		}
	 } 
	 public function showall_ay(){
		$sql = "SELECT * FROM sy_status order by sy_range desc";
		$result = $this->conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function upcoming_events(){
		if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
				$date = date("m/d/Y", strtotime('tomorrow'));
				$mod_date = strtotime($date."+ 15 days");
				$date_afte15days = date("m/d/Y",$mod_date);
			$sql = "SELECT * FROM fee_event WHERE DATE_FORMAT( date, '%m/%d/%Y' ) BETWEEN DATE_FORMAT( date, '".$date."' ) AND DATE_FORMAT( date, '".$date_afte15days."' ) and type = 1 and  sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." order by date ";
			$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
		}
	}
	public function today_events(){
		if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
			$datenow = date('Y-m-d');
		//	$sql = "SELECT * FROM fee_event where DATE_FORMAT( date, '%m/%d/%Y' ) = DATE_FORMAT( NOW(), '%m/%d/%Y' ) and type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
		$sql = "SELECT * FROM fee_event where date = '$datenow' and type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
		//$sql = "SELECT * FROM fee_event where DATE_FORMAT( date, '%m/%d/%Y' ) = DATE_FORMAT( $datenow, '%m/%d/%Y' ) and type = 1 and sem_id = ".$_SESSION['sem_id']."  and sy_id = ".$_SESSION['sy_id']." ";
		$result = $this->conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
		}
	}
	public function log_history(){
		if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
			$sql = "SELECT * FROM log_history".$_SESSION['sy_id']." where sem_status = ".$_SESSION['sem_id']." order by log_time desc";
			$result = $this->conn->query($sql);
			if($result){
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
		}
	}

		
	}


	public function tap_fee_event($feeid){

		$sql = "SELECT * FROM fee_event where fe_id = '$feeid' ";
		$query = $this->conn->query($sql);
		$row = $query->fetch_assoc();
		return $row;

	}

	public function tap_attendance_status(){

		$sql = "SELECT * FROM attendance_status ";
		$query = $this->conn->query($sql);
		while($row = $query->fetch_assoc())
		{
			$data[] = $row;
		}
	   return $data;

	}
		












	

}


$dashboard = new dashboard;

 ?>
