<?php 




function show(){


  $geteventidtshirt = trim($_POST['getfeeidtshirt']);

  include '../includes/conn.php';

                    
                           $output = "";
                            $sql1 = "SELECT * FROM fee_event where fe_id = '$geteventidtshirt' ";
                            $query1 = $db->query($sql1);
                            $row1 = $query1->fetch_assoc(); 
                            $amount = $row1['amount'];
                              $countz = 1;
                              $sql = "SELECT * FROM students".$_SESSION['sy_id']." s left join tshirt_size".$_SESSION['sy_id']." ts on s.student_id = ts.ts_student_id where s.sem".$_SESSION['sem_id']." = 1  order by  s.year asc, s.firstname asc "; #size".$geteventidtshirt." desc ,
                           
                              $query = $db->query($sql);
                              while($row = $query->fetch_assoc()){
                                
                                
                                 $output .= "<tr class='getinfos'>
                                    <td>".$countz++."</td>
                                    <td>".$row['id_number']."</td>
                                    <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                                    <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                                    <td>".ucwords(strtolower($row['course']))."</td>";
                                    
                                   if(!empty($row['size'.$geteventidtshirt.'']))
                                     { 
                                     $output .= "<td  class='text-info tdshirt'> <span class='badge' style='background-color:green;'> reserved</span> </td>";

                                       } 
                                       else{
                                        $output .= "<td class='tdshirt'></td>";
                                       }
                                  
                                     if(!empty($row['size'.$geteventidtshirt.'']))
                                      { 
                                        $output .= "<td class='tdshirt'> &#8369 ".number_format($amount,2)."</td>";
                                         }
                                         else{
                                          $output .= "<td class='tdshirt'></td>";
                                         }
                                    
                                    $output .= "<td class='tdsize".$row['student_id']."'><span class='tdshirt'>".$row['size'.$geteventidtshirt.'']."</span></td>";
                                   
                                   $output .= "<td class='hoversize' data-id='".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."'>
                                       <select title='T-Shirt Sizes' class ='form-control pull-left size' name ='size' id='size' data-id=".$row['student_id'].">";
                                       $output .= "<option value=''></option>";
                                       $output .= "<option value='cancel' style='color: red;'>cancel</option>";
                                         $sqlw = "SELECT * FROM category where tshirt_size <> '' order by tshirt_size ";
                                          $queryw = $db->query($sqlw);
                                          while($roww = $queryw->fetch_assoc()){
                                           
                                      $output .= "<option value='".$roww['tshirt_size']."'>".$roww['tshirt_size']."</option>";
                                       
                                          } 
                                       $output .= " </select>";
                                        

                                   $output .= "  </td> </tr> ";
                            
                              }

                            //     $data = array();
                            //   for($i=0;$i<10;$i++){
                            //   $subarray = array();
                            //   $subarray[] = 'aaaaaaa';
                            //   $subarray[] = "<a class='btn btn-default btn-xs edit' title='edit' <i class='fa fa-trash-o'> delete</i></a>";  
                            //      $data[] = $subarray;
                            //   }
                                      
                            // $output = array("data" => $data);
                              echo $output;

                          
                     //  echo ['html'=>$output]; 

                      // echo json_encode(['status'=>'success','html'=>$output]);

}

// if(isset($_POST['geteventid']) && isset($_POST['amount']) )
// {
//                        $geteventid = trim($_POST['geteventid']);
//                        $amount = trim($_POST['amount']);


//          //              $array_id = array();
//          //              $index_array = 0;
// 					    // $sql = "SELECT * FROM masterlist where pay".$geteventid." <> '' ";
//          //                      $query = $conn->query($sql);
//          //                      while($row = $query->fetch_assoc()){
//          //                      	$array_id[$index_array] = $row['ml_student_id'];
//          //                      }
							
                       
// 						              $output = "";
//                           $countz = 1;
//                           $costall = 0;
//                             //  $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 order by year asc, firstname asc";
//                             // $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 and student_id not in (SELECT ml_student_id FROM masterlist where pay".$geteventid." <> '') order by year asc, firstname asc";
//                             $sql = "SELECT  * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where sem".$_SESSION['sem_id']." = 1 order by pay".$geteventid." desc , s.year asc, s.firstname asc ";
//                               $query = $conn->query($sql);
//                               while($row = $query->fetch_assoc()){
                              	
//                               	{
//                                   if($row['pay'.$geteventid.''] > 0)
//                                   {
//                                     $output .= "
//                                       <tr>
//                                         <td>".$countz++."</td>
//                                         <td><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
//                                         <td>".$row['student_id']."</td>
//                                         <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
//                                         <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
//                                         <td>".ucwords(strtolower($row['course']))."</td>
//                                         <td class='tdamount'> <span class='tdamountloading'> &#8369 ".$amount." </span></td>
//                                       </tr>
//                                     ";
//                                     $costall += $amount;
//                                     }
//                                     else
//                                     {
//                                       $output .= "
//                                         <tr>
//                                           <td>".$countz++."</td>
//                                           <td><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
//                                           <td>".$row['student_id']."</td>
//                                           <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
//                                           <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
//                                           <td>".ucwords(strtolower($row['course']))."</td>
//                                           <td class='tdamount'><span class='tdamountloading'>&#8369 ---- </span></td>
//                                         </tr>
//                                       ";

//                                     }
//                             }
                           
//                                   }
                           
//                             echo $output;
//                          // echo json_encode(['html'=>$output]);
// }

if (isset($_POST['getfeeidtshirt'])  ) 
{

  show();
 
}

 ?>
<script >
 $(document).ready(function(){
$('.hoversize').hover(function() {
    //alert('sadsad');
    // var name =  $(this).data('id');
    // $(this).tooltip({title:''+name,placement:'left'});
    var name = $(this).data('id');
    $(this).tooltip({ title: '' + name, placement: 'top' });
});

// var tshirt_array = new Array();
// var student_id_array = new Array();
// var index_array = 0;
$('.size').on('change', function() {

    var tshirt_size = $(this).val();
    // alert("tshirt_size:"+tshirt_size);
    var student_id = $(this).data('id');
    //var ss = ""+student_id+"";
    //var student_id = (ss.trim());
    var values = '.tdsize' + student_id + '';
    //alert("tshirt_size:"+tshirt_size);
    // alert(" student_id:"+student_id+"<");
    // alert(" values:"+values+"<");
    $(values).text("" + tshirt_size);
    for (var i = 0; i < index_array + 1; i++) {
        if (student_id_array[i] == student_id) {
            tshirt_array[i] = null;
            student_id_array[i] = null;
        }
        tshirt_array[index_array] = tshirt_size;
        student_id_array[index_array] = student_id;
    }
    index_array++;

});
});
</script>
