<?php
  include 'includes/conn.php';
  include 'includes/session.php'
// if(!isset($_SESSION['admin_id']))
//  {
//   header('location: index.php');
//  }
 ?>

<?php include 'includes/header.php'; ?>
<style type="text/css">
  .search-box{
    width: 100%;
    display: flex;
    margin: 20px;
  }
  .search{
    width: 250px;
   
     border-radius: 5px 0 0 5px;
    border-right: none;
    padding: 5px;
    height: 30px;
    outline: none;  
    color: #9bdfaf;
  }
  .search:focus{
    color: #000;
    box-shadow: 0 0 5px #fd5e53;
  }
  .search-btn{
    width: 40px;
    height: 30px;
    border:1px solid #fd5e53;
    background: #fd5e53;
    text-align: center;
    color: #fff;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
  }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style='font-size:20px;'>
      <i class="fa fa-credit-card"></i> Payment Transaction
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment transaction</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- <div class='alert alert-danger alert-dismissible'>
               <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              erroe message
           </div> -->
      <?php

        // if(isset($_SESSION['error'])){
        //   echo "
        //     <div class='alert alert-danger alert-dismissible'>
        //       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //       <h4><i class='icon fa fa-warning'></i> Error!</h4>
        //       ".$_SESSION['error']."
        //     </div>
        //   ";
        //   unset($_SESSION['error']);
        // }
        // if(isset($_SESSION['success'])){
        //   echo "
        //     <div class='alert alert-success alert-dismissible'>
        //       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        //       <h4><i class='icon fa fa-check'></i> Success!</h4>
        //       ".$_SESSION['success']."
        //     </div>
        //   ";
        //   unset($_SESSION['success']);
        // }
      ?>
      <div class="row">
        <?php if(isset($_SESSION['sy_id'])){ ?>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">


           <!-- <div class="input-group">
            <div class="form-outline">
              <input type="search" id="form1" class="form-control" />
              <label class="form-label" for="form1">Search</label>
            </div>
            <button type="button" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </div> -->

              <div class="search-box">
                <input type="text" id="search" class="search" placeholder="Search for id number..">
                <button type="button" id="btnsearch" class="search-btn" disabled><i class="fa fa-search"></i></button>
              </div>

              <!-- <div class="col-sm-4">
                <input type="text" name="search" id="search" class="form-control" placeholder="search">
              </div>
                <div class="col-sm-1">
                  <input type="button"  id="btnsearch" class="btn btn-default btn-xs" value="search">
                 </div>
               </div> -->
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6" style=" height: 420px;  overflow-x: auto;">
             <table class="table" id="table">
                <thead style="background-color:  #e6ffff">
                 <th width="1%"><!-- <input id="checkall" type="checkbox"> --></th>
                  <th>Description</th>
                  <th>Amount</th>
                </thead>
                <tbody id="datarow">
                  <?php
                  $e = 1;
                   $sql = "SELECT * FROM fee_event where sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." ";
                    $query = $db->query($sql);
                    while($row = $query->fetch_assoc())
                    { ?>
                        <tr class="rowx">
                          <td class="schk"><input id="getchk" type="checkbox" name="amount[]" disabled></td>
                           <td style="display: none;" id="fee_id"> <?php echo strtoupper($row['fe_id']); ?>   </td>
                          <td style="font-size: 12px; font-style: italic;" > <?php echo strtoupper($row['Description']); ?>   </td>
                          <td >&#8369 <?php  echo" <span class='tdamount$e'>0.00</span>   ";?></td>
                        </tr>

                      <?php
                      $e++;
                    }
                  ?>
                  <!-- <tfoot style=" background-color:  #e6ffff">
                   <td>TOTAL  </td>
                   <td> </td>
                   <td>&#8369 0.00</td>
                  </tfoot> -->
                    

                  </tbody>
              </table>
                </div>
                <input type="hidden" class="totalall">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-4">

                    </div>

                  </div>

                   <div class="s_info">
                    <div>
                     <h5 class="text-info" style="font-style: italic;">Student Information</h5>
                     <input type="hidden" name="student_id" class="student_id">
                     <h5>Name: &nbsp<b><span class="fn"></span>&nbsp <span class="mn"> &nbsp </span>&nbsp<span class="ln"></span> </b></h5>
                     <h5>Year/Section: &nbsp<b><span class="year"></span> &nbsp <span class="section"> </span>&nbsp </b></h5>
                     <h5>Course/Major: &nbsp<b><span class="course"></span> &nbsp <span class="major"></span> &nbsp </b></h5>
                     </div>
                   </div>
                   <div >
                    <br>
                <div class="s_info" >
                  <div >
                     <h5>Total Amount : <strong> &#8369 <span id="totals" style="color: red;">0.00</span></strong></h5>
                   <div class="row">
                     <div class="col-sm-5">
                      <input type="text" name="" id="cash" class="form-control" placeholder="Enter Cash">
                      <h6 class="lack" style="color: red;"></h6>
                    </div>
                   </div>
                   <div class="row">
                     <div class="col-sm-7">
                      <h5>Change : &#8369 <strong><span class="change">0.00</span></strong></h5>
                     </div>
                   </div>
                   <hr>
                   <input type="button"  class="btn btn-success btn-xs" id="print" value="Okay">
                   <input type="button"  class="btn btn-danger btn-xs pull-right" id="cancel" value="Cancel">
                     </div>
                   </div>
                   </div>

              </div>



            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </section>
  </div>

  <?php include 'includes/footer.php'; ?>
  <?php //include 'includes/positions_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>


<script src="assets/payment.js"></script>
</body>
</html>
<style type="text/css">
  /*#search
  {
    margin: 10px auto;
    width: 300px;
   height: 30px;
   border-radius: 0 10px 10px 0;


  }*/
  .s_info {
     /* border:1px solid grey;*/
       border-radius:5px;
        width:450px;
        min-height: 130px;
        margin:10px;
        padding:10px;
        box-shadow:0px 0px 2px gray;

  }
  #cash {

    width: 150px;
   height: 30px;
   border-radius: 0 10px 10px 0;
  }
</style>

