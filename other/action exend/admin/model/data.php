<?php
require_once('connection.php');
// if(session_status() == PHP_SESSION_NONE)
// {session_start();}//start session if session not start
class datA extends Database{

    public function add_AY($ay){
        if(!empty($ay)){
	    $sql = "INSERT INTO sy_status ( sy_range, sy_status ) VALUES (?,'0')";
		$stmt = mysqli_stmt_init($this->conn);
		if(mysqli_stmt_prepare($stmt,$sql))
		{
		mysqli_stmt_bind_param($stmt, 's', $ay);
		mysqli_stmt_execute($stmt);
		//}
		//if($this->conn->query($sql))
		//{
			$getlast_id = 0;
			$sql = "SELECT * FROM sy_status order by sy_id asc";
	        $query = $this->conn->query($sql);
	        while($row = $query->fetch_assoc()){
	          $getlast_id = trim($row['sy_id']);
	        }

			# create table students

			$sql = "
				CREATE TABLE IF NOT EXISTS students".$getlast_id."(
					student_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					rfid VARCHAR(100),
					id_number VARCHAR(25),
					firstname VARCHAR(255),
					middlename VARCHAR(255),
					lastname VARCHAR(255),
					year VARCHAR(20),
					section VARCHAR(100),
					course VARCHAR(255),
					major VARCHAR(255),
					sem1 INT(5),
					sem2 INT(5)	
				);
			";
			$this->conn->query($sql);

                # create for masterlist  table
				$sql = "
				CREATE TABLE IF NOT EXISTS masterlist".$getlast_id."(
					ml_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					ml_student_id INT(20)
				);
			";
				$this->conn->query($sql);
				
               
				// $sql = "
				// CREATE TABLE IF NOT EXISTS masterlist".$getlast_id."(
				// 	ml_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				// 	ml_student_id INT(20)
				// );
			    // ";
				// if($this->conn->query($sql))
				// {
				// 	//echo"table created";
				// 	//return $con;
				// }
				// //else 
				//{
					//echo"Cannot created Table";
				//}



                     # create for  attendance tap table
				$sql = "
				CREATE TABLE IF NOT EXISTS attendance_tap".$getlast_id."(
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
					
				);
			";
				$this->conn->query($sql);
				
                # create tshirt size table
				$sql = "
				CREATE TABLE IF NOT EXISTS tshirt_size".$getlast_id."(
					ts_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					ts_student_id INT(11)
					
				);
			";
				$this->conn->query($sql);
				#create log history table

				$sql = "
				CREATE TABLE IF NOT EXISTS log_history".$getlast_id."(
					log_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					log_admin_name VARCHAR(255),
					log_action VARCHAR(255),
					log_action_name VARCHAR(255),
					log_description VARCHAR(255),
					log_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					sem_status VARCHAR(10)
					
					
				);
			";
				$this->conn->query($sql);
				//{
					//echo"table created";
					//return $con;
				//}
				//else 
				//{
					//echo"Cannot created Table";
				//}

             }

      }
   }

   public function showTable(){
            $value = "";

            $count_student = 0;
            // $sql = "SELECT * FROM students".$_SESSION['sy_id']."";
            // $query = $conn->query($sql);
            // $count_student = $query->num_rows;
            $sql = "SELECT * FROM sy_status order by sy_status desc";
            $query = $this->conn->query($sql);
            while($row = $query->fetch_assoc()){
            
            $value .= '<tr>
                <td><b style="font-weight: 700;">'.$row['sy_range'].'</b></td>';

            $value .= '<td style="font-weight: 700;" > <a data-sy='.$row['sy_id'].' style="color: red; cursor: pointer; " class="cdata_students" ><i class="fa fa-trash-o"></i></a> &nbsp; ';

                $sql1 = "SELECT * FROM students".trim($row['sy_id'])."";
                $query1 = $this->conn->query($sql1);
                $count_student = $query1->num_rows;
                    
                $value .=''.$count_student.' </td>';
                $value .= '<td style="font-weight: 700;"> <a data-sy='.$row['sy_id'].' style="color: red; cursor: pointer; " class="cdata_events" ><i class="fa fa-trash-o"></i></a> &nbsp; ';
                $sql1 = "SELECT * FROM fee_event where type = 1 and sy_id = ".$row['sy_id']."  ";
                $query1 = $this->conn->query($sql1);
                $count_student = $query1->num_rows;
                    $value .=''.$count_student.' </td>';
                $value .= '<td style="font-weight: 700;"> <a data-sy='.$row['sy_id'].' style="color: red; cursor: pointer; " class="cdata_fees" ><i class="fa fa-trash-o"></i></a> &nbsp; ';
                $sql1 = "SELECT * FROM fee_event where type = 2 and sy_id = ".$row['sy_id']."  ";
                $query1 = $this->conn->query($sql1);
                $count_student = $query1->num_rows;
                    $value .=''.$count_student.' </td>';
            $value .= ' <td><a style="color: red; cursor: pointer; " class="sy_range" data-id='.$row['sy_range'].'  id='.$row['sy_id'].'><i style="font-size: 15px; font-weight: 600;" class="fa fa-hdd-o"></i> Clean All Data</a></td>
            </tr>';
        }
        return $value;
   }


