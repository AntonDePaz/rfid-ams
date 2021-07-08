<?php
require_once('connection.php');
       // if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start
	
class category extends Database{


        public function section(){
                $sql = "SELECT * FROM category where c_section <> '' order by c_section";
                $result = $this->conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        $data[] = $row;
                    }
                    return $data;
                  
        }  
        
        public function year(){
            $sql = "SELECT * FROM category where c_year <> '' order by c_year";
            $result = $this->conn->query($sql);
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
              
        }

        public function course(){
            $sql = "SELECT * FROM category where c_course <> '' order by c_course";
            $result = $this->conn->query($sql);
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
              
        }

        public function major(){
            $sql = "SELECT * FROM category where c_major <> '' order by c_major";
            $result = $this->conn->query($sql);
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
              
        }
		public function tshirt(){
            $sql = "SELECT * FROM category where tshirt_size <> '' order by tshirt_size";
            $result = $this->conn->query($sql);
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
              
        }

        public function add_category($cn,$cv){

            if(!empty($cn) && !empty($cv)){
                 $found = false;
                $sql = "SELECT * FROM category where trim(lower(".$cn.")) = trim(lower(?))";
                           $stmt = mysqli_stmt_init($this->conn);
                            if(mysqli_stmt_prepare($stmt,$sql))
                            {
                            mysqli_stmt_bind_param($stmt, 's', $cv);
                            mysqli_stmt_execute($stmt);
                              $result = mysqli_stmt_get_result($stmt);
                              while($row = mysqli_fetch_assoc($result)){
                                $found = true; 
                                }


                            }
                  //  $query = $this->conn->query($sql);
                    
                    if(!$found)
                    {
                            $sql = "INSERT INTO `category` ( ".$cn." ) values (?) ";
                            $stmt = mysqli_stmt_init($this->conn);
                            if(mysqli_stmt_prepare($stmt,$sql))
                            {
                            mysqli_stmt_bind_param($stmt, 's', $cv);
                            mysqli_stmt_execute($stmt);
                            return 1;
                            }
                           
                    } else{
                      return 2;
                    }
            }
           // loadtable();
        }

        public function edit_category($id,$col){
            if(!empty($id) && !empty($col)){
            $sql = "UPDATE `category` SET ".$col." = ''  WHERE cat_id = ? ";
            //  $this->conn->query($sql);  
              $stmt = mysqli_stmt_init($this->conn);
              if(mysqli_stmt_prepare($stmt,$sql))
              {
              mysqli_stmt_bind_param($stmt, 'i', $id);
              mysqli_stmt_execute($stmt);
              }
            }
           // loadtable();

        }

       public  function loadtable(){
            //global $conn;
            $deleterow = 0;
            
             $sql = "SELECT * FROM category" ;
                    $query = $this->conn->query($sql);
                    while($row = $query->fetch_assoc()){
            
                      if(empty($row['c_course']) && empty($row['c_major']) && empty($row['c_year']) && empty($row['c_section']) && empty($row['tshirt_size']) )
                      {
                          $deleterow = $row['cat_id'];
                          $sql = "DELETE FROM category WHERE cat_id = '$deleterow'";
                          $this->conn->query($sql);
            
                      }
                    }
            
                                  $value = "";
                                   $value .= ' <div class="col-sm-4">
                                      <table class="table">
                                        <th></th>
                                        <th>Course</th>';
                                        
                                            $sql = "SELECT cat_id ,c_course FROM category where c_course <> '' order by c_course  " ;
                                            $query = $this->conn->query($sql);
                                            while($row = $query->fetch_assoc()){
            
                                            
                                       $value .= '<tr>
                                          <td><a title="delete" class="fa fa-trash-o del" data-type="course" data-name='.$row['c_course'].'  id="'.$row['cat_id'].'" data-id="c_course"></a></td>
                                          <td>'.strtoupper($row['c_course']).'</td>
                                        </tr>';
                                          } 
                                     $value .= '</table>
                                    </div>
                                    <div class="col-sm-3">
                                      <table class="table">
                                        <th></th>
                                        <th>Major</th>';
                                        
                                            $sql = "SELECT cat_id ,c_major FROM category where c_major <> '' order by c_major  " ;
                                            $query = $this->conn->query($sql);
                                            while($row = $query->fetch_assoc()){
            
                                            
                                         $value .= '<tr>
                                          <td><a title="delete" class="fa fa-trash-o del" data-type="major" data-name='.$row['c_major'].'  id="'.$row['cat_id'].'" data-id="c_major"></a></td>
                                          <td>'.strtoupper($row['c_major']).'</td>
                                        </tr>';
                                            }
                                     $value .= '</table>
                                    </div>
                                    <div class="col-sm-1">
                                      <table class="table">
                                        <th></th>
                                        <th>Year</th>';
                                         
                                            $sql = "SELECT cat_id ,c_year FROM category where c_year <> '' order by c_year  " ;
                                            $query = $this->conn->query($sql);
                                            while($row = $query->fetch_assoc()){
            
                                            
                                      $value .='<tr>
                                          <td><a title="delete" class="fa fa-trash-o del" data-type="year" data-name='.$row['c_year'].'  id="'.$row['cat_id'].'" data-id="c_year"></a></td>
                                          <td>'.strtoupper($row['c_year']).'</td>
                                        </tr>';
                                          } 
                                     $value .='</table>
                                    </div>
                                    <div class="col-sm-2">
                                        <table class="table">
                                        <th></th>
                                        <th>Section</th>';
                                         
                                            $sql = "SELECT cat_id ,c_section FROM category where c_section <> '' order by c_section  " ;
                                            $query = $this->conn->query($sql);
                                            while($row = $query->fetch_assoc()){
            
                                             
                                       $value .=' <tr>
                                          <td><a title="delete" class="fa fa-trash-o del" data-type="section" data-name='.$row['c_section'].'  id="'.$row['cat_id'].'" data-id="c_section"></a></td>
                                          <td>'.strtoupper($row['c_section']).'</td>
                                        </tr>';
                                       } 
                                     $value .=' </table>
                                    </div>';
            
                                     $value .='</table>
                                    </div>
                                    <div class="col-sm-1">
                                        <table class="table">
                                        <th></th>
                                        <th>Tshirt_Size</th>';
                                         
                                            $sql = "SELECT cat_id ,tshirt_size FROM category where tshirt_size <> '' order by tshirt_size  " ;
                                            $query = $this->conn->query($sql);
                                            while($row = $query->fetch_assoc()){
            
                                             
                                       $value .=' <tr>
                                          <td><a title="delete" class="fa fa-trash-o del" data-type="tshirt size" data-name='.$row['tshirt_size'].' id="'.$row['cat_id'].'" data-id="tshirt_size"></a></td>
                                          <td>'.strtoupper($row['tshirt_size']).'</td>
                                        </tr>';
                                       } 
                                     $value .=' </table>
                                    </div>';
            
            
            
            
                            return $value;
            
            
                      
                    
            
            
            }
            




		// public function getstudent($id){
		// 	if(isset($_SESSION['sy_id'])){
		// 	$sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE student_id = '$id' ";
		// 	$result = $this->conn->query($sql);
		// 	if($result->num_rows > 0){
		// 		while($row = $result->fetch_assoc()){
		// 			$data = $row;
		// 		}
		// 		return $data;
		// 	}
		// 	else{
		// 		return 0;
		// 	}
		//   }
		//   else{
		// 	  return 0;
		//   }
		// }






}

//$model = new Model();

$category = new category;





 ?>
