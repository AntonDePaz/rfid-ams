<?php
require_once('connection.php');
 //if(session_status() == PHP_SESSION_NONE){session_start();}//start session if session not start
class fee extends Database{


  public function showall_fee(){
    if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
        $output = array();
        $data = array();
        $count = 1; $status ='';
        $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."";
        $result = $this->conn->query($sql);
                if($result){
          if($result->num_rows > 0){
           
                    while($row = $result->fetch_assoc()){
                      if($row['fe_status'] == '0')
                      {
                        //$status = "Mandatory";
                        $status = "Contribution Fees";
                      }
                      else
                      {
                        $status = "Tshirt Fees";
                      }
                      $subarray = array();
                      $subarray[] = $count++;
                      $subarray[] = ucwords(strtolower($row['Description']));
                      $subarray[] = "&#8369 ".number_format($row['amount'],2);
                      $subarray[] = $status;
                      $subarray[] = "
                      <a class='btn btn-default btn-xs edit' id=".$row['fe_status']." data-id=".$row['fe_id']."><i class='fa fa-edit'> edit</i></a>
                     <a class='btn btn-default btn-xs del' data-id=".$row['fe_id']."><i class='fa fa-trash-o'> delete</i></a>";
                     $data[] = $subarray;


                    }
          $output = array("data" => $data);
            return $output;
                
            }
        }
  }
}
public function show_fee_table(){
  if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
    $output = array();
    $data = array();
    $count  = 1;
      $sql = "SELECT * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where s.sem".$_SESSION['sem_id']." = 1 order by s.year asc, s.firstname asc";             
      $query = $this->conn->query($sql);
      if($query->num_rows > 0){
      while($row = $query->fetch_assoc()){

        $subarray = array();
        $subarray[] = $count++;
        $subarray[] = "<input type='checkbox' class='ckhbox' data-id=".$row['student_id'].">";
        $subarray[] = $row['id_number'];
        $subarray[] = ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']));
        $subarray[] = $row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']));
        $subarray[] = ucwords(strtolower($row['course']));
        $subarray[] = "<span class='tdamounts'><span class='tdamountloading'>--</span></span>";
        $data[] = $subarray;
      }
      $output = array("data" => $data);
      return $output;
 }
}
    
}

    public function show_all(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
            $found = false;
            $sql = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']."";
            $query = $this->conn->query($sql);
            if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $data[] = $row;
                $found = true;
            }
            if($found){
                return $data; 
            }
          }
            
      }
    }

    public function show_fee(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
            $query = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status <> 1";
            $result = $this->conn->query($query);
            if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            return $data;
          }
      }
    }
    public function show_tshirt(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
            $sQuery = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status = 1 "; // and fe_id <> '$fee_event_id' 
            $result = $this->conn->query($sQuery);
            if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result))
            {
                $data[] = $row;
            }
            return $data;
          }
      }
    }
    
    public function show_all_fee(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
            $sql = "SELECT * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where s.sem".$_SESSION['sem_id']." = 1 order by s.year asc, s.firstname asc";             
            $query = $this->conn->query($sql);
            if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
          }
      }
    }

    public function show_all_tshirt(){
        if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id'])){
            $sql = "SELECT * FROM students".$_SESSION['sy_id']." s left join tshirt_size".$_SESSION['sy_id']." ts on s.student_id = ts.ts_student_id where s.sem".$_SESSION['sem_id']." = 1  order by s.year asc, s.firstname asc ";          
            $query = $this->conn->query($sql);
            if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
          }
      }
    }

    public function tshirt(){
        $sql = "SELECT * FROM category where tshirt_size <> '' order by tshirt_size";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
          }
          
    }

  
   




















	public function add_fee($description,$amount,$type){
            if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id']) && !empty($description) && !empty($amount) ){
                $today = date('Y-m-d');
                $sem = $_SESSION['sem_id'];
                $sy = $_SESSION['sy_id']; 
                $val = '2';
                $query =  "INSERT INTO `fee_event`(`Description`, `date`, `amount`, `type`, `sem_id`, `sy_id`, `fe_status`) VALUES (?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($this->conn);
                if(mysqli_stmt_prepare($stmt,$query))
                {
                 mysqli_stmt_bind_param($stmt, 'ssdiiii', $description,$today,$amount,$val,$sem,$sy, $type);
                 mysqli_stmt_execute($stmt);
                          //echo 'succeds';
                      $fee_id = 0;
                    $sQuery = "SELECT fe_id FROM fee_event order by fe_id";
                    $result = $this->conn->query($sQuery);
                    while($row = mysqli_fetch_array($result))
                    {
                      $fee_id = trim($row['fe_id']);
                      echo $fee_id;
                    }
                
                        $sq = "ALTER TABLE masterlist".$_SESSION['sy_id']." ADD column pay".$fee_id." decimal(10,2)";
                        mysqli_query($this->conn, $sq);
                    echo 'type:'.$type;
                    if($type == 1)
                    {
                        $sq = "ALTER TABLE tshirt_size".$_SESSION['sy_id']." ADD column size".$fee_id." varchar(200)";
                        mysqli_query($this->conn, $sq);
                        echo 101;
                    }
                    else
                    {
                        echo 102;
                        $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = ?  WHERE 1 ";
                        $stmt = mysqli_stmt_init($this->conn);
                        if(mysqli_stmt_prepare($stmt, $sql))
                        {
                         mysqli_stmt_bind_param($stmt, 'd', $amount);
                         mysqli_stmt_execute($stmt);
                         }
                    }
         
         
            } else { echo 'error mysqli';}
		  }

		}
    

    public function load_tshirt_cmb(){
      $output = '';
      $query = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status = 1 ";
      $result = $this->conn->query($query);
      if($result->num_rows > 0){
        $output .= '<option style="font-style: italic; color: gray;" value="0">Choose tshirt</option>';
      while($row = mysqli_fetch_array($result)){
        $output .= "<option value='".$row['fe_id']."' data-id=".$row['amount'].">".ucwords($row['Description'])."</option>";
       }

       return $output;

    }
  }

    public function load_fee_cmb(){
      $output = '';
      $query = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status <> 1";
      $result = $this->conn->query($query);
      if($result->num_rows > 0){
        $output .= '<option style="font-style: italic; color: gray;" value="0">Select Fee</option>';
      while($row = mysqli_fetch_array($result)){
        $output .= "<option data-id=".$row['fe_id']." value='".$row['amount']."'>".ucwords($row['Description'])."</option>";
       }

       return $output;

    }
  }

        public function load_fee_table($eventid,$amount){

            if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id']) && !empty($eventid) && !empty($amount) ){

            $output = "";
            $countz = 1;
            $costall = 0;
              //  $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 order by year asc, firstname asc";
              // $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 and student_id not in (SELECT ml_student_id FROM masterlist where pay".$geteventid." <> '') order by year asc, firstname asc";
              $sql = "SELECT  * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where sem".$_SESSION['sem_id']." = 1 order by pay".$eventid." desc , s.year asc, s.firstname asc ";
                $query = $this->conn->query($sql);
                if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    
                    {
                    if($row['pay'.$eventid.''] > 0)
                    {
                      $output .= "
                        <tr>
                          <td>".$countz++."</td>
                          <td title='Mark to remove student' ><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
                          <td>".$row['id_number']."</td>
                          <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                          <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                          <td>".ucwords(strtolower($row['course']))."</td>
                          <td class='tdamount'> <span class='tdamountloading'> &#8369 ".number_format($amount,2)." </span></td>
                        </tr>
                      ";
                      $costall += $amount;
                      }
                      else
                      {
                        #<input type='checkbox' class='nckhbox' data-id=".$row['student_id'].">
                        $output .= "
                          <tr style='background-color:lightgray;'>
                            <td>".$countz++."</td>
                            <td> <i class='fa fa-close'></i> </td>
                            <td>".$row['id_number']."</td>
                            <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                            <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                            <td>".ucwords(strtolower($row['course']))."</td>
                            <td class='tdamount'><span style='  text-decoration: line-through; text-decoration-color:#000; ' class='tdamountloading'> &#8369 ".number_format($amount,2)." </span></td>
                          </tr>
                        ";

                      }

                      
                  }
             
              }
              $output .= '<input type="hidden" class="totalfee" value="'.$costall.'">';
              echo $output;
            }

            }


        }


        public function remove_from_fee($fee_id,$concat_studentid,$amount){

            if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id']) && !empty($fee_id) && !empty($amount) && !empty($concat_studentid) ){

            $concat_student_id = trim(rtrim($concat_studentid,','));
            $piece_student_id = explode(",", $concat_student_id);
            
           // print_r($piece_student_id);

            for($i = 0;$i < count($piece_student_id); $i++)
            {
          $sql = " UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = '0' WHERE ml_student_id = ? ";
          $stmt = mysqli_stmt_init($this->conn);
          if(mysqli_stmt_prepare($stmt,$sql))
          {
            mysqli_stmt_bind_param($stmt, 'i', $piece_student_id[$i]);
            mysqli_stmt_execute($stmt);
           // $this->conn->query($sql);
            }
         } 
        }



}


