<?php 
  include 'includes/session.php';
  include 'model/fee.php';
// if(!isset($_SESSION['admin_id']))
//  {
//   header('location: index.php');
//  } 
//  else{
//    $fee = new fee();
//  }
 ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">
 
 tbody{
  font-size: 12px;
  text-align: left;
 }
  #size {
    font-size: 10px;
    border-radius: 20px;
    width: 40px;
    height: 20px;
   
  }
  .add_tshirt_size{
     border-style: none;
     background-color: transparent;
     color: #000;
  }
   .add_tshirt_size:hover{
     background-color: transparent;
     color: #000;
  }
  #tshirt{
    width: 200px;
    border-radius: 10px;
  }
  #select1{
     width: 200px;
    border-radius: 10px;
  }
  .box-body{
    height: 450px;  
    overflow-y: auto;
  }

  #search_fee{
    width: 200px;
  }

  div label {
    font-size: 12px;
  }
    .add_tshirt_size{
     /* position: absolute;
      top: -34px;
      right: 50%;*/
     /* background-color: red;*/
      margin-right:10px;
    }
  .select1,.select2 {
     position: absolute;
    top: -40px;
    right: 2px;
    border-style: none;

  }
  .select1:focus , .select2:focus{
    color: #000;
    box-shadow: 0 0 5px #33bbff;
  }
  .tshirt_fee{
     position: absolute;
    top: -40px;
    right: 2px;
    border-style: none;
  }
th i {
  color: red;
}
label span {
  font-weight: 800;
}

.edit{
  color: green;
  background-color: transparent;
}
.del {
  color: red;
   background-color: transparent;
}
.view {
  color: blue;
   background-color: transparent;
}
.edit:hover,.del:hover,.view:hover{
  background-color: transparent;
}
/*.tshirt_size_div{
 position: relative;
}
.xclose{
  position: absolute;
  color: red;
  
}*/


