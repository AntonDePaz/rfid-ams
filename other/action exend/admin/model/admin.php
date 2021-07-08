<?php
require_once('connection.php');
// if(session_status() == PHP_SESSION_NONE)
// {session_start();}//start session if session not start
class admin extends Database{

	public function add_admin($data = []){
        if(!empty($data)){
            $rfid = mysqli_real_escape_string($this->conn,$data[0]);
            $position = mysqli_real_escape_string($this->conn,$data[1]);
            $firstname = mysqli_real_escape_string($this->conn,$data[2]);
            $middlename = mysqli_real_escape_string($this->conn,$data[3]);
            $lastname = mysqli_real_escape_string($this->conn,$data[4]);
            $username = mysqli_real_escape_string($this->conn,$data[5]);
            $password = mysqli_real_escape_string($this->conn,$data[6]);
            $img = mysqli_real_escape_string($this->conn,$data[7]);
            $password = sha1(md5($password));    
            $sql = "SELECT * FROM admin WHERE LOWER(username) = LOWER('$username') ";
            $query = $this->conn->query($sql);
            if($query->num_rows >= 1){
                return 2;
            }
            else{   
                $sql = "SELECT * FROM admin WHERE rfid = '$rfid' ";
                $query = $this->conn->query($sql);
                if($query->num_rows >= 1){
                    return 3;
                }else{   
                    $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE rfid = '$rfid' ";
                    $query = $this->conn->query($sql);
                    if($query->num_rows >= 1){
                        return 4;
                    } else {                                                                                 
                        $sql = "INSERT INTO `admin` ( `rfid`, `firstname`, `middlename`, `lastname`, `username`, `password`, `photo`,`position`) VALUES ( '$rfid','$firstname','$middlename','$lastname','$username','$password','$img','$position') ";
                        if($this->conn->query($sql))
                        {
                            return 1;
                            //echo 'Students added successfully';
                            $_SESSION['imagepath'] = '';
                        }
                        //else
                        {
                            //echo 'erorr'.$conn->error;
                            return 0;
                        }
                    }


                }
          }
        }


    }


    public function edit_admin($data = []){
        if(!empty($data) && isset($_SESSION['admin_id'])){

           // $adminid,$rfid,$firstname,$middlename,$lastname,$username,$image


            //$image = "";
           // $adminid = $_SESSION['admin_id'];
           $today = date("F j, Y, g:i a");
           $old_username = $_SESSION['username'];
           $old_rfid = $_SESSION['rfid'];
            $adminid = mysqli_real_escape_string($this->conn,$data[0]);
            $rfid = mysqli_real_escape_string($this->conn,$data[1]);
            $firstname = mysqli_real_escape_string($this->conn,$data[2]);
            $middlename = mysqli_real_escape_string($this->conn,$data[3]);
            $lastname = mysqli_real_escape_string($this->conn,$data[4]);
            $username = mysqli_real_escape_string($this->conn,$data[5]);
            $image = mysqli_real_escape_string($this->conn,$data[6]);

           // if($type == 'username'){
               $found = false;
                $sql = "SELECT * FROM admin WHERE LOWER(username) = LOWER('$username') and LOWER(username) <> LOWER('$old_username')  ";
                $query = $this->conn->query($sql);
                if($query){
                if($query->num_rows >= 1){
                    return 2;
                    $found = true;
                }
            } 
          //  }
           // else if($type == 'rfid'){
                $sql = "SELECT * FROM admin WHERE rfid = '$rfid' and rfid <> '$old_rfid' ";
                $query = $this->conn->query($sql);
                if($query){
                if($query->num_rows >= 1){
                    return 3;
                    $found = true;
                }
            }
          //  } else if($type == 'idnumber'){

                $sql = "SELECT * FROM admin WHERE id_number = '$rfid' ";
                $query = $this->conn->query($sql);
                if($query){
                if($query->num_rows >= 1){
                    return 4;
                    $found = true;
                }
            }
          //  }else {
             //   return 1;
          //  }
            if(!$found){
            if(empty($image)){
                $sql = "UPDATE admin SET `rfid`='$rfid',`firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`username`='$username' ,`date_updated` = '$today'  WHERE admin_id = '$adminid' ";
               
              //  echo 'wala utro';
              //  var_dump($data);
            }else{
                $sql = "UPDATE admin SET `rfid`='$rfid',`firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`username`='$username', `photo`='$image' ,`date_updated` = '$today'  WHERE admin_id = '$adminid' ";
              //  echo 'naa photo';
              //  var_dump($data);
            }
            $this->conn->query($sql);
        }


        //    // $password = sha1(md5($password));
        //     if(isset($_SESSION['imagepath']))
        //     {$image = $_SESSION['imagepath'];}
        //     else{$image = $_POST['photopath'];}
        //   //  $rfid,$firstname,$middlename,$lastname,$username,$password

        //                         $sql = "SELECT * FROM admin WHERE admin_id = '$adminid' ";
        //                     $query = $this->conn->query($sql);
        //                     if($query->num_rows < 1){
        //                        // echo 11;
        //                     }
        //                     else{
        //                         $row = $query->fetch_assoc();
        //                         if(($password == $row['password'])){
        //                            // echo 'correct password';
                                        
        //                                     $sql = "UPDATE admin SET `rfid`='$rfid',`firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`username`='$username' WHERE admin_id = '$adminid' ";
        //                                     $this->conn->query($sql);
        //                                 if(!empty($image)){

        //                                     $sql = "UPDATE admin SET `photo`= '$image' WHERE admin_id = '$adminid' ";
        //                                     $this->conn->query($sql);
                            
        //                                 }

                                        
        //                         }
        //                         // else{
        //                         //    // echo 1;
        //                         // }
        //                     }

                    $sql = "SELECT * FROM admin WHERE admin_id = '$adminid'";
                    $query = $this->conn->query($sql);
                            while($row = mysqli_fetch_array($query))
                            {
                                    $_SESSION['admin_id'] = $row['admin_id'];
                                    $_SESSION['rfid'] = $row['rfid'];
                                    $_SESSION['firstname'] = $row['firstname'];
                                    $_SESSION['middlename'] = $row['middlename'];
                                    $_SESSION['lastname'] = $row['lastname'];
                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['photo'] = $row['photo'];
                                    unset($_SESSION['imagepath']);
                                
                            }
                            }
                        }