public function load_tshirt_sizes($getfeeidtshirt){

    if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id']) && !empty($getfeeidtshirt)){

        $output = "";
        $sql1 = "SELECT * FROM fee_event where fe_id = '$getfeeidtshirt' ";
        $query1 = $this->conn->query($sql1);
        $row1 = $query1->fetch_assoc(); 
        $amount = $row1['amount'];
          $countz = 1;
          $sql = "SELECT * FROM students".$_SESSION['sy_id']." as s left join tshirt_size".$_SESSION['sy_id']." ts on s.student_id = ts.ts_student_id where s.sem".$_SESSION['sem_id']." = 1  order by s.year asc, s.firstname asc ";
       
          $query = $this->conn->query($sql);
          while($row = $query->fetch_assoc()){
            
            
             $output .= "<tr class='getinfos'>
                <td>".$countz++."</td>
                <td>".$row['id_number']."</td>
                <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                <td>".ucwords(strtolower($row['course']))."</td>";
                
               if(!empty($row['size'.$getfeeidtshirt.'']))
                 { 
                 $output .= "<td  class='text-info tdshirt'>  reserved </td>";

                   } 
                   else{
                    $output .= "<td class='tdshirt'></td>";
                   }
              
                 if(!empty($row['size'.$getfeeidtshirt.'']))
                  { 
                    $output .= "<td class='tdshirt'> &#8369 ".number_format($amount,2)."</td>";
                     }
                     else{
                      $output .= "<td class='tdshirt'></td>";
                     }
                
                $output .= "<td class='tdsize".$row['student_id']."'><span class='tdshirt'>".$row['size'.$getfeeidtshirt.'']."</span></td>";
               
               $output .= "<td class='hoversize' data-id='".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."'>
                   <select title='T-Shirt Sizes' class ='form-control pull-left size' name ='size' id='size' data-id=".$row['student_id'].">";
                   $output .= "<option value=''></option>";
                   $output .= "<option value='cancel' style='color: red;'>cancel</option>";
                     $sqlw = "SELECT * FROM category where tshirt_size <> '' order by tshirt_size ";
                      $queryw = $this->conn->query($sqlw);
                      while($roww = $queryw->fetch_assoc()){
                       
                  $output .= "<option value='".$roww['tshirt_size']."'>".$roww['tshirt_size']."</option>";
                   
                      } 
                   $output .= " </select>";
                    

               $output .= "  </td> </tr> ";
        
          }

      
   return $output; 





    }

}