   public function DroP($tid){
       if(isset($_SESSION['sy_id']) && isset($_SESSION['admin_id']) && !empty($tid) ){
        $sql = "DROP TABLE log_history".$tid."";
        mysqli_query($this->conn,$sql);
        $sql = "DROP TABLE students".$tid."";
        mysqli_query($this->conn,$sql);
        $sql = "DROP TABLE attendance_tap".$tid."";
        mysqli_query($this->conn,$sql);
        $sql = "DROP TABLE masterlist".$tid."";
        mysqli_query($this->conn,$sql);
        $sql = "DROP TABLE tshirt_size".$tid."";
        mysqli_query($this->conn,$sql);
        $sql = "DELETE FROM sy_status WHERE sy_id = ? ";
        //if($this->conn->query($sql)){

		$stmt = mysqli_stmt_init($this->conn);
		if(mysqli_stmt_prepare($stmt,$sql))
		{
		mysqli_stmt_bind_param($stmt, 'i', $tid);
		mysqli_stmt_execute($stmt);
           
        
        if($tid == $_SESSION['sy_id']){
            unset($_SESSION['sy_id']);
			unset($_SESSION['sem_id']);
			return 1;
        }	
	  }

       }
   }

   public function TrunC($sy_id,$datatype){
    if(isset($_SESSION['sy_id']) && isset($_SESSION['admin_id']) && !empty($sy_id) && !empty($datatype) ){
        //101 students 102 fee 103 events
		//return $datatype; return $sy_id;
        if(trim($datatype) == 101){
            $sql = "TRUNCATE TABLE students".$sy_id."";
            if($this->conn->query($sql)){
				$sql = "TRUNCATE TABLE masterlist".$sy_id."";
				$this->conn->query($sql);
				$sql = "TRUNCATE TABLE attendance_tap".$sy_id."";
				$this->conn->query($sql);
				$sql = "TRUNCATE TABLE tshirt_size".$sy_id."";
				$this->conn->query($sql);
                return 1;
            }
        }
        if(trim($datatype) == 102){
				$sql = "SELECT * FROM `fee_event` WHERE  sy_id = '$sy_id' and type = '2' ";
				$query = $this->conn->query($sql);
				while($row = $query->fetch_assoc()){
					$sql = "ALTER TABLE masterlist".$sy_id." DROP pay".$row['fe_id']." ";
					$this->conn->query($sql);
				}
				$sql = "DELETE FROM `fee_event` WHERE  sy_id = ? and type = '2' ";
				//$this->conn->query($sql);
				$stmt = mysqli_stmt_init($this->conn);
				if(mysqli_stmt_prepare($stmt,$sql))
				{
				mysqli_stmt_bind_param($stmt, 'i', $sy_id);
				mysqli_stmt_execute($stmt);
				return 1;}
                   
        }
        if(trim($datatype) == 103){
			$sql = "SELECT * FROM `fee_event` WHERE  sy_id = '$sy_id' and type = '1' ";
			$query = $this->conn->query($sql);
			while($row = $query->fetch_assoc()){
				$sql = "ALTER TABLE masterlist".$sy_id." DROP pay".$row['fe_id']." ";
				$this->conn->query($sql);
			}
			$sql = "DELETE FROM `fee_event` WHERE  sy_id = ? and type = '1' ";
			$stmt = mysqli_stmt_init($this->conn);
				if(mysqli_stmt_prepare($stmt,$sql))
				{
				mysqli_stmt_bind_param($stmt, 'i', $sy_id);
				mysqli_stmt_execute($stmt);
			return 1; }
        }
        
         
        }
   }
























}

$datA = new datA();
?>