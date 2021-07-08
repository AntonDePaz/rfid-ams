
 <?php
require_once('connection.php');
// if(session_status() == PHP_SESSION_NONE)
// {session_start();}//start session if session not start
class attendance extends Database{

	public function activate_attendance($data = []){

		if(isset($_SESSION['sy_id']) && !empty($data)){
            $time = date("h:i:sa");
            $activate_id = mysqli_real_escape_string($this->conn,$data[0]);
            $eventid = $data[1];
            $status = $data[2];
            if($status == 1){
                $tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id` = ?,`timeactivate`= '$time'  WHERE as_id = ? ";
               // mysqli_query($this->conn,$tsql);
                $stmt = mysqli_stmt_init($this->conn);
                if(mysqli_stmt_prepare($stmt,$tsql))
                {
                mysqli_stmt_bind_param($stmt, 'ii', $eventid,$activate_id);
                mysqli_stmt_execute($stmt);
                }
            
                $tsql = "UPDATE `attendance_status` SET `status`='deactivate',`fee_event_id` = '0' ,`timeactivate`='' WHERE as_id <> '$activate_id' ";
                mysqli_query($this->conn,$tsql);
             }
             else{
                 $tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id` = '',`timeactivate`='' WHERE as_id = '$activate_id' ";
                mysqli_query($this->conn,$tsql);
            
                $tsql = "UPDATE `attendance_status` SET `status`='activate',`fee_event_id` = '0',`timeactivate`='' WHERE as_id <> '$activate_id' ";
                mysqli_query($this->conn,$tsql);
            
             }

             $value = "";
               $value .= '<table class="table" id="attendance_status_table">';                        
                     $content = array('Time In morning','Time Out morning','Time In afternoon','Time Out afternoon','Time In evening','Time Out evening');
                    
                    $sql = "SELECT tap FROM fee_event where fe_id = '$eventid' ";
                    $query = $this->conn->query($sql);
                    $row = $query->fetch_assoc();
                    $pon = $row['tap'];
                      $countthis = 0; $get_status = 0;
                   	$set_status = false;
                      $sql = "SELECT * FROM attendance_status ";
                     $query = $this->conn->query($sql);
                     while($row = $query->fetch_assoc())
                    {
                      $id = $row['as_id'];
                      $status = $row['status'];
                      $geteventid = $row['fee_event_id'];
                     if($countthis == $pon){break;}
                      if( $geteventid == $eventid && $status == 'activate')
                      {
                      	$set_status = true;
                       $value .=  " <tr>
                              <td>".$content[$countthis]."</td>
                              <td><a title='delete' class='btn btn-danger btn-xs activate' data-id='".($countthis+1)."'><span id='deac'>deactivate</span></a></td>
                            </tr>";
                      }
                      else{
                             $value .= "<tr>
                              <td>".$content[$countthis]."</td>
                              <td><a title='delete' class='btn btn-success btn-xs deactivate' data-id='".($countthis+1)."'><span id='ac'>activate</span></a></td>
                            </tr>  ";
                      }
                       $countthis++;

                    }
                    
                    if(!$set_status){
                      $get_status = 0;
                    }
                    else{
                      $get_status = 1;
                    }
                     // echo "".$hai;

                   $value .= '</table> <input type="hidden" class="get_status" value='.$get_status.'>';



                   return $value;
            

                }

        } # end function



