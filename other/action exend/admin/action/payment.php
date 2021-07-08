
<?php

include '../model/payment.php';
$payment = new payment();

if(isset($_POST['get_student_info'])){

    $id = $_POST['get_student_info'];
    $result = $payment->get_info_student($id);
    echo json_encode($result);
}

if(isset($_POST['record'])){
    $id = $_POST['record'];
    $result = $payment->get_info_payment($id);
    echo json_encode($result);
}

?>