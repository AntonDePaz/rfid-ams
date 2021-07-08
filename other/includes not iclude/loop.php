
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	<?php 

$savearray = array(

				array('1','1','1','1'),
				array('2','2','2','2'),
				array('3','3','3','3')

				);

// for($i = 0;$i <= 3; $i++){
// 	$tw = '1';
//                         $savearray[$i] = $tw; 
                        
//                     }

for($r = 0;$r < 3; $r++)
{
	echo "<ul";
	for($c = 0;$c < 4; $c++)
{
	
	
echo "<li>".$savearray[$r][$c]."</li>";

}
echo"</ul>";

}





 ?>

</body>
</html>

