<?php
require_once('connection.php');
//if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start

class masterlist extends Database{

    public function view_events(){
			if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
                $found = false;
                $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."";
                $query = $this->conn->query($sql);
                while($row = $query->fetch_assoc()){
						$data[] = $row;
                        $found = true;
					}
                    if($found){ return $data; }
				}
			}

            public function view_events101(){
                if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
                    $found = false;
                    $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                    $query = $this->conn->query($sql);
                    while($row = $query->fetch_assoc()){
                            $data[] = $row;
                            $found = true;
                        }
                        if($found){ return $data; }
                    }
                }

                public function view_events102(){
                    if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
                        $found = false;
                        $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                        $query = $this->conn->query($sql);
                        while($row = $query->fetch_assoc()){
                                $data[] = $row;
                                $found = true;
                            }
                            if($found){ return $data; }
                        }
                    }

                    public function view_events103(){
                        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
                            $found = false;
                            $sql = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id ";
                            $query = $this->conn->query($sql);
                            while($row = $query->fetch_assoc()){
                                    $data[] = $row;
                                    $found = true;
                                }
                                if($found){ return $data; }
                            }
                        }

                        public function view_events104(){
                            if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
                                $found = false;
                                $var = 'sem'.$_SESSION["sem_id"];
                                $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.".$var." = 1  order by s.year , firstname ";
                                $query = $this->conn->query($sql);
                                while($row = $query->fetch_assoc()){
                                        $data[] = $row;
                                        $found = true;
                                    }
                                    if($found){ return $data; }
                                }
                            }
    


}

$masterlist = new masterlist();

?>