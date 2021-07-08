
<header class="main-header" >
  <!-- Logo -->
  <a href="dashboard.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>AM</b>S</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="font-size: 12px;"><b>Attendance Management System </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-image: linear-gradient(to right,#00cccc,#008080); box-shadow: 3px 3px 3px #333333; ">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu" >
      <ul class="nav navbar-nav" >
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php 
            if(!empty($_SESSION['photo'])){
              echo '<img style=" background-color:#fff; box-shadow: 2px 2px #333333;" width="35" height="35" src="images/'.trim($_SESSION['photo']).'" class="img-circle" alt="Admin image">';}
              else{
                echo '<img width="35" height="35" src="images/profile.jpg" class="img-circle" alt="Admin image">';}
             ?>
            <span class="hidden-xs" style="font-size: 12px;"><?php 
              echo " ".ucwords( strtolower($_SESSION['firstname']))." ".ucwords(strtolower($_SESSION['lastname']));
             ?></span>
          </a>
          <ul class="dropdown-menu" style="width: 50px; font-size: 12px;">
                <li><a href="#change-pass" data-toggle="modal"><i class="fa fa-key"></i> Change Password</a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Sign Out</a></li>
         </ul>
        </li>
      </ul>
    </div>
  </nav>
  
</header>
<?php  include 'includes/admin_modal.php'; ?> 
<?php include 'includes/cropimage_modal.php'; ?> 
