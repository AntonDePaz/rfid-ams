 
<?php //include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php 



//require_once('../class/Item.php');
if(isset($_GET['prnt'])){
  // $choice = $_GET['choice'];

   //$reports = $item->item_report($choice);
    //echo '<pre>';
    // print_r($reports);
    //echo '</pre>';

?>

<head>

    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' /> -->
    <title>Supreme Student Council</title>

    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <!-- <link href="../bower_components/Datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
 -->

</head>
<body class="contentz" >
<center>
    <h2>Master List</h2>
</center>

<br />
<div class="table-responsive" style="margin: 1px; padding: 1px;">
  <?php $num =10; ?>
       <table id="myTable-report" class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
       <th style='margin: 1px;padding: 1px;left: 1px; right:1px;'>#</th>
        <th style='margin: 1px;padding: 1px;left: 1px; right:1px;'>ID Number</th>
        <th style='margin: 1px;padding: 1px;left: 1px; right:1px;'>Full Name  &nbsp;</th>
        <th style='margin: 1px;padding: 1px;left: 1px; right:1px;'>Year/Major  &nbsp;</th>
        <?php 
          for($a = 0;$a<$num;$a++){
            echo "<th style='margin: 1px;padding: 1px;left: 1px; right:1px;'>Assembly Metting Day $a</th>";
          }
           ?>
         
        
    </thead>
    <tbody>
      <?php for($x=0;$x < 20;$x++){ ?>
      <tr>
        <td style='margin: 1px;padding: 1px;left: 1px; right:1px;'>1</td>
        <td style='margin: 1px;padding: 1px;left: 1px; right:1px;'>1710128-1</td>
        <td style='margin: 1px;padding: 1px;left: 1px; right:1px;'>asdad asdsadsa</td>
        <td style='margin: 1px;padding: 1px;left: 1px; right:1px;'>1 Networking</td>
        <?php 
          for($b = 0; $b<$num; $b++){
            echo "<td style='margin: 1px;padding: 1px;left: 1px; right:1px;'>P 25$b.00</td>";
          }
         ?>
      </tr>
         <?php } ?>   
    </tbody>
</table>
</div>



</body>
</html>
<?php  include 'includes/scripts.php'; ?>

<?php 

}
 ?>

 <script type="text/javascript">
       $(document).ready(function() {
        //landscape
        // 10,11,12,13 12size  default
        // 14    11size
        // 15,16    10size
        // 17,18    9size
        // 19,20    8size
        // 21,22,23    7size
        // 24,25,26,27    6size
        // 28 - 33   5size
        // 34-41    4size
        //42 - 51    3size
        //52 - 71     2size
        // 72 -- 

      $('.contentz').css('font-size',12);
        //function FontSize(flag){
          // var divEl = $('.contentz')css('font-size',24);
          // divEl.css('font-size',24);
       print();
     });
    </script>

