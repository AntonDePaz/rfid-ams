<?php // include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>


  <?php// include 'includes/navbar.php'; ?>
  <?php// include 'includes/menubar.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	&nbsp <input type="checkbox" id="selectall"><b>All</b><br>
	&nbsp <input type="checkbox">1<br>
	&nbsp <input type="checkbox">2<br>
	&nbsp <input type="checkbox">3<br>
	&nbsp <input type="checkbox">4<br>
	&nbsp <input type="checkbox">5<br>
	&nbsp <input type="checkbox">6<br>


</body>
</html>
 <?php //include 'includes/footer.php'; ?>
  <?php //include 'includes/positions_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script>
	$(document).ready(function(){


		//$('#selectall').click(function(){
		//	$('input[type=checkbox]').prop('checked',$('#selectall').is(':checked'));
		//});


		$(':not(#selectall)').click(function(){
			if($(this).is(':checked'))
			{
				$(this).addClass('clicked');
			}
			else
			{
				$(this).removeClass('clicked');
			}
		});
		$('#selectall').click(function(){
			$(':not(.clicked)').prop('checked',$('#selectall').is(':checked'));
		});

	});
	
</script>