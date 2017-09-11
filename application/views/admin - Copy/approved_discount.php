<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>	
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_approved_discount');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('approved_discount_list');?>
                    	</a></li>
			<?php /*?><li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_approved_discount');?>
                    	</a></li><?php */?>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_profile as $row):?>
                    <?php echo form_open('admin/approved_discount/edit/do_update/'.$row['id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('invoice no');?></label>
                                <div class="controls">
                                <input type="text" name="invoice_no" id="invoice_no" value="<?php echo $row['invoice_no']; ?>"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount (%)');?></label>
                                <div class="controls">
                                <input type="text" name="discount_per" id="discount_per" value="<?php echo $row['discount_per']; ?>"  />
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount amount');?></label>
                                <div class="controls">
                                 <input type="text" name="discount_amount" id="discount_amount" value="<?php echo $row['discount_amount']; ?>" maxlength="5"  />
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('created by');?></label>
                                <div class="controls">
                                 <input type="text" name="created_by" id="created_by"  class="validate[required]" value="<?php echo $row['created_by']; ?>"/>
								<input type="checkbox" name="myself" id="myself" /><span style="vertical-align:middle">&nbsp;Myself</span>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_approved_discount');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
                  
                    <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
			  <?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
                   
						<tr>
                        <td align="center"  colspan="5">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="5">
                      <h1>Approved Discount</h1></td>
                        </tr>
						<tr><td align="right" colspan="5">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Invoice No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discount(%)</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discount Amount</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Created By</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="6" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('invoice no');?></div></th>
                            <th><div><?php echo get_phrase('discount');?></div></th>
                            <th><div><?php echo get_phrase('discount amount');?></div></th>
                             <th><div><?php echo get_phrase('created by');?></div></th>
                              <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php //print_r($invoices);
						$count = 1;
						foreach($invoices as $row):
                 	  $rep_html .='   <tr>
                    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['invoice_no'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['discount_per'].' </td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['discount_amount'].'</td>
				  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['created_by'].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php  $count = 1;foreach($invoices as $row):?>
                        <tr>
                           <td><?php echo  $count++;?></td>
                            <td><?php echo $row['invoice_number']; ?></td>
                           <td><?php echo  $row['discount'];?></td>
                           <td><?php echo  $row['discountamount'];?></td>
                           <td><?php echo $row['createdby'];?></td>
							<td align="center">
                            <a href="javascript:" onclick="approved(<?php echo $row['invoice_id'] ?>)"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('approved');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
          			  <?php 
					
                  		$rep_html .= '</tbody></table></div>';
				   		//echo $rep_html;
						
						$dompdf = new DOMPDF();
						$dompdf->load_html($rep_html);

					    $dompdf->render();

					    // The next call will store the entire PDF as a string in $pdf
						$pdf = $dompdf->output();

						// write $pdf to disk, store it in a database or stream it
						// to the client.
				
						file_put_contents("reports/approveddiscount.pdf", $pdf);
						
				   ?>
             </div> 
                   
            <!----TABLE LISTING ENDS--->


<script >

		$("#myself").click(function() {
		if($('#myself').is(":checked"))
		{
			var myself = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
			$('#created_by').val(myself);
		}
		else
		{
			$('input[name=myself]').attr('checked', false);
			$("#created_by").val('');
		}
	});

</script>


<script type='text/javascript' src='jquery.min.js'></script>
<!-- JavaScript Patient Validation Code Start -->
	<script language="javascript">
	$(document).ready(function () {
		$("#discount_amount").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[0-9-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	
		
		$("#created_by").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	
});

	</script>
	
	<script>
		$("#discount_per").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  		//alert(event.which);
 	 if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
  	 event.preventDefault();
  		}
		
		var discount_per = $('#discount_per').val();
		if (discount_per > 100 )
		{
			alert('discount must be not be greater than 100%');
			
		}
     });

</script>
	
<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/approveddiscount.pdf";
		  window.location = v;
 });
    });

	</script>
	
	<script>
function approved(idd)
	{
		
		//alert(idd);

		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/getapproveddiscount.php",
			data: ({inv_idd: idd}),
			success: function(response)	
			{
				//alert(response);
				window.location=window.location;
				//$("#invoicereceivedamount").val(response);
	
			}
		});	
		
 	}
</script>