<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MovieHunter</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/front/css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/player/css/main.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/front/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/front/js/jquery-func.js"></script>



   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="<?php echo base_url(); ?>public/front/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>public/front/themes/krajee-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>public/front/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>public/front/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css"/>
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>public/front/js/star-rating.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/front/themes/krajee-fas/theme.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/front/themes/krajee-svg/theme.js" type="text/javascript"></script>



<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>
<body>
<!-- START PAGE SOURCE -->
<div id="shell">
  <div id="header">
    <h1 id="logo"><a href="#">EKFC Movies</a></h1>
    
    <div id="navigation">
      <ul>
        <li><a class="active" href="#">HOME</a></li>
        <!-- <li><a href="#">NEWS</a></li>
        <li><a href="#">IN THEATERS</a></li>
        <li><a href="#">COMING SOON</a></li>
        <li><a href="#">CONTACT</a></li>
        <li><a href="#">ADVERTISE</a></li> -->
      </ul>
    </div>
    <div id="sub-navigation">

    
    </div>
  </div>
  <div id="main">
    <div id="content">
      <div class="box">
       <div class="row">
		  
        <div class="col-lg-12">
		<?php 
$sr=1;

$total_records_per_page = 3;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 
		$total_records = $total_records->total_records;
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; 
	

    foreach($movies as $rows): ?>
	
        <div class="movie" style="padding-bottom: 51px;">
          <div class="movie-image" id="video_container"> 
		  <span   class="play htmlvid" vidSrc="<?php echo base_url(); ?>public/editions/assets/<?=$rows->video?>">
		  <span class="name"><?=$rows->title?></span></span> <a   href="#">		  
		  <img  src="<?php echo base_url(); ?>public/editions/pics/<?=$rows->cover_picture?>"  alt="" /></a>
		  </div> 		  
          <div class="rating">
            <p>RATING</p>
            <div class="stars" movie_id="<?=$rows->id?>">             
			  <input id="input-22" value="<?=$rows->rating?>" type="text" class="rating" data-theme="krajee-fas" data-min=0 data-max=5 data-step=0.5 
               data-container-class='text-left' data-glyphicon=0 title="" >
            </div>
           </div>
        </div>
		
      <?php 
        if($sr==5):
          $sr=0;
          echo "</div><div class='box'>";
		 
        endif;
        $sr++;
        endforeach;?>
      
    </div>
    </div>
     </div>
    
  </div>
  <div class="row">
  <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
  </div>
  <div id="footer">
  


  
  
  
    <p class="lf">Copyright &copy; 2010 <a href="#">EKFC Movies</a> - All Rights Reserved</p>
    <p class="rf">Design by <a href="http://asifabbasi.com/">asifabbasi.com</a></p>
    <div style="clear:both;"></div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
<script  src="https://www.khaleejtimes.com/wp-content/themes/ktd-theme/assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>public/player/js/BigPicture.js"></script>
	<script>
		$(".htmlvid").click(function(e){		
						BigPicture({
						el: e.target,
						vidSrc: $(this).attr('vidSrc'),
					})
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
		});     
           
        });
	</script>
</html>