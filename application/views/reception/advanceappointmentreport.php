<!-- <div class="box">
	<div class="box-header">
    
    	<------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('advance_appointment_report_list');?>
                    	</a></li>
			
		</ul>
    	<-----CONTROL TABS END------->
        
	</div>
    
    <br />
            
             <label class="control-label" >&nbsp;Doctor
                             <select name="doctor_id" id="doctor_id" class="chzn-select" >
                           
                                    <option value="-1">-------------All Doctor----------</option>
                                    	<?php 
										$doctors = $this->db->get('doctor')->result_array();
										foreach($doctors as $row):
										?>
                                        
                                    	<option value="<?php echo $row['doctor_id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
								<span style="margin-left:5px;">	<?php echo get_phrase('Date');?>
                                <input type="text" class="datepicker fill-up" name="appdate" id="appdate" />
                                </span>
								
                                    </label>
                                    
                                    <input type="button" class="btn btn-green" name="btnGenerateReport" id="btnGenerateReport" value="Generate Report" />
									
                                    <div id="data"></div>
                                    
                                    
                                    
                            
                            </div>
                        </div>

	<script>
	
	$(document).ready(function(e) {
		// When-Changed-Service-Type
		$("#btnGenerateReport").click(function()
		{
			
				var doctorid = jQuery("#doctor_id").val();
				var selected_date = $('#appdate').val();
				
				//alert(selected_date);
				
				//alert('<?php echo base_url();?>');
				//return false;
				jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/postadvappointmentreport.php",
				data: ({post_doctorid: doctorid, post_selected_date:selected_date}),
					success: function(response)	
					{
						//alert(response);
							jQuery("#data").html(response);
					}
				});	
			});
		
	});	
	
	</script>



	

 
 