.search-box{
    display: none;
    margin-right: 20px;
  }
  .txt_tshirt_size{
    width: 200px;
    height: 23px;
    font-weight: 200;
  }
  .xclose{
    width: 15px;
    height: 23px;
    /*border:1px solid #fd5e53;*/
    background: red;
    text-align: center;
    color: white;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    margin-left: 0;
    top: 0;
    
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
      <i class="fa fa-money"></i> Manage Fees
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Fee</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content" style="background-color: #fff; min-height: 600px;">
     <?php if(isset($_SESSION['sy_id'])){ ?>
           <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
              <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                  <li class="ac active"><a href="#all_fee" data-toggle="tab">All Fee</a></li>
                  <li class="ac2" ><a href="#fee" data-toggle="tab">Contribution Fees</a></li>
                  <li class="ac3" ><a href="#tshirt_fee" data-toggle="tab">T-Shirt Fees</a></li>
                  
              </ul>
          </div>
        </div>
       
        <div id="my-tab-content" class="tab-content text-center">
            <div class="tab-pane" id="fee"> 
              <div class="row" >
                  <div class="col-md-12">
                    <div class="boxs">
                      <div class="box-header with-border">
                        <input type="hidden" class="setfeeid">
                      <input type="hidden" class="semester" value=" <?php echo $_SESSION['sem_id'] ?> ">
                     
                        <!-- <a class="btn btn-default btn-xs pull-right add_tshirt_size"><i class="fa fa-plus"></i> Add Contribution</a> -->
                        <div class="row"> 
                          <select class ='form-control pull-left select1' name = 'select1' id='select1'>

                            
                            <?php 
                          //  if(!empty($_SESSION['set_fee_id'])){
                            
                            //  echo '<option style="font-style: italic; color: gray;" value="0">'.$_SESSION['set_fee_id'].'</option>';
                         //     $sQuery = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status <> 1";
                          //    $result = $conn->query($sQuery);
                           
                          //    while($row = mysqli_fetch_array($result))
                          //   $data = $fee->show_fee();
                          //   if(!empty($data)){
                          //   foreach($data as $row)
                          //    {
                          //      echo "<option data-id=".$row['fe_id']." value='".$row['amount']."'>".ucwords($row['Description'])."</option>";
                          //    }
                          //  }
                          //   else{
                          //     echo 'empty fee';
                          //   }
                        //  }
                             ?>
                             
                          </select> 

                          
                          <input class="form-control pull-right search_fee" type="text" id="search_fee" name="" placeholder="search..">
                         <!--  <label class="pull-left">Fun Run T-Shirt</label> -->
                          <a class="btn btn-primary btn-xs pull-left modaladdnew"><i class="fa fa-plus"></i> Add Fees</a>
                         <center> <h4 class="text-info fee_description"></h4></center>
                        </div>
                        
                        
                      </div>
                      <div class="box-body">
                        <div  id="student_table">
                        <table id="fee_table" class="table table-striped table-bordered">
                          <thead>
                            <th >No.</th>
                            <th><i class="fa fa-user-times btnremove_fee"></i></th>
                            <th>IDnumber</th>
                            <th >FullName</th>
                            <th>Year/Section/Major</th>
                            <th>Course</th>
                            <th>Amount</th>
                          </thead>
                          <tbody class="fee_table">
                            <?php

                              $countz = 1;
                             // $sql = "SELECT * FROM students1 where sem".$_SESSION['sem_id']." = 1 order by year asc, firstname asc";
                              // $sql = "SELECT * FROM students".$_SESSION['sy_id']." s inner join masterlist".$_SESSION['sy_id']." ml on s.student_id = ml.ml_student_id where s.sem".$_SESSION['sem_id']." = 1 order by s.year asc, s.firstname asc";
                             
                             // $query = $conn->query($sql);
                             // while($row = $query->fetch_assoc()){
                               $data = $fee->show_all_fee();
                               if(!empty($data)){
                                 foreach($data as $row){

                                  // <input type='checkbox' class='ckhbox' data-id=".$row['student_id'].">
                                echo "
                                  <tr>
                                    <td>".$countz++."</td>
                                    <td></td>
                                    <td>".$row['id_number']."</td>
                                    <td>".ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname']))."</td>
                                    <td>".$row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major']))."</td>  
                                    <td>".ucwords(strtolower($row['course']))."</td>
                                    <td class='tdamounts'><span class='tdamountloading'>--</span></td>
                                    

                                  </tr>
                                ";
                                 }
                                 
                              }
                              // else{
                              //   echo 'empty';
                              // }

                            ?>
                          </tbody>
                        </table>
                        </div>
                      </div>
                      <div style="height: 30px; ">
                        <h6 class="text-info pull-right" style=" font-style: italic; margin-right: 30px;">Total Cost: &#8369 <b class="totalcostfee">0.00</b></h6>
                      </div>
                    </div>
                  </div>
                </div>
            </div>




























            <div class="tab-pane" id="tshirt_fee">
                <div class="row">
                  <div class="col-md-12">
                    <div class="boxs">
                      <div class="box-header with-border" style="height: 80px;">
                        <div class="row">
                          <select class ='form-control pull-left select2' name = 'tshirt' id='tshirt'>
                            <!-- <option style="font-style: italic; color: gray;" value="0">Choose tshirt</option>
                            -->
                            <?php 
                            
                             // $description = '';
                             // $fee_id = 0;
                             // $sQuery = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status = 1 and fe_id <> '$fee_event_id' ";
                             // $result = $conn->query($sQuery);
                             // while($row = mysqli_fetch_array($result))
                           //  $data = $fee->show_tshirt();
                            // if(!empty($data)){
                            // foreach($data as $row){
                               // $fee_event_id  = $row['fe_id'];
                             //   echo "<option value='".$row['fe_id']."' data-id=".$row['amount'].">".ucwords($row['Description'])."</option>";
                                //$description = $row['Description'];
                                //$fee_id = $row['fe_id'];
                             // }
                          //  }
                             ?>
                          </select> 
                          <a title="save changes" class='btn btn-info btn-xs pull-right save_change'><span class="save_changelabel"><i class='fa fa-save'></i> save changes</span></a>
                          <a class="btn btn-default btn-xs pull-right add_tshirt_size"><i class="fa fa-plus"></i> Add T-Shirt Size</a>
                          <input type="hidden" class="set_amount_fe">
                             <!-- <input class="pull-right txt_tshirt_size" id="txt_tshirt_size" type="hidden" name="" placeholder="Enter T-Shirt Size"> 
                          <a title="Edit/Delete"  class="btn xclose"><b>&times;</b> </a> -->


                          <span class="pull-right search-box">
                            <input type="text" id="txt_tshirt_size" class="txt_tshirt_size" placeholder="Enter T-Shirt Size" required pattern=".*\S.*">
                            <a title="close" id="xclose" class="xclose"> &times;</a>
                          </span>
                         
                        <a  class="btn btn-success btn-xs  pull-left modaladdtshirt"><i class="fa fa-plus"></i> Add Tshirt Fee</a>
                        </div>
                        <input type="hidden" class="semester" value=" <?php echo $_SESSION['sem_id'] ?> ">
                        <div class="row" >
                             <input style="margin-top: 5px; height: 25px; font-size: 12px;" class="form-control pull-right search_tshirt" type="text" id="search_fee" name="" placeholder="search..">
                             <center> <h4 class="text-info tshirt_description"></h4> </center>
                             <input type="hidden" class="tshirt_fee_amount">
                        </div>
                      </div>
                      <div class="box-body">
                        <div  id="student_table"><input type="hidden" class="get_fee_id">
                        <table id="example12" class="table table-striped table-bordered">
                          <thead>
                            <th >No.</th>
                            <th>IDnumber</th>
                            <th >FullName</th>
                            <th>Year/Section/Major</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>T-Shirt Size</th>
                            <th></th>
                          </thead>
                          <tbody id="tbodydata">
                           
                          </tbody>
                        </table>
                        </div>
                      </div>
                       <div class="box-header with-border footer" style=" font-style: italic; height: 50px;">
                       </div>
                  </div>
                  </div>
                </div>
            </div>























<!------------------------------------- FEE TABLE ------------------------------------>










            <div class="tab-pane active" id="all_fee">
                <div class="row">
                  <div class="col-md-12">
                     <!--  <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> New</a>
                      </div> -->
                      <div class="box-bodyz" style=" margin-top:50px;">
                        <table  id="fees_table" class="table table-striped table-bordered" >
                          <thead>
                            <th>No.</th>
                            <th>Description</th>
                            <th>Amount Fee</th>
                            <th>Type</th>
                            <th>Action</th>
                          </thead>
                        </table>
                      </div>
                  </div>
            </div>
            
       
        <!-- </div>  end tab fee table -->
<?php } ?>
      
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/fee_modal.php'; ?>
  
</div>
<?php include 'includes/scripts.php'; ?>


</body>
</html>

<script src="assets/fee.js"></script>














