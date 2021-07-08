<?php 


include '../includes/session.php';


if(isset($_POST['cname']) && isset($_POST['cvalue']))
 {
 	 $columname = trim($_POST['cname']);
   $columnvalue = $_POST['cvalue'];

        $found = false;
       $sql = "SELECT * FROM category where trim(lower(".$columname.")) = trim(lower('$columnvalue'))";
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc()){
          $found = true; 
        }










 //    $countbycategory = 0; 
 //    $countallcategory = 0;
 //    $getidbycategory = 0;
	// $sql = "SELECT *  FROM category";
 //   $query = $conn->query($sql);
 //   while($row = $query->fetch_assoc())
 //    {
 //    	if(!empty($row[$columname]))
 //    	{
 //    	  $countbycategory++;
 //         }
 //    }
	// $sql = "SELECT *  FROM category";
 //    $query = $conn->query($sql);
 //    while($row = $query->fetch_assoc())
 //    {
 //    	if($countallcategory == ($countbycategory)){
 //    	$getidbycategory = $row['cat_id'];}
 //    	$countallcategory++;

 //    }


 //     if($getidbycategory == 0)
 //     {
  if(!$found)
  {
		$sql = "INSERT INTO `category` ( ".$columname." ) values ('$columnvalue') ";
		 if($conn->query($sql))
		 {
			 //$_SESSION['success'] = 'Voter deleted successfully';
			//echo "success insert";
			}
		else{
			//$_SESSION['error'] = $conn->error;
		  // echo "error".$conn->error;
			}
      // if(!isset($_POST['tshirt'])){
      // loadtable();}


          
    //  }
    //  else
    //  {
    //  	// echo " update id:".$getidbycategory;
     	       
				// $sql = "UPDATE category SET ".$columname." = '$columnvalue'  WHERE cat_id = '$getidbycategory' ";
				// if($conn->query($sql)){
				// 		//$_SESSION['success'] = 'Voter deleted successfully';
				// 		//echo "success";
				// 	}
				// 	else{
				// 		//$_SESSION['error'] = $conn->error;
				// 		// echo "error";
				// 	}
				
				// loadtable();
    //  }

   } 

 }

if(isset($_POST['id']) && isset($_POST['col']))
{
	$id = $_POST['id'];
	$col = $_POST['col'];
 // echo "del id:".$id;
 // echo "del col:".$col;
	$sql = "UPDATE `category` SET ".$col." = ''  WHERE cat_id = '$id' ";
	if($conn->query($sql))
     {
       //$_SESSION['success'] = 'Voter deleted successfully';
     // echo "delete success update";
      }
    else{
      //$_SESSION['error'] = $conn->error;
       // echo "error".$conn->error;
      }

	//loadtable();

  }




//if(!isset($_POST['tshirt'])){
    //  loadtable(); }

loadtable();


function loadtable(){
global $conn;
$deleterow = 0;

 $sql = "SELECT * FROM category" ;
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc()){

          if(empty($row['c_course']) && empty($row['c_major']) && empty($row['c_year']) && empty($row['c_section']) && empty($row['tshirt_size']) )
          {
          $deleterow = $row['cat_id'];

          }
        }

$value = "";

               // $value .= '<div class="col-sm-2">
               //            <table class="table">
               //              <th>Academic_Year</th>
               //              <th></th>';
                             
               //                  $sql = "SELECT * FROM sy_status where sy_range <> '' order by sy_range  " ;
               //                  $query = $conn->query($sql);
               //                  while($row = $query->fetch_assoc()){

                                
               //             $value .='<tr>';
               //              $value .=  '<td>'.strtoupper($row['sy_range']).'</td>
               //              </tr>';
               //              }
               //           $value .= '</table>
               //          </div>';
                       $value .= ' <div class="col-sm-4">
                          <table class="table">
                            <th></th>
                            <th>Course</th>';
                            
                                $sql = "SELECT cat_id ,c_course FROM category where c_course <> '' order by c_course  " ;
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){

                                
                           $value .= '<tr>
                              <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_course"></a></td>
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
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){

                                
                             $value .= '<tr>
                              <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_major"></a></td>
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
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){

                                
                          $value .='<tr>
                              <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_year"></a></td>
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
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){

                                 
                           $value .=' <tr>
                              <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="c_section"></a></td>
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
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){

                                 
                           $value .=' <tr>
                              <td><a title="delete" class="fa fa-trash-o del"  id="'.$row['cat_id'].'" data-id="tshirt_size"></a></td>
                              <td>'.strtoupper($row['tshirt_size']).'</td>
                            </tr>';
                           } 
                         $value .=' </table>
                        </div>';




                //echo $output;

                echo $value;


      	if($deleterow != 0)
      	{

              $sql = "DELETE FROM category WHERE cat_id = '$deleterow'";
      		if($conn->query($sql))
          {
      			//$_SESSION['success'] = 'Voter deleted successfully';
      			//echo "success";
      		}
      		else
          {
      			//$_SESSION['error'] = $conn->error;
      			//echo "error";
      		}
      }
        


}




 ?>