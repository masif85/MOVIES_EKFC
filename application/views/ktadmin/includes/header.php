<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KT Subscriptions| Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url() ?>public/admin/dist/img/favicon.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/jqvmap/jqvmap.min.css">
	
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">		
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->	
  <link rel="stylesheet" href="<?php echo base_url() ?>public/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<script src="<?php echo base_url(); ?>public/admin/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/plugins/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">	
	
	
	
	<?php $sdata = @$this->session->flashdata('msg');
	$type = @$this->session->flashdata('type');	
	$detail = @$this->session->flashdata('detail');
	$close = @$this->session->flashdata('close');
	
	if($sdata=='unauthorized')
	{
		
		?>
	<script src="<?php echo base_url(); ?>public/admin/plugins/jquery/jquery.min.js"></script>	
	<script>
      $(document).ready(function(){
        Swal.fire({
          title: "<?php echo $detail; ?>",
          text: "",
          type: "<?php echo $type; ?>",
		 
          showCancelButton: false,
          confirmButtonClass: 'btn-<?php echo $type; ?>',
          closeOnConfirm: true,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
			  <?php //echo $close; ?>
			 // window.top.close();
			 // window.open("<?php echo base_url("Main"); ?>",'_self');
            //swal("Deleted!", "Your imaginary file has been deleted!", "success");
          } else {
              //window.open("<?php echo base_url("Main"); ?>",'_self');
          }
        });
      });

    
    </script>
	<?php
	}
	?>
	
	
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
       

      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
         
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Account Settings</span>
                 <div class="dropdown-divider"></div>
          <a href="#" data-toggle="modal" data-target="#modal-settings" class="dropdown-item">
            <i class="fa-solid fa-shield fas fa-user"></i>&nbsp; Account Settings
           
          </a>
          <div class="dropdown-divider"></div>

          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url("Login/logout"); ?>" class="dropdown-item">
            <i class="fa-solid fa-shield fas fa-sign-out-alt"></i> Logout
           
          </a>
          <div class="dropdown-divider"></div>
         
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url() ?>public/images/KT.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>public/profile_pics/<?=$this->session->userdata('profile_pic')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$this->session->userdata('full_name')?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			 <?php
			
			 if($this->Main_Model->single_value("role_id = '".$this->session->userdata('sess_user_role')."' and controller_slug = 'Admin' and method_slug='dashboard'", "access_id", "tbl_user_access_permissions")){
			  ?>
			
			
          <li class="nav-item">
            <a href="<?php echo base_url("Admin/dashboard") ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              
              </p>
            </a>
           
          </li>
			<?php } 
			
			 if($this->Main_Model->single_value("role_id = '".$this->session->userdata('sess_user_role')."' and controller_slug = 'Admin' and method_slug='movies'", "access_id", "tbl_user_access_permissions")){
			?>
			
          <li class="nav-item has-treeview <?php if($this->router->fetch_method()=='movie_detail'): echo "menu-open"; endif; ?>">
            <a href="#" class="nav-link <?php if($this->router->fetch_method()=='movie_detail'): echo "active"; endif; ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Movies
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          <?php  if($this->Main_Model->single_value("role_id = '".$this->session->userdata('sess_user_role')."' and controller_slug = 'Admin' and method_slug='movies'", "access_id", "tbl_user_access_permissions")){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url("Admin/movies") ?>" class="nav-link <?php if($this->router->fetch_method()=='movie_detail'): echo "active"; endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Movie(s)</p>
                </a>
              </li>
				<?php } ?>		
				 <?php  if($this->Main_Model->single_value("role_id = '".$this->session->userdata('sess_user_role')."' and controller_slug = 'Admin' and method_slug='add_movie'", "access_id", "tbl_user_access_permissions")){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url("Admin/add_movie") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Movie</p>
                </a>
              </li> 
				<?php } ?>		
            </ul>
          </li>
			
			<?php } 
			
			
			  ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ', ucwords($this->uri->segment(2))); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			<?php if($this->uri->segment(2)=='manage_users'):?><li><button type="button" class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#modal-default">Add User</button></li> <li class="breadcrumb-item">&nbsp;</li><?php endif; ?>
				
              <li class="breadcrumb-item"><a href="#"><?php echo ucwords($this->uri->segment(1)); ?></a></li>
              <li class="breadcrumb-item active"><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ', ucwords($this->uri->segment(2))); ?></li>
				 
            </ol>
			 
	
             
            
               
              
              
            
              <!-- /.card-body -->
           
	
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->