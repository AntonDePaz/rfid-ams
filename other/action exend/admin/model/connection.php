<?php
//include '../includes/session.php';
date_default_timezone_set('Asia/Manila');
if(session_status() == PHP_SESSION_NONE)
{session_start();}//start session if session not start
class Database{

private $servername = 'localhost';
private $username = 'root';
private $password = '';
private $db = 'ssc_ams';
public $conn;

 function __construct(){

    $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db);
    if($this->conn->connect_error){
        echo "Connection Failed";
    }else{
        return $this->conn;
    }
   
}

    public function has_active(){

        // if( (time() - $_SESSION['time_login']) > 7200){
        //  header('location: ../logout.php');
        // }
        // else{
        //   $_SESSION['time_login'] = time();
        // }

        
    }

    public function show_active_sy_sem(){
		
        

		$sql = "SELECT * FROM sem_status where sem_status = 1 ";
		$result = $this->conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
			//	$data = strtoupper($row['sy_range']);
           // echo $row['sem_id'];
				$_SESSION['sem_id'] = $row['sem_id'];
				//$_SESSION['sy_range'] = $row['sy_range'];
			}
		//	return $data;
		}

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
		
		


	 } 

    
    
  
}

$dbb = new Database();
$dbb->show_active_sy_sem();


?>