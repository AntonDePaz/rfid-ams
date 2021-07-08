<?php 
  //include 'includes/session.php';
  include 'model/fee.php';
if(!isset($_SESSION['admin_id']))
 {
  header('location: index.php');
 } 
 else{
   $fee = new fee();
 }
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
                            <option style="font-style: italic; color: gray;" value="0">Select Fee</option>
                            <?php 
                              //$sQuery = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status <> 1";
                             // $result = $conn->query($sQuery);
                             // while($row = mysqli_fetch_array($result))
                             $data = $fee->show_fee();
                             if(!empty($data)){
                             foreach($data as $row)
                              {
                                echo "<option data-id=".$row['fe_id']." value='".$row['amount']."'>".ucwords($row['Description'])."</option>";
                              }
                            }
                            // else{
                            //   echo 'empty fee';
                            // }
                             ?>
                          </select> 

                          
                          <input class="form-control pull-right search_fee" type="text" id="search_fee" name="" placeholder="search..">
                         <!--  <label class="pull-left">Fun Run T-Shirt</label> -->
                          <a class="btn btn-default btn-sm pull-left modaladdnew"><i class="fa fa-plus"></i> Add Fees</a>
                          <h4 class="text-info fee_description"></h4>
                        </div>
                        
                        
                      </div>
                      <div class="box-body">
                        <div  id="student_table">
                        <table id="example12" class="table table-striped table-bordered">
                          <thead>
                            <th >#</th>
                            <th><i class="fa fa-user-times btnremove_fee"></i></th>
                            <th>ID Number</th>
                            <th >Full Name</th>
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
                                echo "
                                  <tr>
                                    <td>".$countz++."</td>
                                    <td><input type='checkbox' class='ckhbox' data-id=".$row['student_id']."></td>
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
                            <option style="font-style: italic; color: gray;" value="0">Choose tshirt</option>";
                           
                            <?php 
                            
                              $description = '';
                              $fee_id = 0;
                             // $sQuery = "SELECT * FROM fee_event where type = 2 and sem_id = ".$_SESSION['sem_id']." and sy_id = ".$_SESSION['sy_id']." and fe_status = 1 and fe_id <> '$fee_event_id' ";
                             // $result = $conn->query($sQuery);
                             // while($row = mysqli_fetch_array($result))
                             $data = $fee->show_tshirt();
                             if(!empty($data)){
                             foreach($data as $row){
                               // $fee_event_id  = $row['fe_id'];
                                echo "<option value='".$row['fe_id']."' data-id=".$row['amount'].">".ucwords($row['Description'])."</option>";
                                //$description = $row['Description'];
                                //$fee_id = $row['fe_id'];
                              }
                            }
                             ?>
                          </select> 
                          <a title="save changes" class='btn btn-info btn-xs pull-right save_change'><span class="save_changelabel"><i class='fa fa-save'></i> save changes</span></a>
                          <a class="btn btn-default btn-xs pull-right add_tshirt_size"><i class="fa fa-plus"></i> Add T-Shirt Size</a>
                             <!-- <input class="pull-right txt_tshirt_size" id="txt_tshirt_size" type="hidden" name="" placeholder="Enter T-Shirt Size"> 
                          <a title="Edit/Delete"  class="btn xclose"><b>&times;</b> </a> -->


                          <span class="pull-right search-box">
                            <input type="text" id="txt_tshirt_size" class="txt_tshirt_size" placeholder="Enter T-Shirt Size">
                            <a title="close" id="xclose" class="xclose"> &times;</a>
                          </span>
                         
                        <a  class="btn btn-success btn-sm  pull-left modaladdtshirt"><i class="fa fa-plus"></i> Add Tshirt Fee</a>
                        </div>
                        <input type="hidden" class="semester" value=" <?php echo $_SESSION['sem_id'] ?> ">
                        <div class="row" >
                             <input style="margin-top: 5px; height: 25px; font-size: 12px;" class="form-control pull-right search_tshirt" type="text" id="search_fee" name="" placeholder="search..">
                             <h4 class="text-info tshirt_description"></h4>
                             <input type="hidden" class="tshirt_fee_amount">
                        </div>
                      </div>
                      <div class="box-body">
                        <div  id="student_table"><input type="hidden" class="get_fee_id">
                        <table id="example12" class="table table-striped table-bordered">
                          <thead>
                            <th >#</th>
                            <th>ID Number</th>
                            <th >Full Name</th>
                            <th>Year/Section/Major</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>T-Shirt Size</th>
                            <th></th>
                          </thead>
                          <tbody id="tbodydata">
                            <?php
                            //  if(isset($_GET['id'])){
                            //     $fee_id = trim($_GET['id']); }
                            // $sql1 = "SELECT * FROM fee_event where fe_id = '$fee_id' ";
                            // $query1 = $conn->query($sql1);
                            // $row1 = $query1->fetch_assoc(); 
                            // $amount = $row1['amount'];
                              $countz = 1;
                              //$sql = "SELECT * FROM students".$_SESSION['sy_id']." s left join tshirt_size".$_SESSION['sy_id']." ts on s.student_id = ts.ts_student_id where s.sem".$_SESSION['sem_id']." = 1  order by s.year asc, s.firstname asc ";
                           
                             // $query = $conn->query($sql);
                             // while($row = $query->fetch_assoc()){
                               $data = $fee->show_all_tshirt();
                               if(!empty($data)){
                                 foreach($data as $row){
                                ?>
                                
                                  <tr>
                                    <td> <?php echo $countz++;?></td>
                                    <td> <?php echo $row['id_number'] ; ?></td>
                                    <td> <?php echo ucwords(strtolower($row['firstname']))." ".ucwords(strtolower($row['lastname'])); ?></td>
                                    <td> <?php echo $row['year']." ".ucwords(strtolower($row['section']))." ".ucwords(strtolower($row['major'])); ?> </td>  
                                    <td> <?php echo ucwords(strtolower($row['course'])) ?></td>
                                    <td class="tdshirt" ></td>
                                    <td class="tdshirt"></td>
                                    <td class="tdshirt"></td>
                                    <?php 
                                   //   if($fee_id == 0){ echo "<td class='tdsize".trim($row['student_id'])."'></td>";}else{
                                   // echo "<td class='tdsize".trim($row['student_id'])."'>".$row['size'.$fee_id.'']."</td>";
                                   // } 
                                   ?>
                                    <td>
                                      <select title='T-Shirt Sizes' class ='form-control pull-left size' name ='size' id='size' data-id='<?php echo $row['student_id']; ?>'>
                                        <option value=""></option>
                                        <option value="" style="color: red;">cancel</option>
                                        <?php 
                                        
                                        
                                        //$sqlw = "SELECT * FROM category where tshirt_size <> '' order by tshirt_size ";
                                          //$queryw = $conn->query($sqlw);
                                          //while($roww = $queryw->fetch_assoc()){
                                           // include 'model/category.php';
                                          //  $category = new category();
                                            $data = $fee->tshirt();
                                            if(!empty($data)){
                                              foreach($data as $roww){
                                            ?>
                                        <option value='<?php echo $roww['tshirt_size'] ; ?>'> <?php echo $roww['tshirt_size']; ?></option>
                                       
                                          <?php } }  ?>
                                        </select>
                                        

                                    </td>
                                  </tr>
                              <?php  
                              }
                            }

                            ?>
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
                      <div class="box-bodyz" style="margin: 20px;">
                        <table  id="fees_table" class="table table-striped table-bordered">
                          <thead style="background-color:#b3ffff";>
                            <th>#</th>
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

