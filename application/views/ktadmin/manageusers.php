<?php
$this->load->view('ktadmin/includes/header');
?>
  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
		
		<?php if($search_page=="true"): ?>
		<form method="post" action="<?php echo base_url("Admin/subscriptions");?>" >
      <div class="row">
		  	  <div class="col-lg-3">
                <!-- Date range -->
               <div class="form-group">
                  <label>Mode:</label>
                  <select class="select2bs4" name="mode" data-placeholder="Select Type" style="width: 100%;">
					  <?php
					  $textmaz="";
					  if($mode):?>
					  <option value="<?=$mode?>" selected><?=$mode_text?></option> 
					  <?php 	
						else: 
							$textmaz="selected";
						endif; ?>
					   <option value="subscription_date" <?=$textmaz?> >Subscription Start / End Date</option>					  
					   <option value="order_date">Order Date</option>
					 
                   
                  </select>
                </div>	
						
				</div>
		  <div class="col-lg-2">
                <!-- Date range -->
                <div class="form-group">
                  <label>Date range:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" name="date_range" class="form-control float-right reservation" autocomplete="off" value="<?=@$date_range?>" id="reservation">
                  </div>
                  <!-- /.input group -->
                </div>			
						
				</div>
<!--		  
		  
		  <div class="col-lg-2">
              
                <div class="form-group">
                  <label>Day Filter:</label>

                  <div class="input-group">
                    <button type="button" class="btn btn-default btn-block" name="day_filter" id="daterange-btn">
                      <i class="far fa-calendar-alt"></i>&nbsp;<span class="date_range">Click to Select</span>
                      <i class="fas fa-caret-down"></i>
                    </button>
					  <input type="hidden" name="input-range" id="input-range" value="">
                  </div>
                </div>	
						
				</div>
		  -->
		  <div class="col-lg-4">
                <!-- Date range -->
               <div class="form-group">
                  <label>Subscription Type</label>
                  <select class="select2bs4" multiple="multiple" name="subscription_type[]" data-placeholder="Select Subscription"
                          style="width: 100%;">
					  <?php if($types): 
					  foreach($types as $typez):
					  ?>
					  <option value="<?=$typez->id?>" selected><?php echo $typez->pretty_text_type; ?>- <?php echo $typez->text; ?></option>
					  <?php
					  endforeach;
					  endif;
					  ?>
					  <?php foreach($sub_types as $stypes): ?>
					   <option value="<?php echo $stypes->id; ?>"><?php echo $stypes->pretty_text_type; ?>- <?php echo $stypes->text; ?></option>
					  <?php endforeach; ?>
                   
                  </select>
                </div>	
						
				</div>
		  <div class="col-lg-0.8">
			  <div class="form-group">  
				  <label>&nbsp;</label>
			  <div class="input-group"> 
                  <button type="submit" class="btn btn-primary">Search</button> 
				 
			  </div>
			  </div>
		  </div>
		  
		   <div class="col-lg-1">
			  <div class="form-group">  
				  <label>&nbsp;</label>
			  <div class="input-group"> 
                 
				 <button type="button" onClick="location.href='<?php echo base_url("Admin/subscriptions"); ?>';" class="btn btn-primary btn-danger">Clear</button>
			  </div>
			  </div>
		  </div>
		  
		</div>
		</form>
		<?php endif; ?>
		
		 <div class="row">
		  
        <div class="col-lg-12">
          <div class="card">
       <!--     <div class="card-header">
              <h3 class="card-title"><?php echo $message; ?></h3>
            </div>-->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
					
					<?php 
					if($rows):
						foreach($rows as $object) {
							foreach ($object as $key => $value) {			
								echo "<th data-toggle='true'>$key</th>";
									}	
							 break;
						} 
					
					
					endif;
					?>
						</tr>
						</thead>
						<tbody>							
						<?php 
							if($rows):
						foreach($rows as $objects) {
							echo "<tr>";
								foreach($objects as $keys => $rs){							
									echo "<td>$rs</td>";
							}	
							echo "</tr>";
						}
							else:
					echo "<th>Nothing Found</th>";
					
							endif;
							
						?>
						</tbody>                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		<!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->		

		
		
		
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
			 <form role="form" method="post" action="<?php echo base_url("Admin/add_user"); ?>">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                  <div class="row">
                    <div class="col-sm-10">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Name">
                      </div>
                    </div>					  
					<div class="col-sm-10">
                      <!-- text input -->
                      <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" required name="user_email" id="user_email" class="form-control" placeholder="Enter Email">
                      </div>
                    </div>
					  
					  <div class="col-sm-10">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" required name="password" id="password" class="form-control" placeholder="Password">
						   <input type="hidden"  name="user_id" id="user_id">
                      </div>
                    </div>
					  
					    <div class="col-sm-10">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Role</label>
                       <select name="user_role" id="user_role" required class="form-control"  placeholder="Select User's Role">
						<option value="" class="hides"></option>							
						<?php foreach($roles as $roll): ?>
						<option value="<?=$roll->role_id?>" data-role="<?=$roll->role_id?>" <?php //if(@$rows->id == $roll->role_id): echo "selected"; endif; ?>><?=$roll->role_name?></option>
						<?php endforeach; ?>					
					</select>  
                      </div>
                    </div>
					  
					
                   
                  </div>
				
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
				 </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php $this->load->view('ktadmin/includes/footer'); ?>