public function load_tshirt_table($geteventidtshirt,$tshirtamount){

    
    $costall = 0;

	 				$output = "";
                         $output .= '<div class="row tshirt_stats" >';
                        
                          $countall = 0;
                       
                        $sql = "SELECT size".$geteventidtshirt.",count(*) as countsize FROM tshirt_size".$_SESSION['sy_id']." where size".$geteventidtshirt." <> '' group by size".$geteventidtshirt." order by size".$geteventidtshirt." asc";
                      
                        // $stmt = mysqli_stmt_init($this->conn);
                        // if(mysqli_stmt_prepare($stmt,$sql))
                        // {
                        //   mysqli_stmt_bind_param($stmt, 'i', $piece_student_id[$i]);
                        //   mysqli_stmt_execute($stmt);
                        //   $this->conn->query($sql);
                          
                          
                        $query = $this->conn->query($sql);
                              while($row = $query->fetch_assoc()){ 
                                $countall += $row['countsize'];
                                  
                               $output .= '<div class="col-md-2">
                                    <label style="font-size: 10px;">'.$row['size'.$geteventidtshirt.''].' : <span>'.$row['countsize'].'</span> pcs</label>
                                </div>';
                          
                                } 

                            $output .= ' <div class="col-md-2 pull-right">
                            <label style="font-size: 10px;">All: <span style="font-size: 11px;">'.$countall.'</span> pcs</label>
                            </div>';
                             $output .= '</div>';
                              $costall = $countall * $tshirtamount;
                             $output .= '<div class="row text-info"> <div class="col-md-2 pull-right">
                            <label style="font-size: 10px;">Cost All: <span style="font-size: 11px;"> &#8369 '.number_format($costall,2).'</span> </label>
                            </div> </div>';
                     


                        	echo $output;
}



