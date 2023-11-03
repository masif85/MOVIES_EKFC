<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Entertain Pro</title>
	<link href="<?php echo base_url(); ?>public/front/new/css/bootstrap.min.css"  rel="stylesheet" type="text/css" >
	
	<link href="<?php echo base_url(); ?>public/front/new/css/font-awesome.min.css" rel="stylesheet" >
	<link href="<?php echo base_url(); ?>public/front/new/css/global.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/front/new/css/index.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<script src="<?php echo base_url(); ?>public/front/new/js/bootstrap.bundle.min.js"></script>
	
	   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="<?php echo base_url(); ?>public/front/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>public/front/themes/krajee-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>public/front/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css"/>
	
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>public/front/js/star-rating.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/front/themes/krajee-fas/theme.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/front/themes/krajee-svg/theme.js" type="text/javascript"></script>
	
	

</head>
<body>

<section id="header">
<?php if (!@$this->session->userdata('id')): ?>

<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				   <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">LOG IN</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
					<div class="modal-body">
						
						<form class="ps-3 pe-3 signin" method="post" action="<?php echo base_url("Home/user_login"); ?>">
							
							 
							<div class="mb-3">
								<label for="emailaddress" class="form-label">Email address</label>
								<input class="form-control" type="email" name="username" id="emailaddress" required="" placeholder="info@gmail.com">
							</div>
							 
							<div class="mb-3">
								<label for="password" class="form-label">Password</label>
								<input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
							</div>
							 
						
							 
							<div class="mb-3 text-center">
							 <h6><button type="submit" class="button_1 d-block" href="#">LOG IN</button></h6>
							</div>
						 
						</form>
					 
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>





<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				   <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">SIGN UP</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
					<div class="modal-body">
						
						<form class="ps-3 pe-3 signup" method="post" action="<?php echo base_url("Home/signup"); ?>">
							<div class="mb-3">
								<label for="username" class="form-label">Name</label>
								<input class="form-control" type="text" name="name" id="name" required="" placeholder="Enter Full Name">
							</div>
							 
							<div class="mb-3">
								<label for="emailaddress" class="form-label">Email address</label>
								<input class="form-control" type="email" name="username" id="emailaddress" required="" placeholder="info@gmail.com">
							</div>
							 
							<div class="mb-3">
								<label for="password" class="form-label">Password</label>
								<input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
							</div>
							 
							<div class="mb-3">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="customCheck1">
									<label class="form-check-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
								</div> 
							</div>
							 
							<div class="mb-3 text-center">
							 <h6><button type="submit" class="button_1 d-block" href="#">SIGN UP</button></h6>
							</div>
						 
						</form>
					 
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<?php endif; ?>
<nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
  <div class="container-fluid">
    <a class="navbar-brand fs-4 p-0 fw-bold text-white text-uppercase" href="index.html"><i class="fa fa-video-camera me-1 col_light fs-1 align-middle"></i> EKFC Movie Lab</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     
	  <ul class="navbar-nav mb-0 ms-auto">
	    
        <li class="nav-item">
			<select name="genere"  required class="form-select bg-light"  placeholder="Select Genre">
						<option value="">All Categories</option>
						<option value="Action">Action</option>
						<option value="Comedy">Comedy</option>
						<option value="Documentary">Documentary</option>
						<option value="Drama">Drama</option>
						<option value="Fantasy">Fantasy</option>
						<option value="Horror">Horror</option>
						<option value="Musical">Musical</option>
						<option value="Mystery">Mystery</option>
						<option value="Romance">Romance</option>
						<option value="Science Fiction">Science Fiction</option>
						<option value="Thriller">Thriller</option>
						<option value="Western">Western</option>						
					</select>       
			
			<div class="input-group">
				<input type="text" class="form-control border-start-0" placeholder="Search Movie">
				<span class="input-group-btn">
					<button class="btn btn-primary bg_yell" type="button">
						<i class="fa fa-search"></i> </button>
				</span>
		</div>
        </li>
	<?php if (!@$this->session->userdata('id')): ?>
	<li class="nav-item ms-3">
          <a class="nav-link button" data-bs-toggle="modal" data-bs-target="#login-modal" href="#">LOG IN</a>
        </li>	
		<li class="nav-item ms-3">
          <a class="nav-link button" data-bs-toggle="modal" data-bs-target="#signup-modal" href="#">SIGN UP</a>
        </li>
		<?php endif; ?>
		<!-- /.modal -->
		
      </ul>
    </div>
  </div>
