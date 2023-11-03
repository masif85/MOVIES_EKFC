<?php
$this->load->view('ktadmin/includes/header');
?>
  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
		

		 <div class="row">
		  
        <div class="col-lg-12">
          <div class="card">
       <!--     <div class="card-header">
              <h3 class="card-title"><?php echo $message; ?></h3>
            </div>-->
            <!-- /.card-header -->
            <div class="card-body">

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		<!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->		
      <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title">Subscription Detail</h1> 
					&nbsp;&nbsp;
				<a class="btn btn-app" href="#" onClick="demoFromHTML();">
                  <i class="fas fa-file-pdf"></i> Pdf
                </a>
				<div id="editor"></div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				
            </div>				
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>		
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php $this->load->view('ktadmin/includes/footer'); ?>