<script>
//  $(document).ready(function(){
//  $('.hoversize').hover(function(){
//     alert('sadsad');
//        // var name =  $(this).data('id');
//        // $(this).tooltip({title:''+name,placement:'left'});
//         var name = $(this).data('id');
//         $(this).tooltip({title:''+name,placement:'top'});
//     });
  
//   var tshirt_array = new Array();
//   var student_id_array = new Array();
//   var index_array = 0;
//    $('.size').on('change',function(){
    
//       var tshirt_size = $(this).val();
//        alert("tshirt_size:"+tshirt_size);
//       var student_id = $(this).data('id');
//       //var ss = ""+student_id+"";
//       //var student_id = (ss.trim());
//       var values = '.tdsize'+student_id+'';
//         //alert("tshirt_size:"+tshirt_size);
//        // alert(" student_id:"+student_id+"<");
//         // alert(" values:"+values+"<");
//        $(values).text(""+tshirt_size);
//       for(var i = 0; i < index_array + 1; i++)
//       {
//           if(student_id_array[i] == student_id )
//           {
//              tshirt_array[i] = null;
//             student_id_array[i] = null;
//            }
//              tshirt_array[index_array] = tshirt_size;
//             student_id_array[index_array] = student_id;
//       }
//        index_array++;

//   }); 
// });


    $(document).ready(function(){


       $(".view").tooltip({title:'Click to view more details',placement:'top'});
     $(".select1").tooltip({title:'Choose Contribution Fee',placement:'top'});
     $(".select2").tooltip({title:'Choose T-Shirt Fee',placement:'top'});
     $(".btnremove_fee").tooltip({title:'Remove students for this Fee',placement:'top'});
     $(".xclose").tooltip({title:'close',placement:'top'});


     var feetable =  $('#fees_table').DataTable({
     
     'ordering'  : false,
     "processing": false,
     "serveSide" : true,
         "async" : true,
   "responsive" : true,
         ajax : {
         type :"POST",
         url  : "action/fee.php",
         data : {
                 "all_fee": 'success'
             }
          //  error: function (){
          //      alert('Something Error for Getting Data From Student(s)! Please Again Later.')
          //  }
      },
       lengthMenu : [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ]
    });
   setInterval( function () {
    feetable.ajax.reload();
}, 1000 );
     
     
     
     

  });