</nav>
</section>



<section id="upcome" class="p_3 bg-light">
 <div class="container-xl">
  <div class="row upcome_1 text-center">
   <div class="col-md-12">
     <h3 class="mb-0">LATEST MOVIES</h3>
	 <hr class="line me-auto ms-auto">
	 <ul class="nav nav-tabs justify-content-center border-0 mb-0 mt-4">
    <li class="nav-item">
        <a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
            <span class="d-md-block">Upcoming</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#profile" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
            <span class="d-md-block">Released</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link border-0">
            <span class="d-md-block">Best of library</span>
        </a>
    </li>

</ul>
   </div>
  </div>
  <div class="row upcome_2 mt-4">
    <div class="tab-content">
    <div class="tab-pane active" id="home">
       <div class="upcome_2i row">
	   		<?php 
$sr=1;


    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 
		$total_records = $total_records->total_records;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; 
	

    foreach($movies as $rows): ?>
	   
	     <div class="col-md-3">
		  <div class="upcome_2i1 clearfix position-relative">
		   <div class="upcome_2i1i clearfix">
		    <img src="<?php echo base_url(); ?>public/editions/pics/<?=$rows->cover_picture?>" class="w-100 h100" style="height:300px" alt="abc">
		   </div>
		   <div class="upcome_2i1i1 clearfix position-absolute top-0 text-center w-100">
		    <h6 class="text-uppercase "><a class="button_1 play htmlvid" href="#" vidSrc="<?php echo base_url(); ?>public/editions/assets/<?=$rows->video?>">View Trailer</a></h6>
			
		<!--	<h6 class="text-uppercase mb-0"><a class="button_2" href="#">View Details</a></h6> -->
		   </div>
		  </div>
		   <div class="upcome_2i_last bg-white p-3">
		     <div class="upcome_2i_lasti row">
			  <div class="col-md-12 col-12">
			   <div class="upcome_2i_lastil">
			    <h5><a href="#"><?=$rows->title?></a></h5>
				<h6 class="text-muted"><?=$rows->genere?></h6>
				 <div class="rating">
           
            <div class="stars" movie_id="<?=$rows->id?>">             
			  <input id="input-22" value="<?=$rows->rating?>" type="text" class="rating" data-theme="krajee-fas" data-min=0 data-max=5 data-step=0.5 
               data-container-class='text-left' data-glyphicon=0 title="" >
            </div>
           </div>
			   </div>
			  </div>
			 
			 </div>
		   </div>
		 </div>
		  <?php      

        endforeach;?>
		 		 
		 
		 
		</div>
	   <div class="upcome_2i row mt-4">
	  
		  <div class="row">
  <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>
<nav aria-label="...">
<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?>>
	<a class='page-link' <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='page-item active' aria-current='page'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item'><a class='page-link'>...</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='page-item active' aria-current='page'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item'><a class='page-link'>...</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='page-item active' aria-current='page'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='page-item disabled'"; } ?>>
	<a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
</nav>
  </div>
		 
	   </div>
    </div>
    
    
</div>
  </div>
 </div>
</section>







