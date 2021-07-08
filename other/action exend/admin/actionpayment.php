
<?php 

 $db  = mysqli_connect('localhost','root','', 'test_login');



// if(isset($_POST['id'])){
// 		$id = $_POST['id'];
// 		$sql = "SELECT *  FROM students s left join activities_fines a on a.afstudent_id = s.student_id where s.student_id = '$id' ";
//         $query = $db->query($sql);
// 		while($row = $query->fetch_assoc())
// {
// 		echo json_encode($row);
// 	}

// }

if(isset($_POST['record'])){
    adminallrecord();
}



function adminallrecord(){


	$id = $_POST['record'];

	global $db;
		//$value = "";
		$value = '<table class="table">
			                <thead>
			                  <th width="1%"><input type="checkbox"></th>
			                  <th>Description</th>
			                  <th>Amount</th>
			                  
			                </thead>'; 


                      $amountfee = array();
                      $idfee = 0;
                      $rowindex = 0;


                       $eventida = array();
                       $feeida = array();
                       $eventamount = array();
                       $feeamount = array();
                       $Description = array();
                       $eida = 0;$fida = 0;

                        $totalall = 0;
                     $sql = "SELECT * FROM new_feevent order by id";
                     $query = $db->query($sql);
                    while($row = $query->fetch_assoc()){
                      $feeida[$fida] = $row['id'];
                      $feeamount[$fida] = $row['amount'];
                      $Description[$fida] = $row['description'];
                      $fida++;
                     
                    }

                    // $sql = "SELECT * FROM chargecost order by id";
                    // $query = $db->query($sql);
                    // while($row = $query->fetch_assoc()){
                    //  $amountfee[$rowindex++] = $row['payamount'];
                    //  $idfee = $row['id'];}


                    //        $rowin = 0;
                    //       $amot = 350;

                          $amotan = 0;
                         


		          $sql = "SELECT *  FROM students s left join activities_fines a on a.afstudent_id = s.student_id where s.student_id = '$id' ";
                    $query = $db->query($sql);
                    $row = $query->fetch_assoc();
                            for($a=0; $a <  count($feeida); $a++)
                            {
                            	$amotan = $feeamount[$a] - $row['a'.$feeida[$a].''];
	                              if( is_null($row['a'.$feeida[$a].'']))
	                              {
	                               $value.='<tr>';
	                                $value .= '<td><input id="getchk" type="checkbox" name="amount[]"></td>';
	                               $value .= '<td>'.$Description[$a].' </td>';
	                             $value .= '<td> &#8369 '.$feeamount[$a].'</td>';
	                            
	                              $value.='<tr>';
	                              }
	                             else
	                              {
	                               $value.='<tr>';
	                                $value .= '<td><input id="chk" type="checkbox" name="amount[]"></td>';
	                               $value .='<td>'.$Description[$a].'</td>';
	                               if($amotan == 0){
	                               		$value .= '<td> &#8369 '.$amotan.'</td>';
	                               		
	                               }
	                               else{
	                               	$value .= '<td> &#8369 '.$amotan.'</td>';
	                                	
	                               }
	                              
	                             
  								  $value.='<tr>';
	                              
	                              }
	                               $totalall += $amotan; 

                            }

                            $value .= '<tr>
                    <td>TOTAL  </td>
                   <td> </td>
                   <td>&#8369 '.$totalall.'</td>
                  </tr>';
		$value.='</table>';

		
		echo json_encode(['status'=>'success','html'=>$value]);


}












 ?>










 