var tshirt_array = new Array();
  var student_id_array = new Array();
  var index_array = 0;


   //  $('.size').on('change',function(){

   //    // var fee_id = $(this).val();

   //     alert("getttttt");

   //     $('.size > option:selected').each(function(){
   //       // var geteventidtshirt = $(this).val();
   // //        var tshirt_size = $(this).val();
   // //        // alert("tshirt_size:"+tshirt_size);
   // //        var student_id = $(this).data('id');
   // //        //var ss = ""+student_id+"";
   // //        //var student_id = (ss.trim());
   // //        var values = '.tdsize'+student_id+'';
   // //          alert("tshirt_size:"+tshirt_size);
   // //          alert(" student_id:"+student_id+"<");
   // //           alert(" values:"+values+"<");


   // alert(" geteventidtshirt");

   //      });


   //     });




  $('.size').on('change',function(){



    // errornotify(4,'Warning <br>Please Choose a tshirt menu first!');
     $('.select2').focus();
      // var tshirt_size = $(this).val();
      // // alert("tshirt_size:"+tshirt_size);
      // var student_id = $(this).data('id');
      // //var ss = ""+student_id+"";
      // //var student_id = (ss.trim());
      // var values = '.tdsize'+student_id+'';
      //   alert("tshirt_size:"+tshirt_size);
      //   alert(" student_id:"+student_id+"<");
      //    alert(" values:"+values+"<");
      //  $(values).text(""+tshirt_size);
      // for(var i = 0; i < index_array + 1; i++)
      // {
      //     if(student_id_array[i] == student_id )
      //     {
      //        tshirt_array[i] = null;
      //       student_id_array[i] = null;
      //      }
      //        tshirt_array[index_array] = tshirt_size;
      //       student_id_array[index_array] = student_id;
      // }
      //  index_array++;

  }); 

 var array_id = new Array();
 var array_id_index = 0;

$(document).on('click', '.modaladdtshirt', function(e){
    e.preventDefault();
     $('.feeheader').text('Add T-Shirt Fee');
    $('#addnew').modal('show');
     $('.gettype').val('1');


  });

$(document).on('click', '.xclose', function(e){
    e.preventDefault();
    $(".search-box").css("display","none");

  });

$(document).on('click', '.modaladdnew', function(e){
    e.preventDefault();
    $('.feeheader').text('Add Contribution Fee');
    $('#addnew').modal('show');
     $('.gettype').val('0');

  });


       $(document).on('click', '.ckhbox', function(){      
       var row = $(this).closest('tr');
       var getid = $(this).data('id');

          if($(this).prop("checked") == true)
          {
           // alert('checked');
            array_id[array_id_index] = getid;
            array_id_index++;
          }
          else if($(this).prop("checked") == false)
          {
           // alert('not checked');
             for(var i = 0;i< array_id.length; i++)
            {
              if(array_id[i] == getid){
                array_id[i] = null;
              }
            }
          }

        });


// $('input[type=checkbox]').click(function(){
//          var getid = $(this).data('id');
//           var row = $(this).closest('tr');    
//           if($(this).prop("checked") == true)
//           {
//             alert('checked');
//             array_id[array_id_index] = getid;
//             array_id_index++;
//           }
//           else
//           {
//              alert('not checked');
//             for(var i = 0;i< array_id.length; i++)
//             {
//               if(array_id[i] == getid){
//                 array_id[i] = null;
//               }
//             }
//           }

