<?php 
	if (isset($user)) 
	{
?>
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content h-100">

    <!-- Topbar -->
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="col-md-8">
       <div>
            
       </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php 
	}
	else
	{
        header('Location:'.WEBROOT.'Library/index');
	}
?>