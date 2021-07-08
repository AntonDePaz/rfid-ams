<?php

include '../includes/session.php';


if(isset($_POST['record'])){
    adminallrecord();
}


function adminallrecord(){


	$id = $_POST['record'];

	global $conn;
		$value = "";
		// $value = '<table class="table">
		// 	                <thead>
		// 	                  <th width="1%"></th>
		// 	                  <th>Description</th>
		// 	                  <th>Amount</th>

		// 	                </thead>';


                      $amountfee = array();
                      $idfee = 0;
                      $rowindex = 0;
                      $datenow = date('Y-m-d');


                       $eventida = array();
                       $feeida = array();
                       $eventamount = array();
                       $feeamount = array();
                       $Description = array();
                       $date = array();
                       $eida = 0;$fida = 0;

                        $totalall = 0;
                     $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." order by fe_id";
                     $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $feeida[$fida] = $row['fe_id'];
                      $feeamount[$fida] = $row['amount'];
                      $Description[$fida] = $row['Description'];
                      if($row['type'] == 2){
                      $date[$fida] = date('Y-m-d', strtotime('-1 day', strtotime($row['date'])));
                           }
                           else{
                             $date[$fida] = $row['date'];
                           }
                      $fida++;

                    }

                          $amotan = 0;

                          $found = false;
                          $var = 'sem'.$_SESSION['sem_id'];
		          $sql = "SELECT *  FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on ml.ml_student_id = s.student_id where s.id_number = '$id' or s.rfid = '$id' and s.".$var." = 1 ";
                    $query = $conn->query($sql);
                    $row = $query->fetch_assoc();
                            for($a=0; $a < count($feeida); $a++)
                            {
                            	$value.='<tr class="rowx">';
                            	$dates = date('Y-m-d',strtotime($date[$a]));
                            	//echo " datefd:".$dates;
                            	if($datenow > $dates)
                            	{
		                                $value .= '<td><input id="getchk" type="checkbox" name="amount[]"></td>';
                            	 }else{

		                                $value .= '<td><input title="This Event is not yet done." id="getchk" type="checkbox" name="amount[]" disabled></td>';
                            	}
                            	$value .= '<td style="display: none;" id="fee_id">'.$feeida[$a].' </td>';
		                               $value .= '<td style="font-size: 12px; font-style: italic;" >'.$Description[$a].'</td>';
		                               if($row['pay'.$feeida[$a].''] > 0)
		                               {
		                              $value .= '<td> &#8369 '.$row['pay'.$feeida[$a].''].'</td>';

		                               }
		                               else
		                               {
		                               	 $value .= '<td> &#8369 0.00 </td>';
		                               }

                            	  $value.='</tr>';
                                  $totalall += $row['pay'.$feeida[$a].''];
	                             //	echo " amount:".number_format($row['pay'.$feeida[$a].''],2);




                            }

                          //  echo " totalall:".$totalall;
                            $value .= '<tr style="background-color:#e6ffff;" >
                    <td>TOTAL  </td>
                   <td> </td>
                   <td>&#8369 '.number_format($totalall,2).'</td>
                  </tr>';
		//$value.='</table>';
                   $Totalall = number_format($totalall,2);
		if($found == true)
		{
			echo json_encode(['status'=>'error','html'=>$value]);
		}
		else{
		echo json_encode(['status'=>'success','html'=>$value,'total'=>$Totalall]);
	      }

}

 ?>


 <?php



// if($row[$var] == 1)
//                             	{
//                             	$amotan = $feeamount[$a] - $row['pay'.$feeida[$a].''];
// 				                              if( is_null($row['pay'.$feeida[$a].'']))
// 				                              {
// 				                               $value.='<tr class="rowx">';
// 				                                $value .= '<td><input id="getchk" type="checkbox" name="amount[]"></td>';
// 				                                 $value .= '<td style="display: none;" id="fee_id">'.$feeida[$a].' </td>';
// 				                               $value .= '<td>'.$Description[$a].' </td>';
// 				                              $value .= '<td> &#8369 '.$feeamount[$a].'</td>';

// 				                              $value.='</tr>';
// 				                              }
// 				                             else
// 				                              {
// 				                               $value.='<tr class="rowx">';
// 				                                $value .= '<td><input id="getchk" type="checkbox" name="amount[]"></td>';
// 				                                 $value .= '<td style="display: none;" id="fee_id">'.$feeida[$a].' </td>';
// 				                               $value .='<td>'.$Description[$a].'</td>';

// 				                               	$value .= '<td> &#8369 '.$amotan.'</td>';




// 			  								  $value.='</tr>';

// 				                              }
// 				                               $totalall += $amotan;
// 		                           }
// 		                           else
// 		                           {
// 		                           	$value.='<tr class="rowx">';
// 		                                $value .= '<td><input id="getchk" type="checkbox" name="amount[]"></td>';
// 		                                 $value .= '<td style="display: none;" id="fee_id">'.$feeida[$a].' </td>';
// 		                               $value .='<td>'.$Description[$a].'</td>';

// 		                               	$value .= '<td> &#8369 0.00</td>';
// 	  								  $value.='</tr>';
// 		                           $found = true;
// 		                           }



















  ?>