// });













 $(document).ready(function(){

 var concat_studentid = "";
    var found = false;
     var fee_eventid =  ""; 
      var amount =  $('.select1').val();

$(document).on('click', '.btnremove_fee', function(e){
    e.preventDefault();

    fee_eventid =  $('.setfeeid').val();
   
   for(var i = 0;i < array_id.length; i++){
      if(array_id[i] != null){
        //alert(""+array_id[i]);
        concat_studentid += array_id[i]+',';
        found = true;
      }
   }

   if(!found){
     errornotify(4,' Warning <br>Please select students first!');
   }
   else if(fee_eventid == "")
   {
     // errornotify(4,' Warning <br><br> Please select a fee first!');
     $('.select1').focus();
     array_id = [];
   }
   else
   {
    
        //alert(''+concat_studentid);
       // alert(' amount:'+amount);


       $('#confirm_fee_student_modal').modal('show');

                 


      }


  });




 $('.confirm_fee_student_modal').on('click',function(){

  amount =  $('.select1').val();

  //alert(" concat_studentid:"+concat_studentid);
 // alert(" amount:"+amount);

   $('#confirm_fee_student_modal').modal('hide');
   fee_eventid =  $('.setfeeid').val();

   $.ajax({  
                        url:"action/fee.php",  
                          method:"POST",  
                          data:{fee_eventid:fee_eventid,concat_studentid:concat_studentid,amount:amount}, 
                          beforeSend:function(){  
                             //  $('.addeventmodal').val("Saving...");  
                          },  
                          success:function(data){  
                          // $('.tbodydata').html(data);
                              // $('#form_addfee')[0].reset();  
                              
                              // $('.addeventmodal').modal('hide');
                               
                               //  window.location.href = "fee.php";

                              //  showNotification('top','right');

                              $("#search_fee").val("");

                              $.ajax({  
                                url:"action/fee.php",  
                                method:"POST",  
                                data:{geteventid:geteventid,amount:amount}, 
                                beforeSend:function(){  
                                  $('.tdamountloading').html('<img width="30" src="../images/loading2.gif">');  
                                },   
                                  success:function(data){  
                                    data =  $.parseJSON(data);
                                   $('.fee_table').html(data.html);
                                    $('.totalcostfee').text(""+data.costall);
                                    array_id = [];
                                    concat_studentid = "";
                                    successnotify(2,' Success :Successfully Removed Students');
                                      // $('#form_addfee')[0].reset();  
                                      
                                      // $('.addeventmodal').modal('hide');
                                       
                                        // window.location.href = "fee.php";

                                      //  showNotification('top','right');

                                  } 
                                });









                          }  
                        });



  });




}); // close for ready




  $('.add_tshirt_size').on('click',function(){
      
     // var x = document.createElement('INPUT');
      //$('.txt_tshirt_size').setAttribute("type","text");

      //$('.txt_tshirt_size').style.display = 'inline';

    //   var x = document.getElementById('txt_tshirt_size');
    // //  x.setAttribute("type","text");
    //    x.type = "text";

    $(".search-box").css("display","flex");



     var tshirt_size = $('.txt_tshirt_size').val();
     var column_name = "tshirt_size";
     var tshirt = true;
     // alert(' tshirt_size:'+tshirt_size+" cname:"+column_name);
     if(tshirt_size != '')
     {
      $.ajax({  
              url:"action/category1.php",  
              method:"POST",  
              data: {tshirt:tshirt,cname:column_name,cvalue:tshirt_size},
              beforeSend:function(){  
                        //  $('.addeventmodal').val("Saving...");  
              },  
              success:function(data){  
              //  alert('success');
               window.location.href = "fee.php";
              //           console.log(data);

              //   $('#tablemain').html(data);
              // // if(data == "success")
              //    showNotification('2',' &nbsp Successfully Added!<br><br>');



                     }  
               });
      }
      else{
        $('.txt_tshirt_size').focus();
        $(".txt_tshirt_size").tooltip({title:'Enter T-Shirt Size',placement:'top'});

      }
     
   });



 



   $('.select1').on('change',function(){
        var id = $(this).val();
       // $('.tdamount').text(""+id);

        $('#select1 > option:selected').each(function(){
          var value = $(this).val();
          if(value != "0"){
            var geteventid = $(this).data('id');
        var getevent_description = $(this).text();
         var amount =  $('.select1').val();
        $('.setfeeid').val(""+geteventid); 
        $('.fee_description').text(""+getevent_description); 
              $.ajax({  
                        url:"action/fee.php",  
                          method:"POST",  
                          data:{geteventid:geteventid,amount:amount}, 
                          beforeSend:function(){  
                             $('.tdamountloading').html('<img width="30" src="../images/loading2.gif">');  
                          },  
                          success:function(data){  
                          //  alert('success')
                           // data =  $.parseJSON(data);
                            // console.log(''+data.html);
                              $('.fee_table').html(data);
                             //$('.fee_table').html(data.html);

                             var costall = $('.totalfee').val();

                             //alert('cos:'+costall);
                             // const formatcurrency = amount => {
                             //    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g,"$&,");
                             //  } 
                            // $('.totalcostfee').text(""+formatcurrency(costall));
                            // alert('asa'+costall.formatMoney(2,".",","));
                            $('.totalcostfee').text(""+costall);
                              





                            // }
                              // $('#form_addfee')[0].reset();  
                              
                              // $('.addeventmodal').modal('hide');
                               
                                // window.location.href = "fee.php";

                              //  showNotification('top','right');

                          } 
                        });


              }



             
          });
      
   });

    $('.select2').on('change',function(){

      // var fee_id = $(this).val();

       $('.select2 > option:selected').each(function(){
          var getfeeidtshirt = $(this).val();
         // alert(" geteventidtshirt:"+geteventidtshirt);
          if(getfeeidtshirt != "0"){
            var tshirtamount = $(this).data('id');
        var getevent_description = $(this).text();
        $('.get_fee_id').val(""+getfeeidtshirt);
       $('.tshirt_fee_amount').val(""+tshirtamount);
        $('.tshirt_description').text(""+getevent_description);

         //  alert(' 1111111111111111111111111:');
          // alert(' amount:'+geteventids);
         //  alert(' 3:'+getevent_description);
          // $('.tbodydata').removeClass();

            $.ajax({  
                        url:"action/load_fee_student.php",  
                          method:"POST",  
                          data:{getfeeidtshirt:getfeeidtshirt}, 
                          //dataType: 'json',
                          beforeSend:function(){  
                            $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');
                          },  
                          success:function(data){  

                                   // data =  $.parseJSON(response);
                                  //  console.log(data);
                                      $('#tbodydata').html(data);

                                $.ajax({  
                                  url:"action/load_tshirt_stats.php",  
                                    method:"POST",  
                                   // dataType: 'json',
                                    data:{geteventidtshirt:getfeeidtshirt,tshirtamount:tshirtamount}, 
                                    beforeSend:function(){  
                                       //  $('.addeventmodal').val("Saving...");  
                                    },  
                                    success:function(data){  
                                    //  alert('success');
                                         $('.footer').html(data);
                                    } 
                                  });

                                       
                                       // if(data.status == 'success')
                                      //  {

                                       //  $('.tbodydata').html(data.html);

                                         //  }
                           
                          // $('.tbodydata').html(data);
                              // $('#form_addfee')[0].reset();  
                              
                              // $('.addeventmodal').modal('hide');
                               
                                // window.location.href = "fee.php";

                              //  showNotification('top','right');
                             

                          } 
                        });




                       






                      


              }

              
      });

     

   });

  



         $("#search_fee").on("keyup", function(){

                var value = $(this).val().toLowerCase();

                 $("table tr").each(function(index){
                    if(index != 0)
                    {
                      $row = $(this);
                      var id = $row.find("td:eq(0)").text();
                      var name = $row.find("td:eq(2)").text();
                      var age = $row.find("td:eq(3)").text().toLowerCase();
                      var sex = $row.find("td:eq(4)").text().toLowerCase();
                      var user = $row.find("td:eq(5)").text().toLowerCase();
                      if(id.indexOf(value) != 0  && name.indexOf(value) != 0 && age.indexOf(value) != 0
                       && sex.indexOf(value) != 0 && user.indexOf(value) != 0){
                        $(this).hide();
                      }
                     else{
                        $(this).show();
                      }
                    }
                 });


            });

         $(".search_tshirt").on("keyup", function(){

              
                var value = $(this).val().toLowerCase();

                 $("table tr").each(function(index){
                    if(index != 0)
                    {
                      $row = $(this);
                      var get1 = $row.find("td:eq(0)").text();
                      var get2 = $row.find("td:eq(1)").text();
                      var get3 = $row.find("td:eq(2)").text().toLowerCase();
                      var get4 = $row.find("td:eq(3)").text().toLowerCase();
                      var get5 = $row.find("td:eq(4)").text().toLowerCase();
                      var get6 = $row.find("td:eq(7)").text().toLowerCase();
                      if(get1.indexOf(value) != 0  && get2.indexOf(value) != 0 && get3.indexOf(value) != 0
                       && get4.indexOf(value) != 0 && get5.indexOf(value) != 0 && get6.indexOf(value) != 0){
                        $(this).hide();
                      }
                     else{
                        $(this).show();
                      }
                    }
                 });
               


            });


  
   

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





  $(document).on('click', '.save_change', function(e){
    e.preventDefault();
      var fee_id = $('.get_fee_id').val();
      if(fee_id > 0)
      {
      var tshirt_amount = $('.tshirt_fee_amount').val();
      var concat_student_id = "";
      var concat_tshirt_size = "";     // alert('id:'+fee_id);
      
      for(var i = 0; i < tshirt_array.length; i++)
      {
        if(tshirt_array[i] != null && tshirt_array[i] != "")
        {


        // alert(' fee_id:'+fee_id);

         concat_tshirt_size += tshirt_array[i]+",";
         concat_student_id += student_id_array[i]+",";
        
              // alert(""+i);

        }

      }

        if(concat_tshirt_size != '' && concat_student_id != '' && fee_id != ''){
      //  console.log(" tshirt_size:"+concat_tshirt_size);
      //    console.log(" student_id:"+concat_student_id);
      //    console.log(" fee_id:"+fee_id);

                  $.ajax({  
                        url:"action/fee.php",  
                          method:"POST",  
                          data:{fee_id:fee_id,student_id:concat_student_id,tshirt_size:concat_tshirt_size,tshirt_amount:tshirt_amount}, 
                          beforeSend:function(){  
                              $('.save_changelabel').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> saving changes');  
                              
                          },  
                          success:function(data){  


                              $.ajax({  
                                  url:"action/load_fee_student.php",  
                                    method:"POST",  
                                    data:{getfeeidtshirt:fee_id}, 
                                    beforeSend:function(){  
                                       $('.tdshirt').html('<img width="30" src="../images/loading2.gif">');   
                                    },  
                                    success:function(data){  


                                      // data =  $.parseJSON(data);
                                     
                                       
                                      //  if(data.status == 'success')
                                      //  {

                                         $('#tbodydata').html(data);

                                        //   }
                                        // $('#form_addfee')[0].reset();  
                                        
                                        // $('.addeventmodal').modal('hide');
                                         
                                          // window.location.hdddddddref = "fee.php";

                                        //  showNotification('top','right');

                                    } 
                                  });




                             $.ajax({  
                                  url:"action/load_tshirt_stats.php",  
                                    method:"POST",  
                                    data:{geteventidtshirt:fee_id,tshirtamount:tshirt_amount}, 
                                    beforeSend:function(){  
                                       
                                    },  
                                    success:function(data){  
                                         $('.footer').html(data);
                                    } 
                                  });

                          
                              // $('#form_addfee')[0].reset();  
                              
                              // $('.addeventmodal').modal('hide');
                               
                                // window.location.href = "fee.php?id="+fee_id+"";

                              //  showNotification('top','right');
                              // $('.save_changelabel').text(" save change"); 

                              

                               
                               
                                $('.search_tshirt').val(""); 

                          }  
                        });

                        $('.save_changelabel').html('<i class="fa fa-save"></i> save changes'); 




          // $.ajax({  
          //               url:"action/tshirt_size.php",  
          //                 method:"POST",  
          //               data:{fee_id:fee_id,student_id:concat_student_id,tshirt_size:concat_tshirt_size,tshirt_amount:tshirt_amount}, 
          //                 beforeSend:function(){  
          //                    //  $('.addeventmodal').val("Saving...");  
          //                 },  
          //                 success:function(data){  
                          
          //                     // $('#form_addfee')[0].reset();  
                              
          //                     // $('.addeventmodal').modal('hide');
                               
          //                      //  window.location.href = "fee.php?id="+fee_id+"";

          //                     //  showNotification('top','right');
          //                        $.ajax({  
          //                         url:"action/load_fee_student.php",  
          //                           method:"POST",  
          //                           data:{geteventidtshirt:fee_id}, 
          //                           beforeSend:function(){  
          //                              //  $('.addeventmodal').val("Saving...");  
          //                           },  
          //                           success:function(data){  
          //                            $('.tbodydata').html(data);
          //                               // $('#form_addfee')[0].reset();  
                                        
          //                               // $('.addeventmodal').modal('hide');
                                         
          //                                 // window.location.href = "fee.php";

          //                               //  showNotification('top','right');

          //                           } 
          //                         });

          //                 }  
          //               });

     //  alert(''+concat_student_id+":"+concat_tshirt_size);
//alert('finish');
         // window.location.href = "fee.php";

         // alert('Successfully all');











                   


                   }
                   else{
                    errornotify('4',' Warning <br>&nbspPlease Pick tshirt size to save change');
                   }








       }
       else
       {
               //errornotify(4,'Warning <br>Please Choose a tshirt menu first!');
               $('.select2').focus();
       }

  });




