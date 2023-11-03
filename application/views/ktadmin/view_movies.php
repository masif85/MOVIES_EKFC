
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
              <table id="example2" class="table table-bordered table-hover table responsive">
                <thead>
                <tr>
					
					<?php 
					if($rows):
						foreach($rows as $object) {
							foreach ($object as $key => $value) {			
								echo "<th data-toggle='true' class='all'>$key</th>";
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
      <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title">Result Detail</h1> 
    

&nbsp;&nbsp;
				<a class="btn btn-app" href="#" onClick="demoFromHTML();">
                  <i class="fas fa-file-pdf"></i> Pdf
                </a>
				<div id="editor"></div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="content">             
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
            // update modal content here
            // you may want to format data or 
            // update other modal elements here too
            $('.modal-body').html(data);
	
            // show modal
            $('#modal-xl').modal('show');
        }
    });
});
	
	
$('.update_status').click(function(){ 	
	var type="normal";
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
	type=$(this).attr('but_type');
    $.ajax({
        url: url,
		type:"POST",
		data:{id:id,value:value,type:type},
        dataType: 'json',		
        success: function(res) {
        location.reload();
        }
    });
});	
	
	
	
	
	
	

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
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
        pdf.save('editions.pdf');
    }, margins);
}
</script>



