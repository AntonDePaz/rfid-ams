<?php 

include '../includes/conn.php';

if(isset($_POST['geteventidtshirt']) && isset($_POST['tshirtamount']) )
{
		$geteventidtshirt = $_POST['geteventidtshirt'];
    $tshirtamount = $_POST['tshirtamount'];
    $costall = 0;

	 				$output = "";
                         $output .= '<div class="row tshirt_stats" >';
                        
                          $countall = 0;
                       
                        $sql = "SELECT size".$geteventidtshirt.",count(*) as countsize FROM tshirt_size".$_SESSION['sy_id']." where size".$geteventidtshirt." <> '' group by size".$geteventidtshirt." order by size".$geteventidtshirt." asc";
                              $query = $db->query($sql);
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












 ?>