$(document).on('click', '.btn_confirm_del_fee', function(e){
    e.preventDefault();
    var description  = $('.del_description').val();
    var id = $('.deleteid').val();
   // alert(' id:'+id);
     $.ajax({  
          url:"action/fee.php",  
          method:"POST",  
          data:{fee_deleteid:id}, 
          beforeSend:function(){ 
          $('.btn_confirm_del_fee').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Deleting...');                       
           },  
           success:function(data){  
             if(data == 1){
              setInterval( function () {
                                feetable.ajax.reload();
                            }, 500 );
                               $('.btn_confirm_del_fee').html('<span class = "glyphicon glyphicon-trash"></span> Yes '); 
                               $('#confirm_del_fee_modal').modal('hide');
              addloghistory("Deleting","Fee",description);
              //  window.location.href = "fee.php";
             }
             else{
               alert('ERROR: DFee:ER')
             }
              
         } 
         });
  });


$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit_fee_modal').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.del', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    $('#confirm_del_fee_modal').modal('show');
    $('.deleteid').val(id);
    
  });
//   $(document).on('click', '.view', function(e){
//     e.preventDefault();

    
//    // $('.ac').removeClass('active');
//    //  $('.ac2').addClass('active');
//    //  $('#fee').toggleClass('active');
//     // $('#fee').show();
//     // $('#fee').tab('show');