        public function remove_student_from_event($data = []){

          #var_dump($data);

          if(!empty($data && isset($_SESSION['sy_id']))){
            $event_id = $data[0];
            $concat_all_student_id = $data[1];


          $cost = 0;
          $sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id'";
          $query = $this->conn->query($sql);
            while($row = $query->fetch_assoc())
          {
            $fines =  $row['fines'];
            $tap =  $row['tap'];
            $cost = $fines * $tap;
            }

          $stringval = trim(rtrim($concat_all_student_id,','));

          $pieces = explode(",", $stringval);

          print_r($pieces);

            for($i = 0;$i< count($pieces);$i++)
          {
            
            $student_id = trim($pieces[$i]);

                $sql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET `at_status`= '1' WHERE at_fee_event_id = ? and at_student_id = ? ";
                $stmt = mysqli_stmt_init($this->conn);
                if(mysqli_stmt_prepare($stmt,$sql))
                {
                mysqli_stmt_bind_param($stmt, 'ii', $event_id,$student_id);
                mysqli_stmt_execute($stmt);
                }

                $found = 0;
                $sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." WHERE ml_student_id = '$student_id' ";
                $query = $this->conn->query($sql);
                  while($row = $query->fetch_assoc())
                  {
                  $found = true;
                  }

                  if(!$found)
                  {
                    $sql = "INSERT INTO masterlist".$_SESSION['sy_id']." ( `ml_student_id`, pay".$event_id." ) VALUES ('$student_id','$cost')";
                    $stmt = mysqli_stmt_init($this->conn);
                    if(mysqli_stmt_prepare($stmt,$sql))
                    {
                    mysqli_stmt_bind_param($stmt, 'id', $student_id,$cost);
                    mysqli_stmt_execute($stmt);
                    }
                  }
                  else
                  {
                  $sql = "UPDATE masterlist".$_SESSION['sy_id']." SET  pay".$event_id." = '0' WHERE ml_student_id = '$student_id' ";
                 $query = $this->conn->query($sql);
                //  if($query){
                //    echo 'succes01';
                //  }else{
                //    echo 'erro01';
                //  }
                  // if($conn->query($sql))
                //   {
                //     //$_SESSION['success'] = 'Voter added successfully';
                //     echo "UPDATED successfully";
                //   }
                // //  else
                //   {
                //     //$_SESSION['error'] = $conn->error;
                //     echo " error: ".$this->conn->error;
                //   }
                 // }
                }

                }
            
          }



        } # end function

