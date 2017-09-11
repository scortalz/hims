<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_daily_doctorsale');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('daily_doctorsale_list');?>
                    	</a></li>
			<?php /*?><li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_approved_discount');?>
                    	</a></li><?php */?>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<!--<div class="box-content padded">
		<div class="tab-content">-->     
        
           	<!----EDITING FORM STARTS---->
        	
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING START--->
            <br />
            
            <label class="control-label" >&nbsp;Doctor
                             <select name="doctor_id" id="doctor_id" class="chzn-select" >
                                    	<?php 
										$doctors = $this->db->get('doctor')->result_array();
										foreach($doctors as $row):
										
										
										?>
                                    	<option value="<?php echo $row['doctor_id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
								<span style="margin-left:5px;">	<?php echo get_phrase('date');?>
                                <input type="text" class="datepicker fill-up" name="creation_time" id="creation_time" />
                                </span>
                                    </label>
                                    
                                    <input type="button" class="btn btn-green" name="btnGenerateReport" id="btnGenerateReport" value="Generate Report" />
									
                                    <div id="data"></div>
                                    
                                    <!----TABLE LISTING ENDS--->
                                    
                                    
                                    <!----CREATION FORM STARTS---->
                                    
                                    <!----CREATION FORM ENDS--->
                                    
                            <!--	
                            </div>
                        </div>-->

<script>
$(document).ready(function(e) {
    // When-Changed-Service-Type
	$("#btnGenerateReport").click(function()
	{
		
			var doctor_id = jQuery("select[name='doctor_id']").val();
			var selected_date = $('#creation_time').val();
			//alert(doctor_id);
			
			//alert('<?php echo base_url();?>');
			//return false;
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/getdoctor.php",
			data: ({post_doctor_id: doctor_id, post_selected_date:selected_date}),
				success: function(response)	
				{
					//alert(response);
						jQuery("#data").html(response);
				}
			});	
		});
	
});	
	</script>



	