//     //$('#edit').modal('show');
//     var id = $(this).data('id');
//     getRowview(id);
//     // alert('');
//   });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'action/fee.php',
    data: {get_fee_edit_id:id},
    dataType: 'json',
    success: function(response){
      $('.feeid').val(response.fe_id);
      $('#edit_description').val(response.Description);
      $('#edit_amount').val(response.amount);
      $('.del_description').val(response.Description);
      $('.confirm_del_fee_modal_description').text(""+response.Description);
      
      
    }
  });
}
// function getRowview(id){
//   $.ajax({
//     type: 'POST',
//     url: 'action/fee.php.php',
//     data: {get_fee_edit_id:id},
//     dataType: 'json',
//     success: function(response){
//       $('.feeid').val(response.fe_id);
//       $('#edit_description').val(response.Description);
//       $('#edit_amount').val(response.amount);

//       if(response.fe_status == 0){
//         $('.ac').removeClass();
//         $('.ac2').addClass('active');
//         $('#fee').toggleClass('active');
//         $('.select1').focus();
//         $(".select1").tooltip({title:'Choose Contribution Fee',placement:'top'});
//       }
//       if(response.fe_status == 1){
//         $('.ac').removeClass();
//         $('.ac3').addClass('active');
//         $('#tshirt_fee').toggleClass('active');
//         $('.select2').focus();
//         $(".select2").tooltip({title:'Choose Tshirt Fee',placement:'top'});
//       }