public function save_tshirt_sizes($student_id,$tshirt_size,$fee_id,$tshirtamount){

    if(isset($_SESSION['sy_id']) && isset($_SESSION['sem_id']) && !empty($student_id) && !empty($tshirt_size) && !empty($fee_id) && !empty($tshirtamount) ){

    $concat_student_id = trim(rtrim($student_id,','));
    $concat_tshirt_size = trim(rtrim($tshirt_size,','));

    $piece_student_id = explode(",", $concat_student_id);
    $piece_tshirt_size = explode(",", $concat_tshirt_size);

	// echo " fee_id:".$fee_id;
	// echo " tshirt_amount:".$tshirt_amount;
	//print_r($piece_student_id);
	//print_r($piece_tshirt_size);

	

    for($i = 0;$i< count($piece_student_id);$i++)
	{
			//echo ">".$piece_student_id[$i].":".$piece_tshirt_size[$i]."<";

			$tshirt_sizes = $piece_tshirt_size[$i];
			  if($tshirt_sizes == 'cancel'){
			  	$tshirt_sizes = '';
			  }

			 // echo " ts>".$tshirt_sizes.'< sid>'.$piece_student_id[$i]."<";
			 // echo " fee_id:".$fee_id.'< ->amount'.$tshirt_amount;

			$found = false;
			$sql = "SELECT * FROM tshirt_size".$_SESSION['sy_id']." WHERE ts_student_id = '$piece_student_id[$i]'";
			$query = $this->conn->query($sql);
		    while($row = $query->fetch_assoc())
			{
				$found = true;
		    }
			if(!$found)
			{


          $query = "INSERT INTO tshirt_size".$_SESSION['sy_id']." (`ts_student_id`, size".$fee_id." ) VALUES (?,?)";
          $stmt = mysqli_stmt_init($this->conn);
          if(mysqli_stmt_prepare($stmt,$query))
          {
            mysqli_stmt_bind_param($stmt, 'is', $piece_student_id[$i],$tshirt_sizes);
            mysqli_stmt_execute($stmt);
          // $this->conn->query($sql);
          
          }


     // mysqli_query($this->conn, $query);
			}
			else
			{
				$sql = " UPDATE tshirt_size".$_SESSION['sy_id']." SET size".$fee_id." = ? WHERE ts_student_id = ? ";
        $stmt = mysqli_stmt_init($this->conn);
        if(mysqli_stmt_prepare($stmt,	$sql))
        {
          mysqli_stmt_bind_param($stmt, 'si', $tshirt_sizes,$piece_student_id[$i]);
          mysqli_stmt_execute($stmt);
        // $this->conn->query($sql);
        }
			}
			$sql = " UPDATE masterlist".$_SESSION['sy_id']." SET pay".$fee_id." = ? WHERE ml_student_id = ? ";
      $stmt = mysqli_stmt_init($this->conn);
      if(mysqli_stmt_prepare($stmt,	$sql))
      {
        mysqli_stmt_bind_param($stmt, 'di', $tshirtamount,$piece_student_id[$i]);
        mysqli_stmt_execute($stmt);
      }	
	//	echo ">".$piece_student_id[$i].":".$piece_tshirt_size[$i]."<";
	}

  }


}

public function delete_fee($id){
    if(!empty($id) && isset($_SESSION['sy_id'])){
    $sql = "DELETE FROM fee_event WHERE fe_id = ? ";
    $stmt = mysqli_stmt_init($this->conn);
    if(mysqli_stmt_prepare($stmt,	$sql))
    {
      mysqli_stmt_bind_param($stmt, 'i', $id);
      mysqli_stmt_execute($stmt);
        $sql = "ALTER TABLE masterlist".$_SESSION['sy_id']." DROP pay".$id." ";
        if($this->conn->query($sql)){
          return 1;
        }
      }
    }
}


public function get_fee_info($id){
    if(!empty($id))
      {
		$sql = "SELECT * FROM fee_event WHERE fe_id = '$id'";
		$query = $this->conn->query($sql);
		$row = $query->fetch_assoc();
		return $row;
      }
}
 
public function edit_fee($id,$description,$amount){

    if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']) && !empty($id)){
        $sql = "UPDATE fee_event SET Description = ? , amount =  WHERE fe_id = ? ";
        $stmt = mysqli_stmt_init($this->conn);
        if(mysqli_stmt_prepare($stmt,	$sql))
        {
          mysqli_stmt_bind_param($stmt, 'sdi', $description ,$amount,$id);
          mysqli_stmt_execute($stmt);
        }	
      $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET pay".$id." = ? WHERE pay".$id." <> 0";
      if(mysqli_stmt_prepare($stmt,	$sql))
      {
        mysqli_stmt_bind_param($stmt, 'd', $amount);
        mysqli_stmt_execute($stmt);
      }


    }
}


        ////////////////////////////////////////////////////////


        



       

}

//$model = new Model();

$fee = new fee();




 ?>

 

