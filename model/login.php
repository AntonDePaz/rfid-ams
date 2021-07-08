<?php
require_once('connection.php');
//if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start

class login extends Database{

    public function clogin($username,$password){

        $username = mysqli_real_escape_string($this->conn, $username);  
		$password = mysqli_real_escape_string($this->conn, $password); 
		$username = trim(strtolower($username)); 
        $password = sha1(md5($password));


        $sql = "SELECT * FROM admin WHERE TRIM(LOWER(username)) = '$username'";
		$query = $this->conn->query($sql);

		if($query->num_rows < 1){
			return  2;
		}
		else{
			$row = $query->fetch_assoc();
			if(($password == $row['password'])){
				$_SESSION['admin_id'] = $row['admin_id'];
				$_SESSION['rfid'] = $row['rfid'];
				$_SESSION['id_number'] = $row['id_number'];
				$_SESSION['position'] = $row['position'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['middlename'] = $row['middlename'];
				$_SESSION['lastname'] = $row['lastname'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['photo'] = $row['photo'];
				$_SESSION['time_login'] = time();


				// $fullname = ucwords($row['firstname']).' '.ucwords($row['lastname']).'';
				// $query2 = "INSERT INTO log_history".$_SESSION['sy_id']." ( `log_admin_name`, `log_action`,`sem_status`) VALUES ('$fullname','Log In',".$_SESSION['sem_id'].")";
    //             mysqli_query($conn, $query2);

			return true;
				
			}
			else{
				return 2;
			}
		}


    }


}

$login = new login();
?>