//     }
//   });
// }
function addloghistory(action,action_name,description){
     $.ajax({
          type: 'POST',
          url: 'action/log_history.php',
           data: {action:action,action_name:action_name,description:description},
          success: function(response){
                 // window.location.href = "events.php";
             }
          });

}

 
$("#addfee").click(function(){

     //  var fee_status = $("input[type='radio'][name='option']:checked").val();

    var gettype =  $('.gettype').val();
     var fee_id = $('.get_fee_id').val();
     var description = $('#description').val();

         if($('#description').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Description is Required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }  

        else  if($('#amount').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Amount is Required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }
           else{

         //   var gt = $('.gettype').val();
           // alert('saved events :'+gt);



             // alert("gt:"+gettype);

                   $.ajax({  
                          url:"action/fee.php",  
                          method:"POST",  
                          data:$('#form_addfee').serialize(), 
                          beforeSend:function(){  
                            $('#addfee').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Saving..');   
                          },  
                          success:function(data){  


                            setInterval( function () {
                                feetable.ajax.reload();
                            }, 500 );
                               $('#form_addfee')[0].reset(); 
                               $('#addfee').html('<i class="fa fa-save"></i> Save Fee'); 
                               $('#addnew').modal('hide');
                               successnotify(2," Fee Successfully Added" );
                          //  if(data == 1){
                          //    alert('success');
                          //  }
                          //  else{
                          //    alert('ERROR: AFEror');
                          //  }
                              // $('#form_addfee')[0].reset();  
                              // $('.addeventmodal').modal('hide');
                           //   addloghistory("Adding","Fee",description);
                            //   window.location.href = "fee.php";
                                // $.ajax({
                                //           type: 'POST',
                                //           url: 'action/log_history.php',
                                //           data: {action:"Adding",action_name:"Fee",description:description},
                                //           success: function(response){
                                //               window.location.href = "fee.php";
                                //           }
                                //         });
                          }  
                        });
           }  


 }); 

