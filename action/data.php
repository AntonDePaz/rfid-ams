<?php

include '../model/data.php';
$datA = new datA();

if(isset($_POST['academic_year']))
{
    $ay = $_POST['academic_year'];
    $result = $datA->add_AY($ay);
    echo $ay;

}
if(isset($_POST['check_academic_year']))
{
    $ay = $_POST['check_academic_year'];
    $result = $datA->check_AY($ay);
    echo $result;

}
if(isset($_POST['val'])){
    $result = $datA->showTable();
    echo json_encode($result);
}

if(isset($_POST['table_id']))
{
    $tid = trim($_POST['table_id']);
    $result = $datA->DroP($tid);
    echo json_encode($result);

}
if(isset($_POST['sy_id101']) && isset($_POST['datatype']))
{
   
    $sy_id = json_decode(trim($_POST['sy_id101']));
    $datatype = json_decode(trim($_POST['datatype']));
    $result = $datA->TrunC($sy_id,$datatype);
    echo json_encode($result);

}


?>