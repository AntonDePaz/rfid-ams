
<?php
require_once('connection.php');
 //if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start
class log extends Database{



    public function addloghistory($admin_name,$action,$action_name,$eventname){

        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id']) ){
        $query = "INSERT INTO log_history".$_SESSION['sy_id']."  (`log_admin_name`, `log_action`, `log_action_name`, `log_description`, `sem_status`) VALUES (?,?,?,?,?)";
        
        mysqli_query($this->conn, $query);

              $stmt = mysqli_stmt_init($this->conn);
				if(mysqli_stmt_prepare($stmt,$query))
				{
				mysqli_stmt_bind_param($stmt, 'sssss', $admin_name,$action,$action_name,$eventname,$_SESSION['sem_id']);
				mysqli_stmt_execute($stmt);
                }
        }


    }






}

$log = new log();

?>