<script>
$('.call_modal').click(function(){  
	
	var id=$(this).attr('data_id');	
	
	var page=$(this).attr('data_page');	
	var url = "<?php echo base_url("Admin/"); ?>"+page; 
    $.ajax({
        url: url,
		type:"POST",
		data:{id:id},
        dataType: 'json',		
        success: function(res) {
            // get the ajax response data
            var data = res;
			$(".modal-title").html("Update User");
			$("#full_name").val(data.full_name);
			$("#user_email").val(data.user_email);
			$("#user_id").val(data.id);
			//var this_selected=$("#user_role").find("[data-role='"+data.user_role+"']");
			$("#user_role [data-role='"+data.user_role+"']").attr("selected","selected");
			$("#password").removeAttr("required");
			$("#password").attr("placeholder","Leave blank if you don't want to change");
			$(".hides").remove();
            // update modal content here
            // you may want to format data or 
            // update other modal elements here too
           // $('.modal-body').html(data);
	
            // show modal
            $('#modal-default').modal('show');
        }
    });
});
	
	
	$('#modal-default').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
	.find(".modal-title").html('Add User')
		.end()
		.find("#password").attr("placeholder","Enter Password")
		.end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
})
	
	
$('.update_status').click(function(){ 	
	var id=$(this).attr('id');	
	if ($(this).is(":checked"))
		{
		  var value=1;
		}
			else
		{
			
			var value=0;
		}
	

	var url = "<?php echo base_url("Admin/change_status"); ?>"; 
	
    $.ajax({
        url: url,
		type:"POST",
		data:{id:id,value:value},
        dataType: 'json',		
        success: function(res) {
        
        }
    });
});	
	
	
	
	
	
	

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
	   $('select').select2();
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Money Euro
    $('[data-mask]').inputmask();
    //Date range picker
    $('#reservation').daterangepicker({
      timePicker: false,
		autoUpdateInput: false,
      timePickerIncrement: 30,
      locale: {
		   cancelLabel: 'Clear',
		 separator:" , ",
        format: 'YYYY-MM-DD'
      }
    });
	  
	  
	    $('.reservation').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' , ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('.reservation').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
	  
	  
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MM-DD hh:mm A'
      }
    })
    //Date range as a button
/*    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('.date_range').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		   $('#input-range').val(start.format('YYYY-MM-DD') + ' , ' + end.format('YYYY-MM-DD'))
      }
    )*/

    //Timepicker
   /* $('#timepicker').datetimepicker({
      format: 'LT'
    })*/
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
	
	
function demoFromHTML() {
	
    var pdf = new jsPDF('l', 'pt', 'A4');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#content')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 10,
        bottom: 10,
        left: 40,
        width: 850
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('subscriptions.pdf');
    }, margins);
}
</script>



