<?php
  echo "<div class='row container' >";
$data = $event->showall_event();
// $sQuery = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and date >= '$date' order by date";
          //   $result = $conn->query($sQuery);
        //    while($row = mysqli_fetch_array($result))
        if(!empty($data)){
        foreach($data as $row)
 {
  if($row['date'] >= $date){
        
 echo '<div class="inner"> 
             <a title="Edit/Delete"  class="btn menu" data-id="'.$row['fe_id'].'"><i class="fa fa-ellipsis-h"></i></a>
             <a  class="eventspanel" id='.$row['fe_id'].'>
             <div class="eventz"><span style="font-size: 15x;  color: black;" >'.$row['Description'].'</span> <span class="code"></span></div> 
             <div style="font-size: 11px; margin-top:5px;">Date: <span style="font-size: 12px; color: black;" ><strong>'.date('M j, Y',strtotime($row['date'])).'</strong></span> <span class="section"></span></div> 
             <div style="font-size: 11px;">Time Start:<span style="font-size: 12px; color: black;" > '.$row['time'].' am</span> <span class="year"></span></div>
           </a>
           </div>
         
           ';

 $dex++;
  }
 }
} #else { echo 'no data';}

 if($dex == 0){
    echo "<h6 style='margin-left:20px;' class='text-info'> No Upcoming Event(s)</h6>";
 }
 echo "</div>";
 echo "<hr>";
 echo "<h6> Expired Events </h6>";
 echo "<div class='row container'>";
 // $sQuery = "SELECT * FROM fee_event where type = 1 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and date < '$date' order by date";
     //        $result = $conn->query($sQuery);
   //         while($row = mysqli_fetch_array($result))
   $data = $event->showall_event();
   if(!empty($data)){
   foreach($data as $row)

 {
   if($row['date'] < $date){
       
       echo '<div class="inner2"> 
                   <a title="Edit/Delete"  class="btn menu" data-id="'.$row['fe_id'].'"><i class="fa fa-ellipsis-h"></i></a>
                   <a href="eventsliststudent.php?id='.$row['fe_id'].'" class="eventspanel" id='.$row['fe_id'].'>
                   <div class="eventz"><span style="font-size: 15x;  color: black;" >'.$row['Description'].' '.$row['tap'].'</span> <span class="code"></span></div> 
                   <div style="font-size: 11px; margin-top:5px;">Date: <span style="font-size: 12px; color: black;" ><strong>'.date('M j, Y',strtotime($row['date'])).'</strong></span> <span class="section"></span></div> 
                   <div style="font-size: 11px;">Time Start:<span style="font-size: 12px; color: black;" > '.$row['time'].' am</span> <span class="year"></span></div>
                 </a>
                 </div>
                 ';

       $dex++;
       }
 }
} #else { echo 'no data';}
echo "</div>";


?>