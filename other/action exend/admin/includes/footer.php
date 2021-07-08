<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>SSC Fines Management System</b>
      <p style="font-size: 10px; margin-top: -2px; ">&copy; <script>  document.write(new Date().getFullYear()); </script> Develop by <a href="#">ME</a></p>
    </div>
    <p style="font-size: 13px; font-style: italic; font-weight: 200;"><span>SY:<span style="color: blue;"> <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sy_range']; }else{ echo "___-___"; }?></span> 
    Semester:<span style="color: blue;"> <?php if(isset($_SESSION['sy_id'])) { echo $_SESSION['sem_id']; }else{ echo "_";} ?></span></span></p>
</footer>
<?php include 'loading_modal.php'; ?>
