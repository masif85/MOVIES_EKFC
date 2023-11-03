<?php
$this->load->view('ktadmin/includes/header');
$disabled="";
$editable=true;
if(@$is_editable[0]->total>0)
	{
		$editable=false;
		$disabled="disabled='disabled'";
	}
?>
  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
		
		
		 <div class="row">
		  
        <div class="col-lg-12">
          <div class="card">
      
            <div class="card-body">
                        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo $message; ?></h3>
              </div>
							
							 
						 
						 
						 
						 
						 
					 
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="myform" action="<?php if($editable): echo base_url("Admin/create_movie/$id"); endif; ?>" enctype="multipart/form-data">
                <div class="card-body">
					<div class="row">
						<div class="col-md-12">
			<div class="card card-warning">
				  <div class="card-header">
                <h3 class="card-title green">Basic Details</h3>
              </div>
			</div>	
							</div>	
						</div>
					<div class="row">
				<div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name or Title  &nbsp;<code>*</code></label>
                    <input type="text" name="title" <?=$disabled;?> value="<?=@$rows->title; ?>" required class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                  </div>
					
					 <div class="form-group">
                    <label for="exampleInputEmail1">Genre &nbsp;<code>*</code></label>						 
					<select name="genere"  required class="form-control type"  placeholder="Select Genre">
						<option value=""></option>
						<option value="Action" <?php if(@$rows->genere=='Action'):echo "Selected"; endif;?>>Action</option>
						<option value="Comedy" <?php if(@$rows->genere=='Comedy'):echo "Selected"; endif;?>>Comedy</option>
						<option value="Documentary" <?php if(@$rows->genere=='Documentary'):echo "Selected"; endif;?>>Documentary</option>
						<option value="Drama" <?php if(@$rows->genere=='Drama'):echo "Selected"; endif;?>>Drama</option>
						<option value="Fantasy" <?php if(@$rows->genere=='Fantasy'):echo "Selected"; endif;?>>Fantasy</option>
						<option value="Horror" <?php if(@$rows->genere=='Horror'):echo "Selected"; endif;?>>Horror</option>
						<option value="Musical" <?php if(@$rows->genere=='Musical'):echo "Selected"; endif;?>>Musical</option>
						<option value="Mystery" <?php if(@$rows->genere=='Mystery'):echo "Selected"; endif;?>>Mystery</option>
						<option value="Romance" <?php if(@$rows->genere=='Romance'):echo "Selected"; endif;?>>Romance</option>
						<option value="Science Fiction" <?php if(@$rows->genere=='Science Fiction'):echo "Selected"; endif;?>>Science Fiction</option>
						<option value="Thriller" <?php if(@$rows->genere=='Thriller'):echo "Selected"; endif;?>>Thriller</option>
						<option value="Western" <?php if(@$rows->genere=='Western'):echo "Selected"; endif;?>>Western</option>						
					</select>                 
                  </div>
					
					
				 <div class="form-group">
                    <label for="exampleInputFile">Cover Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="cover_picture" <?=$disabled;?> accept=".jpg,.jpeg,.png,.heic" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    
                    </div>
                  </div>
					<?php if(@$rows->cover_picture): ?>
				<div class="form-group">
              		 <img src="<?php echo base_url() ?>public/editions/pics/<?=$rows->cover_picture?>" width="150">
					<a class="btn btn-app" href="<?=base_url("Admin/delete_pic/editions/pics/$rows->id")?>" onclick="return confirm('Deleting this Picture will be irreversible, Are you sure you want to delete?')"><i class="fas fa-trash"></i> Delete</a>
					
					</div>
					<?php endif; ?>
					
					
					 <div class="form-group">
                    <label for="exampleInputFile">Video File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="movie_file" <?=$disabled;?> accept=".mov,.mp4,.avi" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    
                    </div>
                  </div>
					
					
					
					
						</div>
								
										
					</div>				
					<div class="row">
						<div class="col-md-10">
							<div class="card card-success">
								  <div class="card-header">
								<h3 class="card-title green">Assets Section</h3>
							  </div>
							</div>	
							</div>	
					</div>			
							
			<div class="row col-lg-10">
				<div class="col-md-12" style="border-right:1px dashed #6A6565; ">
					<div  class="input-group input-group-sm"> 
						<span class="input-group-append">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-xl">
                         Movie
                        </div>
                      </div>		
					<?php if(@$rows->video_type=='mp4' || @$rows->video_type=='avi'  || @$rows->video_type=='mov'): ?>		
                      <small style="/*position: absolute;top: 0px;left: 0px;*/">						   
					<video width="auto" height="180" controls="">
					  <source src="<?php echo base_url() ?>public/editions/assets/<?=$rows->video?>" type="video/mp4">
					</video>								
					</small>														
					<?php endif; ?>                   					
					</span>								
				</div>	
				</div>	
				</div>		
				<div class="container" class="clearfix">&nbsp;&nbsp;&nbsp;</div>					
			<div class="unitz"></div>
					<div class="clearfix">&nbsp;</div>
					<div class="clearfix">&nbsp;</div>
					<div class="progress">
    <div class="progress-bar"></div>
</div>
		<div id="uploadStatus"></div>
          </div>
				
				
				  </div>				  
                <!-- /.card-body -->
               
				  <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="submit">
                </div>
				
              </form>
            </div>
            </div>
            <!-- /.card-body -->
			  		
          <!-- /.card -->
		<!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
 


		
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('ktadmin/includes/footer'); ?>
<script>
	
	
	$(".type").change(function(){
		var choice=$(this).val();
		var field_id=$(this).attr("data-field");		
		var number=$(this).attr("data-num");
		if(choice!='')
			{
					$.ajax({
					url: "<?php echo base_url('Admin/get_choice'); ?>",
					type: "POST",
					dataType: "json",       
					data: {choice:choice,field_id:field_id,number:number},
					success: function (response){
					$(".colmd_"+response['number']).html(response['title']);		
					}
				  });
			}		
	});	

	



	
	

	function removeunit(container)  
	{
		
		$(".unit_"+container).remove();
		//reindex_array_keys(testArray);
	}
	
	$(function() {
    //hang on event of form with id=myform
    $("#myform").on('submit', function(e){
        e.preventDefault();
		 var actionurl = e.currentTarget.action;
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: actionurl,
			 dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
               // $('#uploadStatus').html('<img src="images/loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
			var resps = JSON.stringify(resp);
			resps= $.parseJSON(resps);
				
                if(resps['msg']=='success'){
                    //$('#myform').reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
					 location.reload();
                }else if(resps['msg'] == 'failure'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
					Swal.fire({	
						title: "Error",
						text: "Some Error Occurred",
						type: "error",
						showCancelButton: false,
						confirmButtonClass: 'btn-error',
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
                }
            }
        });
    });

});
	
	
	function reindex_array_keys(array, start){
    var temp = [];
    start = typeof start == 'undefined' ? 0 : start;
    start = typeof start != 'number' ? 0 : start;
    for(var i in array){
        temp[start++] = array[i];
    }
    return temp;
}
	
	
  $('.custom-file-input').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
	
	
	function file_label(unit)
	{
		
                //get the file name
                var fileName = $('.custom-file-input-'+unit+'').val();
                //replace the "Choose a file" label
                $('.custom-file-input-'+unit+'').next('.custom-file-label-'+unit+'').html(fileName);
           
	}
</script>