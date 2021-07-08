<?php 
  include 'includes/session.php';
  include 'model/student.php';
  include 'model/category.php';
 ?>
<?php include 'includes/header.php'; ?>
<style type="text/css">
   #btn {
    border-style: none;
    margin-left: 5px;
    background-color: transparent;
  }
  #btn:hover {
   color: blue;
  }
  .modify {
    /*display: inline-block;*/
    width: 130px;
  }
  .edit {
    color: green;
    background-color: transparent;
    border-color: green;
  }
  .del {
    color: red;
    background-color: transparent;
    border-color: red;
  }
   #btn:hover {
  border:1px solid lightseagreen;
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
        <i class="fa fa-users"></i> Students List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php if(isset($_SESSION['sy_id'])){ ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
            
              <input type="hidden" class="semester" value=" <?php echo $_SESSION['sem_id'] ?> ">
              <a href="#addnew" data-toggle="modal" class="btn btn-default btn-sm "><i class="fa fa-user-plus"></i> Add Student</a>
              <a id="btn" href="#import_excel" data-toggle="modal" class="btn btn-xs pull-right"><i style="color:blue;" class="fa fa-download"></i> Import Data(csv excel file)</a>
              <a id="btn"  class="btn btn-xs pull-right btn_print"><i style="color:red;" class="fa fa-print"></i> Print</a>
              <a id="btn" class="btn btn-xs pull-right xexport"><i style="color:green;" class="fa fa-upload"></i> Export (Excel)</a>
              <a id="btn" href="students.php" class="btn btn-xs pull-right"><i style="color: orange;" class="fa fa-refresh"></i> Refresh</a>
              
            </div>
            <div class="box-body">
              <div  id="student_table" class="table-responsive">
              <table  id="students_table" class="table table-striped table-responsive table-bordered display" width="100%" cellspacing="0">
                <thead>
                  <th>#</th>
                  <th >IDnumber</th>
                  <th>Firstname</th>
                  <th>Middlename</th>
                  <th>Lastname</th>
                  <th>Year</th>
                  <th>Section</th>
                  <th>Course</th>
                  <th>Major</th>
                  <th>Action</th>
                </thead>
                <!-- <tbody id="tbody_student" style="font-weight: 500;"> -->
                  <tbody style="font-weight:200;" >

                  </tbody>
                <!-- </tbody> -->
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </section>   
  </div>
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      ...
    </div>
  </div>
</div> -->
  <div class="modal fade" id="import_excel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname">Import Student Data</span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="upload_csv_form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="csvfile" class="col-sm-4 control-label">Choose csv file :</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="file" id="csvfile" name="csvfile" accept=".csv" required>
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-md-10">
                <h6 class="text-danger"><i class="fa fa-info-circle"></i> Note: <span style="font-style:italic;">Can't Insert if the RFID and IDNUMBER is Duplicate.</span></h6>
                <h6 class="text-danger"><i class="fa fa-info-circle"></i> Note: <span style="font-style:italic;">See below table on what the exactly correct alignment og column name header in <b>csv</b> format.Please double check your data before importing.</span></h6>
                </div>
            </div>
            <table style="color:#000; font-size:10px; font-weight:900; " cellpadding="0" class="table table-bordered text-center">
                  <thead style="margin:0;">
                    <th>RFID</th><th>IDNumber</th><th>Firstname</th><th>Middlename</th><th>Lastname</th>
                    <th>Year</th><th>Section</th><th>Course</th><th>Major</th> </thead>
                  <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
                  <td>6</td><td>7</td><td>8</td><td>9</td></tr>
                </table>
            <div>
              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close text-danger"></i> Close</button> -->
             
                <button type="submit" class="btn btn-success btn-sm pull-left" id="uploadcsv" name="uploadcsv"><span class="uploadcsv_btn"><i class="glyphicon glyphicon-save "></i> Upload</span></button>
             
              
              </form>
            </div>
        </div>
    </div>
</div>

 
  <?php  include 'includes/footer.php'; ?>
  <?php  include 'includes/students_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
<script src="assets/students.js"></script>


