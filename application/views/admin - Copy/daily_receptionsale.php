<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_daily_receptionsale');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('daily_receptionsale_list');?>
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
            
            <label class="control-label" >&nbsp;Reception
                             <select name="reception_id" id="reception_id" class="chzn-select" >
                                    	<?php 
										$receptioninvoice = $this->db->get('reception')->result_array();
										foreach($receptioninvoice as $row):
										?>
                                    	<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
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
		
			var ownperson = jQuery("select[name='reception_id']").val();
			var selected_date = $('#creation_time').val();
			alert(ownperson);
			
			//alert('<?php echo base_url();?>');
			//return false;
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/dailyreceptionsale.php",
			data: ({post_ownperson: ownperson, post_selected_date:selected_date}),
				success: function(response)	
				{
					//alert(response);
						jQuery("#data").html(response);
				}
			});	
		});
	
});	
	</script>



	