<section id="footer" class="p_3">
 <div class="container-xl">
   <div class="row footer_1">
     <div class="col-md-2">
	  <div class="footer_1i">
	   <h6 class="text-white fw-bold">LANGUAGE MOVIES</h6>
	   <hr class="line mb-4">
	   <div class="row footer_1i_small">
	   <h6 class="col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">English Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Tamil Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Punjabi Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Hindi Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Malyalam Movie</a></h6>
	   <h6 class="mb-0 mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#"> Action Movie</a></h6>
	   </div>
	  </div>
	 </div>
	 <div class="col-md-4">
	  <div class="footer_1i">
	   <h6 class="text-white fw-bold">TAG CLOUD</h6>
	   <hr class="line mb-4">
	   <ul class="mb-0">
	    <li class="d-inline-block"><a class="d-block" href="#">Analyze</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Audio</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Blog</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Business</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Creative</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Design</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Experiment</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">News</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Expertize</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Express</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Share</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Sustain</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Video</a></li>
		<li class="d-inline-block"><a class="d-block" href="#">Youtube</a></li>
	   </ul>
	  </div>
	 </div>
	 <div class="col-md-2">
	  <div class="footer_1i">
	   <h6 class="text-white fw-bold">BY PRESENTER</h6>
	   <hr class="line mb-4">
	   <div class="row footer_1i_small">
	   <h6 class="col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Action Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Romantic Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Other Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Comedy Movie</a></h6>
	   <h6 class="mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Drama Movie</a></h6>
	   <h6 class="mb-0 mt-2 col-md-12 col-6"><i class="fa fa-circle me-1 col_red font_10"></i> <a class="text-muted" href="#">Classical Movie</a></h6>
	   </div>
	  
	  </div>
	 </div>
	 <div class="col-md-4">
	  <div class="footer_1i">
	   <h6 class="text-white fw-bold">SUBSCRIPTION</h6>
	   <hr class="line mb-4">
	   <p class="text-muted">Subscribe your Email address for latest news & updates.</p>
	   <input class="form-control bg-transparent" placeholder="Enter Email Address" type="text">
	   <h6 class="mb-0 mt-4"><a class="button_1 pt-3 pb-3" href="#">Submit <i class="fa fa-check-circle ms-1"></i> </a></h6>
	  </div>
	 </div>
   </div>
 </div>
</section>



<script>
window.onscroll = function() {myFunction()};

var navbar_sticky = document.getElementById("navbar_sticky");
var sticky = navbar_sticky.offsetTop;
var navbar_height = document.querySelector('.navbar').offsetHeight;

function myFunction() {
  if (window.pageYOffset >= sticky + navbar_height) {
    navbar_sticky.classList.add("sticky")
	document.body.style.paddingTop = navbar_height + 'px';
  } else {
    navbar_sticky.classList.remove("sticky");
	document.body.style.paddingTop = '0'
  }
}
</script>

<script src="<?php echo base_url(); ?>public/player/js/BigPicture.js"></script>
	<script>
	
		$(".htmlvid").click(function(e){	
<?php if (@$this->session->userdata('id')): ?>		
						BigPicture({
						el: e.target,
						vidSrc: $(this).attr('vidSrc'),
					})
					<?php
else:
echo "$('#signup-modal').modal('toggle');";
endif; ?>
	});	
	
	 jQuery(document).ready(function () {  
            $('#btn-rating-input').on('click', function () {
                $inp.rating('refresh', {
                    showClear: false,
                    disabled: !$inp.attr('disabled')
                });
            });
            $('.btn-danger').on('click', function () {
                $("#kartik").rating('destroy');
            });
            $('.btn-success').on('click', function () {
                $("#kartik").rating('create');
            });
		
            $(".star").click(function(){
					<?php if (@$this->session->userdata('id')): ?>
				var star_val=$(this).attr("title");
				var movie_id=$(this).closest('.stars').attr("movie_id");				
		jQuery.ajax({
        url: "<?=base_url('Admin/sub_rating')?>",
        type: "POST",
        dataType: "json",
        data: {rating:star_val,movie_id:movie_id},
        success: function (result) {    
	
        },
        error: function (err) {
            // check the err for error details
        }
			}); 
			<?php 
			else:
			echo "$('#signup-modal').modal('toggle');";
			endif; ?>	
		}); 
	
           
        });
	</script>

</body>

</html>