// $("#btnaddtshirt").click(function(){
//      //  var fee_status = $("input[type='radio'][name='option']:checked").val();

    

//          if($('#tshirtdescription').val() == "")  
//            {  
//                 $(".errormsg").css("color"," red");
//                 $(".errormsg").text("Tshirt Description is required!");

//             setTimeout(function(){
//                $(".errormsg").css("color"," white");
//             } , 2000);   
//            }  

//         else  if($('#tshirtamount').val() == "")  
//            {  
//                 $(".errormsg").css("color"," red");
//                 $(".errormsg").text("Tshirt Amount is required!");

//             setTimeout(function(){
//                $(".errormsg").css("color"," white");
//             } , 2000);   
//            }
//            else{

//             var gt = $('.gettype').val();
//            // alert('saved events :'+gt);



//            alert("gt"+gt);

//                    // $.ajax({  
//                    //        url:"action/add_fee.php",  
//                    //        method:"POST",  
//                    //        data:$('#form_addfee_tshirt').serialize(), 
//                    //        beforeSend:function(){  
//                    //           //  $('.addeventmodal').val("Saving...");  
//                    //        },  
//                    //        success:function(data){  
                           
//                    //             $('#form_addfee_tshirt')[0].reset();  
//                    //            // $('.addeventmodal').modal('hide');
                               
//                    //               window.location.href = "fee.php";
//                    //        }  
//                    //      });
//            }  


//  }); 





$("#editfee").click(function(){


         var  id = $('.feeid').val();
         var  description = $('#edit_description').val();
         var  amount = $('#edit_amount').val();
         if($('#edit_description').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Description is Required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }  

        else  if($('#edit_amount').val() == "")  
           {  
                $(".errormsg").css("color"," red");
                $(".errormsg").text("Amount is Required!");

            setTimeout(function(){
               $(".errormsg").css("color"," white");
            } , 2000);   
           }
           else{
                   $.ajax({  
                          url:"action/fee.php",  
                          method:"POST",  
                          data:{edit_fee_id:id,description:description,amount:amount}, 
                          beforeSend:function(){  
                             //  $('.addeventmodal').val("Saving...");  
                            $('#editfee').html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Updating..');  
                          },  
                          success:function(data){  
                            setInterval( function () {
                                feetable.ajax.reload();
                            }, 500 );
                               $('#form_editfee')[0].reset(); 
                               $('#editfee').html('<i class="fa fa-check-square-o"></i> Save Changes'); 
                               $('#edit_fee_modal').modal('hide');
                               successnotify(2," Fee Successfully Updated" );
                              addloghistory("Updated","Fee",description);
                              
                            //  window.location.href = "fee.php";
                             
                                // $.ajax({
                                //           type: 'POST',
                                //           url: 'action/log_history.php',
                                //           data: {action:"Updated",action_name:"Fee",description:description},
                                //           success: function(response){
                                //               window.location.href = "fee.php";
                                //           }
                                //         });
                              
                              // $('.addeventmodal').modal('hide');
                               
                                // window.location.href = "fee.php";

                             //   showNotification('top','right');

                          }  
                        });

           }  


 }); 
        // function showNotification(from, align){
        //     color = Math.floor((Math.random() * 4) + 1);

        //     $.notify({
        //         icon: "fa fa-plus",
        //         message: "Fee updated Successfully!"

        //     },{
        //         type: type[1],
        //         timer: 500,
        //         placement: {
        //             from: from,
        //             align: align
        //         }
        //     });
        // }
     
</script>














