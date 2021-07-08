
<header class="main-header" >
  <!-- Logo -->
  <a href="home.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>SS</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="font-size: 13px;"><b>Attendance Monitoring System </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-color: #008080; box-shadow: 3px 3px 3px #333333; ">
    <div class="row text-center" style="width: 300px;height: 50px; position: absolute; margin:10px 0px 0px 40px;">
      <img width="34" height="34" src="../images/slsulogo.png" class="img-circle" alt="Admin image">'
       <span style=" color: #fff; font-size: 10px; " >Southern Leyte State University - Main Campus  </span><img width="30" height="30" src="../images/ssclogo.jpg" class="img-circle" alt="Admin image">'
     <span style="position: relative; color: #fff; font-size: 10px; bottom: 10px; " >Supreme Student Council</span>
      
    </div>
    
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
              echo '<img width="35" height="35" src="../images/'.trim($_SESSION['photo']).'" class="img-circle" alt="Admin image">';}
              else{
                echo '<img width="35" height="35" src="../images/profile.jpg" class="img-circle" alt="Admin image">';}
             ?>
            <span class="hidden-xs" style="font-size: 12px;"><?php 
              echo " ".$_SESSION['firstname']." ".$_SESSION['lastname'];
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
<?php  include 'includes/admin_modal.php'; ?> <!-- update admin info -->
<?php //  include 'includes/admin_update.php'; ?>
<?php include 'includes/cropimage_modal.php'; ?> 
