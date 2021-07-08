<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 <a  class="btn btn-primary btn-sm btn-flat printpop"><i class="fa fa-print"></i> Print</a>
</body>
</html>
<?php  include 'includes/scripts.php'; ?>
<script type="text/javascript">

$(document).on('click','.printpop',function(){
   window.open('printsample.php?prnt=82cc75faaf7cda1','name','width=600,height=400,toolbar=0');
  });

</script>