        public function del_admin($id){
        if(!empty($id)){
            $sql = "DELETE FROM admin WHERE admin_id = '$id'";
            $this->conn->query($sql);
            return 1;
        }

        }


        public function check_duplicate($data,$type)
        {
            if($type == 'username'){

                $sql = "SELECT * FROM admin WHERE LOWER(username) = LOWER('$data') ";
                $query = $this->conn->query($sql);
                if($query->num_rows >= 1){
                    return 2;
                }

            }
            else if($type == 'rfid'){
                $sql = "SELECT * FROM admin WHERE rfid = '$data' ";
                $query = $this->conn->query($sql);
                if($query->num_rows >= 1){
                    return 3;
                }
            } else if($type == 'idnumber'){

                $sql = "SELECT * FROM admin WHERE id_number = '$data' ";
                $query = $this->conn->query($sql);
                if($query->num_rows >= 1){
                    return 4;
                }

            }else {
                return 1;
            }
           
        }

        public function show_all_admin(){

            $countz = 1;
            $data = "";
            $sql = "SELECT * FROM admin";
           $query = $this->conn->query($sql);
           while($row = $query->fetch_assoc()){
               $data .='<tr>';
                 $data .= '<td>'.$countz++.'</td>';
                  $data .= '<td>';
                    if(empty($row['photo']))
                    {
                        $data .= "<img src='images/profile.jpg' width='50' height='50'  style='border-radius: 50%;'> </td>";
                    }else{
                        $data .= "<img src='images/".trim($row['photo'])."' width='50' height='50'  style='border-radius: 50%;'> </td>";
                    }
                   $data .= '<td>'.$row['rfid'].'</td>';
                   $data .= '<td>'.$row['firstname'].'</td>';
                   $data .= '<td>'.$row['middlename'].'</td>'; 
                   $data .= '<td>'.$row['lastname'].'</td>';
                   $data .= '<td>'.ucwords($row['position']).'</td>';  
                   $data .= '<td class="access"><a style="color: red;" class="btn btn-default btn-xs admin_del" id='.$row['firstname'].' '.$row['lastname'].'  data-id='.ucwords($row['admin_id']).'> <i class="fa fa-trash-o"> Remove Account</i></a></td>  </tr>';
                }
                return $data;
        }

        public function check_password($password){

            if(!empty($password)){
                $password = mysqli_real_escape_string($this->conn, $password);
                $password = sha1(md5($password));
                $admin_id = $_SESSION['admin_id'];
                //echo " sud na".$password." id".$admin_id;
                $found = false;
                $sql = "SELECT * FROM admin WHERE  admin_id = '$admin_id' ";
                $query = $this->conn->query($sql);
                $row = $query->fetch_assoc();
                if(($password == $row['password'])){
                    $found = true;	
                    }
                    return $found;
            }
        }




}

$admin = new admin;
?>