        public function attendance_per_event_status($eventid, $time){
            if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id'])){
            $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid' and s.sem".$_SESSION["sem_id"]." = 1   order by at_status, year,firstname";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                $data[] = $row;
              }
              return $data;
            }
           }
        }

        public function filter_students_course($eventid,$course){
          if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']) && !empty($eventid) ){

            //$eventid = $_POST['eventid'];
            //echo 'sud';
           // echo 'course:'.$course;
           // echo ' event:'.$eventid;

           //attended filter_course

            $lastacivate = 0;
            $lasttime = "";
            $sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eventid' order by timeactivate asc ";
            $query3 = $this->conn->query($sql3);
            while($row3 = $query3->fetch_assoc())
            {
              $lastacivate = $row3['as_id'];
              $lasttime = $row3['time'];
              $lasttime = trim($lasttime);
            }
            $value = "";


                    $var = 'sem'.$_SESSION["sem_id"].'';
                    $count = 1;
                    $found = false;
                    $type_row = '';
                    $sql = "SELECT * from students".$_SESSION['sy_id']." as s inner join attendance_tap".$_SESSION['sy_id']." as at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid'  and s.sem".$_SESSION["sem_id"]." = 1  order by at.".$lasttime.", s.year,s.firstname";
                     $query = $this->conn->query($sql);
                    while($row = $query->fetch_assoc())
                    { 
                     
                      if($course == 'attended'){

                        if(trim(strtolower($row[''.$lasttime.''])) != ''){
                          $found = true;
                      $value .= '<tr>
                            <td>'. $count++.'</td>
                            <td>'.$row['student_id'].'</td>
                            <td>'.$row['id_number'].'</td>
                            <td>'.ucwords($row['firstname']).'</td>
  
                            <td>'.ucwords($row['lastname']).'</td>
                            <td>'.ucwords($row['year']).'</td>
                            <td>'.ucwords($row['section']).'</td>
                            <td>'.ucwords($row['course']).'</td>
                            <td>'.ucwords($row['major']).'</td>';
                            if($row[''.$lasttime.''] != ''){
                              $value .= '<td> <span style="background-color:green;" class="badge badge-success"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-check"></i></span> </td>';
                            }
                            else{
                                $value .= '<td><span style="background-color:#cc0000;" class="badge badge-danger"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-remove"></i></span></td>';
                                $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                            }
  
                          $value .= '</tr>';
                          }

                      }else if($course == 'nattended'){

                        if(trim(strtolower($row[''.$lasttime.''])) == ''){
                          $found = true;
                      $value .= '<tr>
                            <td>'. $count++.'</td>
                            <td>'.$row['student_id'].'</td>
                            <td>'.$row['id_number'].'</td>
                            <td>'.ucwords($row['firstname']).'</td>
  
                            <td>'.ucwords($row['lastname']).'</td>
                            <td>'.ucwords($row['year']).'</td>
                            <td>'.ucwords($row['section']).'</td>
                            <td>'.ucwords($row['course']).'</td>
                            <td>'.ucwords($row['major']).'</td>';
                            if($row[''.$lasttime.''] != ''){
                              $value .= '<td> <span style="background-color:green;" class="badge badge-success"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-check"></i></span> </td>';
                            }
                            else{
                                $value .= '<td><span style="background-color:#cc0000;" class="badge badge-danger"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-remove"></i></span></td>';
                                $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                            }
  
                          $value .= '</tr>';
                          }
                      
                      } else{
                       

                      if(trim(strtolower($row['course'])) == trim(strtolower($course))){
                        $found = true;
                    $value .= '<tr>
                          <td>'. $count++.'</td>
                          <td>'.$row['student_id'].'</td>
                          <td>'.$row['id_number'].'</td>
                          <td>'.ucwords($row['firstname']).'</td>

                          <td>'.ucwords($row['lastname']).'</td>
                          <td>'.ucwords($row['year']).'</td>
                          <td>'.ucwords($row['section']).'</td>
                          <td>'.ucwords($row['course']).'</td>
                          <td>'.ucwords($row['major']).'</td>';
                          if($row[''.$lasttime.''] != ''){
                            $value .= '<td> <span style="background-color:green;" class="badge badge-success"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-check"></i></span> </td>';
                          }
                          else{
                              $value .= '<td><span style="background-color:#cc0000;" class="badge badge-success"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-remove"></i></span></td>';
                              $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                          }

                        $value .= '</tr>';
                        }
                      }
                      

                    }
                    if(!$found){
                      $val = '';
                      $val .= '<tr>';
                        
                      $val .= '<td colspan="11"><center> No Data Found</center></td>';
                        $val .= '</tr>';
                      return $val;
                    }else{
                      return $value;// ['status'=>'success','html'=>$value];
                    }
                

         
        }
      }


      public function filter_students_year($eventid,$year){
        if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']) && !empty($eventid) ){

          //$eventid = $_POST['eventid'];
          //echo 'sud';
         // echo 'course:'.$course;
         // echo ' event:'.$eventid;
          $lastacivate = 0;
          $lasttime = "";
          $sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eventid' order by timeactivate asc ";
          $query3 = $this->conn->query($sql3);
          while($row3 = $query3->fetch_assoc())
          {
            $lastacivate = $row3['as_id'];
            $lasttime = $row3['time'];
            $lasttime = trim($lasttime);
          }
          $value = "";


                  $var = 'sem'.$_SESSION["sem_id"].'';
                  $count = 1;
                  $found = false;

                  $sql = "SELECT * from students".$_SESSION['sy_id']." as s inner join attendance_tap".$_SESSION['sy_id']." as at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid'  and s.sem".$_SESSION["sem_id"]." = 1  order by at.".$lasttime.", s.year,s.firstname";
                   $query = $this->conn->query($sql);
                  while($row = $query->fetch_assoc())
                  { 
                   
                    if(trim(strtolower($row['year'])) == trim(strtolower($year))){
                      $found = true;
                  $value .= '<tr>
                        <td>'. $count++.'</td>
                        <td>'.$row['student_id'].'</td>
                        <td>'.$row['id_number'].'</td>
                        <td>'.ucwords($row['firstname']).'</td>

                        <td>'.ucwords($row['lastname']).'</td>
                        <td>'.ucwords($row['year']).'</td>
                        <td>'.ucwords($row['section']).'</td>
                        <td>'.ucwords($row['course']).'</td>
                        <td>'.ucwords($row['major']).'</td>';
                        if($row[''.$lasttime.''] != ''){
                          $value .= '<td> <span style="background-color:green;" class="badge badge-success"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-check"></i></span> </td>';
                        }
                        else{
                            $value .= '<td><span style="background-color:#cc0000;" class="badge badge-danger"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-remove"></i></span></td>';
                            $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                        }

                      $value .= '</tr>';
                      }
                    

                  }
                  if(!$found){
                    $val = '';
                    $val .= '<tr>';
                      
                    $val .= '<td colspan="11"><center> No Data Found</center></td>';
                      $val .= '</tr>';
                    return $val;
                  }else{
                    return $value;// ['status'=>'success','html'=>$value];
                  }
              

       
      }
    }





        public function attendance_status_active($eventid){
          if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']) && !empty($eventid) ){
            $sql = "SELECT * FROM `attendance_status` where fee_event_id = '$eventid' order by timeactivate asc ";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                $data = $row;
              }
              return $data;
            }
           }
        }



        public function load_students($eventid){
          if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']) && !empty($eventid) ){

            //$eventid = $_POST['eventid'];
            //echo 'sud';
            $lastacivate = 0;
            $lasttime = "";
            $sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$eventid' order by timeactivate asc ";
            $query3 = $this->conn->query($sql3);
            while($row3 = $query3->fetch_assoc())
            {
              $lastacivate = $row3['as_id'];
              $lasttime = $row3['time'];
              $lasttime = trim($lasttime);
            }
            $value = "";


                    $var = 'sem'.$_SESSION["sem_id"].'';
                    $count = 1;

                    $sql = "SELECT * from students".$_SESSION['sy_id']." s inner join attendance_tap".$_SESSION['sy_id']." at on s.student_id = at.at_student_id and at.at_fee_event_id = '$eventid' and s.sem".$_SESSION["sem_id"]." = 1  order by at.".$lasttime.", s.year,s.firstname";
                     $query = $this->conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {

                    $value .= '<tr>
                          <td>'. $count++.'</td>
                          
                          <td>'.$row['id_number'].'</td>
                          <td>'.ucwords($row['firstname']).'</td>
                          <td>'.ucwords($row['middlename']).'</td>
                          <td>'.ucwords($row['lastname']).'</td>
                          <td>'.ucwords($row['year']).'</td>
                          <td>'.ucwords($row['section']).'</td>
                          <td>'.ucwords($row['course']).'</td>
                          <td>'.ucwords($row['major']).'</td>';
                          if($row[''.$lasttime.''] != ''){
                            $value .= '<td> <span style="background-color:green;" class="badge badge-success"><i style="color:white; margin:0 5px 0 5px; " class="fa fa-check"></i></span> </td>';
                          }
                          else{
                              $value .= '<td> <span style="background-color:#cc0000;" class="badge badge-danger"><i style="color:white;  margin:0 5px 0 5px; " class="fa fa-remove"></i></span></td>';
                              $value .= '<td><input  type="checkbox" id="chk_getid" data-id="'.$row['student_id'].'"></td>';
                          }

                        $value .= '</tr>';


                    }

                 return ['status'=>'success','html'=>$value];

         
        }
      }




      public function rfid_attendance_student($event_id,$rfid){


        $time = date("h:i:sa");
        $taptime = $time;
      //   $stringval = trim(rtrim($all_student_id,','));
      //   $student_id_array = explode(",", trim($stringval));

      // // print_r($student_id_array);
      //  // echo ' eventid:'.$event_id;
          $fn = '';$ln = '';$mn = ''; $course = "";
          $year = ""; $major = ""; $section ="";

          $cost = 0;
          $totalamount_event = 0;
          $student_id = 0;
          $sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id'";
          $query = $this->conn->query($sql);
          while($row = $query->fetch_assoc())
        {
          $cost =  $row['fines'];
          $totalamount_event = $row['amount'];
        }

        $found_student = false;
        $sql = "SELECT * FROM students".$_SESSION['sy_id']." WHERE rfid = '$rfid'";
        $query = $this->conn->query($sql);
        while($row = $query->fetch_assoc())
       {
        $found_student = true;
        $student_id =  $row['student_id'];
        $fn = $row['firstname'];$ln = $row['lastname'];$mn = $row['middlename']; $course = $row['course'];
        $year = $row['year']; $major = $row['major']; $section= $row['section'];
       }

       if($found_student){

        $lastacivate = 0;
        $lasttime = "";
        $sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$event_id' order by timeactivate asc ";
        $query3 = $this->conn->query($sql3);
        while($row3 = $query3->fetch_assoc())
        {
          $lastacivate = $row3['as_id'];
          $lasttime = $row3['time'];
          $lasttime = trim($lasttime);
        }

        $tsql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET ".$lasttime." = ? WHERE at_student_id = ? and at_fee_event_id = ? ";
       // $this->conn->query($tsql);
        $stmt = mysqli_stmt_init($this->conn);
        if(mysqli_stmt_prepare($stmt,$tsql))
        {
        mysqli_stmt_bind_param($stmt, 'sii', $taptime,$student_id,$event_id);
        mysqli_stmt_execute($stmt);
        }
        $totalamount = 0;
        $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$event_id' and at_student_id = '$student_id'  ";
        $query = $this->conn->query($sql);
              while($row = $query->fetch_assoc())
              {
                if(!empty($row['timein1']))
                {
                  $totalamount += $cost;
                }
                if(!empty($row['timeout1']))
                {
                  $totalamount += $cost;
                }
                if(!empty($row['timein2']))
                {
                  $totalamount += $cost;
                }
                if(!empty($row['timeout2']))
                {
                  $totalamount += $cost;
                }
                if(!empty($row['timein3']))
                {
                  $totalamount += $cost;
                }
                if(!empty($row['timeout3']))
                {
                  $totalamount += $cost;
                }
              }
              $found1 = false;
                $sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." where ml_student_id = '$student_id' ";
                  $query = $this->conn->query($sql);
              while($row = $query->fetch_assoc())
                {
                  $found1 = true;
                }


                $pay = 'pay'.trim($event_id).'';
              $pay = trim($pay);

                if(!$found1)
                {	
                  //echo "insert into masterlist";
                          $sql = "INSERT INTO masterlist".$_SESSION['sy_id']." (ml_student_id, ".$pay." ) VALUES (?,?)";
                //mysqli_query($conn, $sql); 
                 // $this->conn->query($sql);
                 $stmt = mysqli_stmt_init($this->conn);
                 if(mysqli_stmt_prepare($stmt,$sql))
                 {
                 mysqli_stmt_bind_param($stmt, 'id', $student_id,$totalamount);
                 mysqli_stmt_execute($stmt);
                 }
                  //   return '2';
                  // }
                  // else{
                  // 	return "error: ".$conn->error;
                  // }
              }
              else
              {

                $get_total_amount_value = $totalamount_event - $totalamount;
                //  echo "update into masterlist";
                //$tsql = "UPDATE `masterlist` SET ".$pay." = '$totalamount' WHERE ml_student_id = '$student_id'";
                $tsql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$pay." = ? WHERE ml_student_id =  ? ";
                    //  $this->conn->query($tsql);
                      $stmt = mysqli_stmt_init($this->conn);
                      if(mysqli_stmt_prepare($stmt,$tsql))
                      {
                      mysqli_stmt_bind_param($stmt, 'di', $get_total_amount_value,$student_id);
                      mysqli_stmt_execute($stmt);
                      }
                      
                      // return '3';
                // }
                // else{
                // 	return "error: ".$conn->error;
                // }
    
                }
                return ['status'=>'success','firstname'=>$fn,'middlename'=>$mn,'lastname'=>$ln,'year'=>$year,'section'=>$section,'course'=>$course,'major'=>$major];
              }
              else{
                return ['status'=>'error'];
              }
         


      }






      public function multiple_attendance_student($event_id,$all_student_id){
        if(isset($_SESSION['sem_id']) && isset($_SESSION['sy_id']) && !empty($event_id) && !empty($all_student_id)){

            // $event_id = $_POST['eventid'];
           // $concat_student_id = $_POST['concat_student_id'];
           
            $time = date("h:i:sa");
            $taptime = $time;


            $stringval = trim(rtrim($all_student_id,','));
            $student_id_array = explode(",", trim($stringval));

          // print_r($student_id_array);
           // echo ' eventid:'.$event_id;

              $cost = 0;
              $totalamount_event = 0;
              $sql = "SELECT * FROM `fee_event` WHERE fe_id = '$event_id'";
              $query = $this->conn->query($sql);
              while($row = $query->fetch_assoc())
            {
              $cost =  $row['fines'];
              $totalamount_event = $row['amount'];
            }



            $lastacivate = 0;
            $lasttime = "";
            $sql3 = "SELECT * FROM `attendance_status` where fee_event_id = '$event_id' order by timeactivate asc ";
            $query3 = $this->conn->query($sql3);
            while($row3 = $query3->fetch_assoc())
            {
              $lastacivate = $row3['as_id'];
              $lasttime = $row3['time'];
              $lasttime = trim($lasttime);
            }



	 if(!empty($lasttime))
      {
 			
 			if($all_student_id == "all")
			{
			//	echo "all";
       // return all;
				$var = 'sem'.$_SESSION["sem_id"];
				$count = 1;
				$rsql = "SELECT * from students".$_SESSION['sy_id']." as s inner join attendance_tap".$_SESSION['sy_id']." as at on s.student_id = at.at_student_id and at.at_fee_event_id = '$event_id' and s.sem".$_SESSION["sem_id"]." = 1 ";	                   
			//	$rsql = "SELECT * from students".$_SESSION['sy_id']." as s inner join attendance_tap".$_SESSION['sy_id']." as at on s.student_id = at.at_student_id and at.at_fee_event_id = '$event_id' and s.sem".$_SESSION["sem_id"]." = 1 and at.".$lasttime." = '' order by s.year,s.firstname";
				 $rquery = $this->conn->query($rsql);
				while($row = $rquery->fetch_assoc())
				{  
					$student_id = $row['student_id'];
			

        //  return 3;
            if(empty($row[$lasttime])){
             // echo " Apil>".$student_id."<";
					$tsql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET ".$lasttime." = ? WHERE at_student_id = ? and at_fee_event_id = ? ";
				            // $this->conn->query($tsql);
                     $stmt = mysqli_stmt_init($this->conn);
                     if(mysqli_stmt_prepare($stmt,$tsql))
                     {
                     mysqli_stmt_bind_param($stmt, 'sii', $taptime,$student_id,$event_id);
                     mysqli_stmt_execute($stmt);
                     }
										// {
										// 	echo"successfully attendance_tap";
										// 	//return $con;
										// }
										// else 
										// {
										// 	echo"Cannot update attendance_tap";
										// }


						       $totalamount = 0;
						    	$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$event_id' and at_student_id = ".$student_id."  ";
						          $query = $this->conn->query($sql);
						    	while($row = $query->fetch_assoc())
							     {
							    	if(!empty($row['timein1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein3']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout3']))
							    	{
							    		$totalamount += $cost;
							    	}
							     }


							    $pay = 'pay'.trim($event_id);
							    $pay = trim($pay);

						       
						    	$get_total_amount_value = $totalamount_event - $totalamount;
						    		  // echo "update into masterlist";
						    			//$tsql = "UPDATE `masterlist` SET ".$pay." = '$totalamount' WHERE ml_student_id = '$student_id'";
                      // echo ' sy:'.$_SESSION['sy_id'];
                      // echo ' pay:'.$pay;
                      // echo " gettotal".$get_total_amount_value;
                      // echo ' stuid:'.$student_id;
						        $dsql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$pay." = ? WHERE ml_student_id =  ? ";
						         //   $this->conn->query($dsql);
                     $stmt = mysqli_stmt_init($this->conn);
                     if(mysqli_stmt_prepare($stmt,$dsql))
                     {
                     mysqli_stmt_bind_param($stmt, 'di', $get_total_amount_value,$student_id);
                     mysqli_stmt_execute($stmt);
                     }
										// {
										// 	echo"successfully masterlist";
										// 	//return $con;
										// }
										// else 
										// {
										// 	echo"Cannot update masterlist";
										// }

                    // return 2;
                     }
                    //  else{
                    //   		echo " wa apil>".$student_id."<";
                    //  }
						}  #end while loop select
             // return 1;
            }
           else
           {
            //  echo " not all";
              for($i = 0;$i < count($student_id_array); $i++)
                {
                $student_id = trim($student_id_array[$i]);

				  			// echo " student_id:".$student_id;
		      		//             $found = false;
						    //     $sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']." where at_fee_event_id = '$event_id' and at_student_id = '$student_id' ";
						    //       $query = $conn->query($sql);
						    // 	while($row = $query->fetch_assoc())
							   //   {
							   //  	//if($row['at_fee_event_id'] ==    && $row['at_student_id'] == $id)
							   //  	{
							   //  		$found = true;
							   //  		//echo " found true ";
							   //  	}
							   //    }


							     // if($found == true)
							   //   {
							      	   $tsql = "UPDATE attendance_tap".$_SESSION['sy_id']." SET ".$lasttime." = ? WHERE at_student_id = ? and at_fee_event_id = ? ";
                         $stmt = mysqli_stmt_init($this->conn);
                         if(mysqli_stmt_prepare($stmt,$tsql))
                         {
                         mysqli_stmt_bind_param($stmt, 'sii', $taptime,$student_id,$event_id);
                         mysqli_stmt_execute($stmt);
                         }
										// {
										// 	return "1";
										// 	//return $con;
										// }
										// else 
										// {
										// 	return "Cannot update attendance_tap";
										// }



							      $totalamount = 0;
						    	$sql = "SELECT * FROM attendance_tap".$_SESSION['sy_id']."  where at_fee_event_id = '$event_id' and at_student_id = '$student_id'  ";
						          $query = $this->conn->query($sql);
						    	while($row = $query->fetch_assoc())
							     {
							    	if(!empty($row['timein1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout1']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout2']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timein3']))
							    	{
							    		$totalamount += $cost;
							    	}
							    	if(!empty($row['timeout3']))
							    	{
							    		$totalamount += $cost;
							    	}
							     }



							     $found1 = false;
							       $sql = "SELECT * FROM masterlist".$_SESSION['sy_id']." where ml_student_id = '$student_id' ";
						          $query = $this->conn->query($sql);
						    	while($row = $query->fetch_assoc())
						        {
							    	//if($row[''] == $id)
							    	{
							    		$found1 = true;
							    		//echo " found true ";
							     	}
						        }


						        $pay = 'pay'.trim($event_id).'';
							    $pay = trim($pay);

						        if(!$found1)
						        {	
						        	//echo "insert into masterlist";
						          $sql = "INSERT INTO masterlist".$_SESSION['sy_id']." (ml_student_id, ".$pay." ) VALUES (?,?)";
										//mysqli_query($conn, $sql); 
										 //  $this->conn->query($sql);
                      $stmt = mysqli_stmt_init($this->conn);
                      if(mysqli_stmt_prepare($stmt,$sql))
                      {
                      mysqli_stmt_bind_param($stmt, 'id', $student_id,$totalamount);
                      mysqli_stmt_execute($stmt);
                      }
                      //   return '2';
											// }
											// else{
											// 	return "error: ".$conn->error;
											// }
						    	}
						    	else
						    	{




						    			$get_total_amount_value = $totalamount_event - $totalamount;
						    		  //  echo "update into masterlist";
						    			//$tsql = "UPDATE `masterlist` SET ".$pay." = '$totalamount' WHERE ml_student_id = '$student_id'";
						    			$tsql = "UPDATE masterlist".$_SESSION['sy_id']." SET ".$pay." = ? WHERE ml_student_id =  ? ";
                      $stmt = mysqli_stmt_init($this->conn);
                      if(mysqli_stmt_prepare($stmt,$tsql))
                      {
                      mysqli_stmt_bind_param($stmt, 'di', $get_total_amount_value,$student_id);
                      mysqli_stmt_execute($stmt);
                      }
                             // return '3';
											// }
											// else{
											// 	return "error: ".$conn->error;
											// }
						    	}
						    		
						    	
						    	

		       } //end for loop


        }  
      }
      else
      {
        return " This event time is not activate";
      }










	








        }
      }























    } # end class

$attendance = new attendance();



?>