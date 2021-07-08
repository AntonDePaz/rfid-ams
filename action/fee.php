<?php

include '../model/fee.php';
//$fee = new fee();
if(session_status() == PHP_SESSION_NONE)
{session_start();}
if(isset($_POST['description']) && isset($_POST['amount']) && isset($_POST['option']) )
{
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $type = $_POST['option'];
    // echo ' des:'.$description;
    // echo ' amount:'.$amount;
    // echo ' type:',$type;
    $insert = $fee->add_fee($description,$amount,$type);
   echo $insert;
   
}
if(isset($_POST['geteventid']) && isset($_POST['amount']) )
{
    $eventid = trim($_POST['geteventid']);
    $amount = trim($_POST['amount']);

    $_SESSION['set_fee_id'] = $eventid;

    $data = $fee->load_fee_table($eventid,$amount);
    echo $data;


}

if(isset($_POST['fee_eventid']) && isset($_POST['concat_studentid']) && isset($_POST['amount']) )
{

    $fee_id = trim($_POST['fee_eventid']);
	$amount = trim($_POST['amount']);
	$concat_studentid = trim($_POST['concat_studentid']);

    // echo $fee_id;
    // echo $amount;
    // echo $concat_studentid;

   $result = $fee->remove_from_fee($fee_id,$concat_studentid,$amount);
   //echo $result;


    

}

if (isset($_POST['getfeeidtshirt'])  ) 
{

    $getfeeidtshirt = trim($_POST['getfeeidtshirt']);

    //echo $getfeeidtshirt;
   $result = $fee->load_tshirt_sizes($getfeeidtshirt);
   echo json_encode($result);



                           

}

// if(isset($_POST['fee_lang']))
// {   
//     // $geteventidtshirt = $_POST['geteventidtshirt'];
//     // $tshirtamount = $_POST['tshirtamount'];
//     //echo "1".$geteventidtshirt;
//     //echo "2".$tshirtamount;
//     $result = $fee->show_fee_table();
//    echo json_encode($result);
// }

if(isset($_POST['load_select_tshirt']))
{
    // $geteventidtshirt = $_POST['geteventidtshirt'];
    // $tshirtamount = $_POST['tshirtamount'];
    //echo "1".$geteventidtshirt;
    //echo "2".$tshirtamount;
    $result = $fee->load_tshirt_cmb();
   echo json_encode($result);
}

if(isset($_POST['load_select_fee']))
{
    // $geteventidtshirt = $_POST['geteventidtshirt'];
    // $tshirtamount = $_POST['tshirtamount'];
    //echo "1".$geteventidtshirt;
    //echo "2".$tshirtamount;
    $result = $fee->load_fee_cmb();
   echo json_encode($result);
}


if(isset($_POST['all_fee']))
{
    // $geteventidtshirt = $_POST['geteventidtshirt'];
    // $tshirtamount = $_POST['tshirtamount'];
    //echo "1".$geteventidtshirt;
    //echo "2".$tshirtamount;
    $result = $fee->showall_fee();
   echo json_encode($result);
}

if(isset($_POST['geteventidtshirt']) && isset($_POST['tshirtamount']) )
{
    $geteventidtshirt = $_POST['geteventidtshirt'];
    $tshirtamount = $_POST['tshirtamount'];
    //echo "1".$geteventidtshirt;
    //echo "2".$tshirtamount;
    $result = $fee->load_tshirt_table($geteventidtshirt,$tshirtamount);
   echo json_encode($result);
}

if(isset($_POST['student_id']) && isset($_POST['tshirt_size']) && isset($_POST['fee_id']) && isset($_POST['tshirt_amount'])  )
{
    $student_id = $_POST['student_id'];
    $tshirt_size = $_POST['tshirt_size'];
    $fee_id = trim($_POST['fee_id']);
    $tshirtamount = $_POST['tshirt_amount'];

    $result = $fee->save_tshirt_sizes($student_id,$tshirt_size,$fee_id,$tshirtamount);
    //echo $result;

}

if(isset($_POST['fee_deleteid'])){
    $id = $_POST['fee_deleteid'];
    $result = $fee->delete_fee($id);
    echo $result;
		
		
}

if(isset($_POST['get_fee_edit_id'])){
    $id = $_POST['get_fee_edit_id'];
    $result = $fee->get_fee_info($id);
    echo json_encode($result);
		
		
}

if(isset($_POST['edit_fee_id']) && isset($_POST['description']) && isset($_POST['amount'])){

        $id = trim($_POST['edit_fee_id']);
		$description = $_POST['description'];
		$amount = $_POST['amount'];
        $result = $fee->edit_fee($id,$description,$amount);
       echo $result;

		
}


?>


