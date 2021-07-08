
<?php include 'includes/header.php'; ?>

<body class="hold-transition login-page">

<div class="login-box">
  	<div class="login-logo">
  		<b style="font-size: 25px;">RFID BASED</b><br>
      <b style="font-size: 20px;">Attendance Monitoring System</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg" >LOGIN</p>

    	<form  method="POST" id="form_admin" enctype="multipart/form-data">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control username" name="username" placeholder="Username" autocomplete="off" required pattern=".*\S.*">
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control password" name="password" placeholder="Password" required pattern=".*\S.*">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="errorm"><p class="errormsg" style="color: red;"></p></div>
      		<div class="row">
            <div class="col-xs-3"></div>
    			<div class="col-xs-6">
          			<button type="submit" class="btn btn-primary btn-block" id="login" name="login"><span class="load"><i class="fa fa-sign-in"></i> Sign In</span></button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
<footer>
<p><center>No account? Login Details Are Provided by President Officer<center></p></footer>
</html>
<script src="assets/login.js"></script>