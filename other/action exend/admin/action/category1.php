<?php

include '../model/category.php';
$category = new category();


if(isset($_POST['cname']) && isset($_POST['cvalue']))
 {
 	 $cn = trim($_POST['cname']);
      $cv = $_POST['cvalue'];

      $result = $category->add_category($cn,$cv);
      echo $result;

        

 }

if(isset($_POST['id']) && isset($_POST['col']))
{
	$id = $_POST['id'];
	$col = $_POST['col'];

    $result = $category->edit_category($id,$col);
    echo $result;
 // echo "del id:".$id;
 // echo "del col:".$col;
	  

  }

  if(isset($_POST['val']))
{
    $result = $category->loadtable();
    echo json_encode($result);
 // echo "del id:".$id;
 // echo "del col:".$col;
	  

  }















?>