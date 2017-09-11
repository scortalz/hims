<?php // include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>  	
<div class="box">
<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_oT');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('oT_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_oT');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
          <?php	if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php 
					foreach($edit_profile as $row):?>
                    <?php echo form_open('reception/manage_ot/edit/do_update/'.$row['ot_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                         <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('OT');?></label>
                                <div class="controls">
                   				<select name="ot1_id" class="uniform">
                			  <option value="1" <?php if($row['ot1_id']=='1')echo 'selected';?> > <?php echo get_phrase('OT 1');?> </option>
                		  <option value="2" <?php if($row['ot1_id']=='2')echo 'selected';?> > <?php echo get_phrase('OT 2');?></option>
                          	  <option value="3" <?php if($row['ot1_id']=='3')echo 'selected';?> > <?php echo get_phrase('OT 3');?></option>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant_name');?></label>
                                <div class="controls">
                                    <select id="doctor_id" onclick="getdoctor()" class="uniform" style="width:100%;">
                                    	<?php 
										$doctors = $this->db->get('doctor')->result_array();
										foreach($doctors as $row2):
										?>
                                   <option value="<?php echo $row2['doctor_id'];?>"
                                            	<?php if($row['doctor_id'] == $row2['doctor_id'])echo 'selected';?>>
													<?php echo $row2['name'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                        
						<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('anesthetic_name');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="anesthesia_name" value="<?php echo $row['anesthesia_name']; ?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('timings');?></label>
                                <div class="controls">
                                   <?php /*?><?php include "days_timings.php"; ?><?php */?>
								       <select name="1_open_time" class="uniform" style="width:100%;">
                                    	<?php 
										$ots = $this->db->get('ot')->result_array();
										foreach($ots as $row2):
										?>
                                   <option value="<?php echo $row2['1_open_time'];?>"
                                            	<?php if($row['1_open_time'] == $row2['1_open_time'])echo 'selected';?>>
													<?php echo $row2['1_open_time'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
									  <select name="1_close_time" class="uniform" style="width:100%;">
                                    	<?php 
										$ots = $this->db->get('ot')->result_array();
										foreach($ots as $row2):
										?>
                                   <option value="<?php echo $row2['1_close_time'];?>"
                                            	<?php if($row['1_close_time'] == $row2['1_close_time'])echo 'selected';?>>
													<?php echo $row2['1_close_time'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('hours');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="hours" id="hours" value="<?php echo $row['hours'] ?>" id="hours"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('case date');?></label>
                                <div class="controls">
                             <input type="text" class="datepicker fill-up" name="case_date" id="case_date" value="<?php echo $row['case_date'] ?>"/>
                                </div>
                            </div>
						<!--	<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('no of case');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="no_cases" id="no_cases" value="<?php echo $row['no_cases'] ?>"/>
                                </div>
                            </div>-->
							  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('surgery types');?></label>
                                <div class="controls">
                                  <select name="surgery_id" id="surgery_id" class="uniform" style="width:100%;">
                                    	<?php 
										$departments = $this->db->get('surgery_type')->result_array();
										foreach($departments as $row2):
										?>
                                    		<option value="<?php echo $row2['surgery_id'];?>"
                                            	<?php if($row['surgery_id'] == $row2['surgery_id'])echo 'selected';?>>
													<?php echo $row2['desc'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>    
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('category name');?></label>
                                <div class="controls">
                              	<select class="chzn-select" name="category_id" id="category_id" />
										<?php 
										$this->db->order_by('category_name' , 'asc');
										$categorys	=	$this->db->get('category')->result_array();
										foreach($categorys as $row2):
										if ($cat_name != $row2['category_name'])
											{
										?>
                                        <option value="<?php echo $row2['category_id'];?>"
										<?php if($row['category_id'] == $row2['category_id'])echo 'selected';?>>
										<?php echo $row2['category_name'];?>
										</option>
                                        <?php
											$cat_name = $row2['category_name'];
											}
										endforeach;
										?>
									</select> 
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sub category');?></label>
                                <div class="controls">
                                <select class="chzn-select" name="type_id" id="type_id" />
                                    	<?php 
										$surgerys = $this->db->get('surgery')->result_array();
										foreach($surgerys as $row2):
										?>
                                    		<option value="<?php echo $row2['type_id'];?>"
                                            	<?php if($row['type_id'] == $row2['type_id'])echo 'selected';?>>
													<?php echo $row2['type'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('booking date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="booking_date" value="<?php echo $row['booking_date'] ?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                    <textarea name="description" value="<?php echo $row['description'] ?>"/><?php echo $row['description'] ?></textarea>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('booking by');?></label>
                                <div class="controls">
                                    <select name="booked_id" class="chzn-select" >
                                    	<?php 
										$bookings = $this->db->get('booked')->result_array();
										foreach($bookings as $row2):
										?>
                                   <option value="<?php echo $row2['booked_id'];?>"
                                            	<?php if($row['booked_id'] == $row2['booked_id'])echo 'selected';?>>
													<?php echo $row2['booked_name'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_ot');?></button>
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
                   
				<?php $rep_html ='  <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" >
                	<thead>
                   
						<tr>
                        <td align="center"  colspan="8">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="8">
                      <h1>Manage OT</h1></td>
                        </tr>
						<tr><td align="right" colspan="8">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>OT Name</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Consultant Name</div></th>
					 <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Start Time</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>End Time</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Hours</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Anesthestic Name</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Case Date</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <!--<tr>
                        <td colspan="9" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
						-->
                		<tr>
                    		<th><div>Serial No.</div></th>
                            <th><div><?php echo get_phrase('ot name');?></div></th>
							<th><div><?php echo get_phrase('consultant name');?></div></th>
                            <th><div><?php echo get_phrase('start time');?></div></th>
                            <th><div><?php echo get_phrase('end time');?></div></th>
                             <th><div><?php echo get_phrase('hours');?></div></th>
                             <th><div><?php echo get_phrase('anesthetic name');?></div></th>
                             <th><div><?php echo get_phrase('case date');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    
                    	<?php $count = 1;foreach($ot1 as $rows):
                 	  $rep_html .='  <tr>
                    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">OT '.$rows['ot1_id'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('doctor',$rows['doctor_id'],'name').'</td>
				  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['1_open_time'].'</td>
				  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['1_close_time'].'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['hours'].'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $rows['anesthesia_name'].'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m / d / Y', strtotime($rows['case_date'])).'</td>
                  </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($ot1 as $rows):?>
                        <tr>
                        <td><?php echo $count++; ?></td>
                        <td>OT <?php echo $rows['ot1_id'];?></td>
					<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$rows['doctor_id'],'name');?></td>
						<td><?php echo $rows['1_open_time'];?></td>
					   <td><?php echo $rows['1_close_time'];?></td>
                       <td><?php echo $rows['hours'];?></td>
					   <td><?php echo $rows['anesthesia_name'];?></td>
                       <td><?php echo date('m / d / Y', strtotime($rows['case_date']));?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
            <?php 
					/*
                  		$rep_html .= '</tbody></table></div>';
				   		//echo $rep_html;
						
						$dompdf = new DOMPDF();
						$dompdf->load_html($rep_html);

					    $dompdf->render();

					    // The next call will store the entire PDF as a string in $pdf
						$pdf = $dompdf->output();

						// write $pdf to disk, store it in a database or stream it
						// to the client.
				
						file_put_contents("reports/ot.pdf", $pdf);
						*/
				   ?>
             </div> 
                   
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_ot/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                          <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('OT');?></label>
                                <div class="controls">
                    <select name="ot1_id" id="ot1_id" class="uniform" style="width:100%;" onclick="getot()"> 
                                  
                                   <option value="1">OT 1</option>
								   <option value="2">OT 2</option>
                                   <option value="3">OT 3</option>
                                    </select>
                                </div>
                            </div>
                              <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <select name="patient_id" id="patient_id" class="uniform" style="width:100%;">
                                    	<?php 
										$patients = $this->db->get('patient')->result_array();
										foreach($patients as $row2):
										?>
                                   <option value="<?php echo $row2['patient_id'];?>"
                                            	<?php if($row['patient_id'] == $row2['patient_id'])echo 'selected';?>>
													<?php echo $row2['name'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant_name');?></label>
                                <div class="controls">
								<select class="chzn-select" name="doctor_id" id="doctor_id" onclick="getdoctor()">
                                <option>-------Select Doctor---------</option>
										<?php 
										$doctors =	$this->db->get('doctor')->result_array();
										foreach($doctors as $row):
										?>
                                        	<option value=" <?php echo $row['doctor_id'];?> "><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('anesthetic name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="anesthesia_name" id="anesthesia_name"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('timings');?></label>
                                <div class="controls" id="ottimings">
                                   <?php /*?><?php include "ot_timings.php"; ?><?php */?>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('hours');?></label>
                                <div class="controls">
                                    <input type="text" name="hours" id="hours" readonly=" " />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('case date');?></label>
                                <div class="controls">
                             <input type="text" class="datepicker fill-up" name="case_date" id="case_date"/>
                                </div>
                            </div>
						<!--	<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('no. of cases');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="no_cases" id="no_cases" maxlength="3"/>
                                </div>
                            </div>-->
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('surgery types');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="surgery_id" id="surgery_id">
                                    <option>---------Select Surgery--------</option>
									<?php 
										$surgery_types	=	$this->db->get('surgery_type')->result_array();
										foreach($surgery_types as $row):
										?>
										<option value="<?php echo $row['surgery_id'];?>"><?php echo $row['desc'];?></option>
										<?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('category name');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="category_id" id="category_id">
                                    <option>---------Select Category--------</option>
									<?php 
										$this->db->order_by('category_name' , 'asc');
										$categorys	=	$this->db->get('category')->result_array();
										foreach($categorys as $row):
										   // $cat_name =  $row['category_name'];
											if ($cat_name != $row['category_name'])
											{
										?>
									<option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
										<?php
										
											$cat_name = $row['category_name'];
											}
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sub category ');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="type_id" id="type_id">
                                    <option>----------Select Sub Category------</option>
									<?php 
										$surgerys	=	$this->db->get('surgery')->result_array();
										foreach($surgerys as $row):
										
										?>
								<option value="<?php echo $row['type_id'];?>"><?php echo $row['type'];?></option>
										<?php
										
										endforeach;
										?>
									</select>	        
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('booking/datetime');?></label>
                                <div class="controls">
                            <input type="text" class="datepicker fill-up" name="booking_date" id="booking_date"/>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                   <textarea name="description"></textarea>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('booked_by');?></label>
                                <div class="controls">
                                     <select class="chzn-select " name="booked_id">
										<?php 
										$booked_persons	=	$this->db->get('booked')->result_array();
										foreach($booked_persons as $row):
										?>
                                        	<option value="<?php echo $row['booked_id'];?>"><?php echo $row['booked_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_oT');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

<script>
$(document).ready(function () {
	
	jQuery("select[name='1_open_time']").change (function()
	{ 
		calculateTime();
	
	});

	jQuery("select[name='1_close_time']").change (function()
	{ 
		calculateTime();
	
	});
	/*function calculateTime() {
		var valuestart = $("select[name='1_open_time']").val();
		var valuestop = $("select[name='1_close_time']").val();
	
		 //create date format          
		 var timeStart = new Date("01/01/2007 " + valuestart);
		 var timeEnd = new Date("01/01/2007 " + valuestop);
	
		 var difference = timeEnd - timeStart;             
	
		 difference = difference / 60 / 60 / 1000;
		 if (difference < 1 )
		 {
			alert('Invalid time selected...');
		 }
		 $('#hours').val(difference);             
	}*/
	

});
</script>

<script type='text/javascript' src='jquery.min.js'></script>
<!-- JavaScript Patient Validation Code Start -->
	<script language="javascript">
	$(document).ready(function () {
		$("#anesthesia_name").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	
		
	$("#no_cases").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[0-9-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	}); 
	
});
	function calculateTime() {
	//	alert('calculateTime');
		//return;
		var valuestart = $("select[name='1_open_time']").val();
		var valuestop = $("select[name='1_close_time']").val();
	
		 //create date format          
		 var timeStart = new Date("01/01/2007 " + valuestart);
		 var timeEnd = new Date("01/01/2007 " + valuestop);
	
		 var difference = timeEnd - timeStart;             
	
		 difference = difference / 60 / 60 / 1000;
		 
		 if (valuestop.length > 0 )
		 {
		 	if (difference < 0 )
		 	{
				alert('Invalid time selected...');
		 	}
			else
			{
				$('#hours').val(difference); 	
			}
		 }
		             
	}
	</script>
	
<script>
/*
	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/ot.pdf";
		  window.location = v;
 });
  */  

		$('#category_id').change (function () {
						
   
	  //  alert('asdasd'); return ;
		jQuery("#type_id").val('');    //sub category name display.
					//var sur= $("#surgery_id").val();
					//alert(sur);
		//var subcategory = $('#selected_subcategory').val();
							
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/subcategory.php",
		data: ({post_subcategory: this.value}),
		success: function(response)	
		{
		//  alert(response);
		  jQuery("#sub_cate").html(response);
								
	//	jQuery("#serviceprice").focus();
		}
	});	
});

});
	
</script>   
	
<script>
	
	function getot()
	{

	
		var bookedot = $("#ot1_id").val();
		//alert(bookedot);
		jQuery("#hours").val('');
		jQuery("#case_date").val('');
		jQuery("#booking_date").val('');
		jQuery("#anesthesia_name").val('');
					
			$.ajax
			({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/otbookedtime.php",
				//dataType: 'json',
				data: ({ot1_id: bookedot}),
				cache: false,
				success: function(data)
				{
				//	alert(data);	
					$("#ottimings").html(data);
					//$(".1_close_time").html(data.message2);
				}
			});		
 //	});
	}

</script>

<script type="text/javascript">
	$(document).ready(function () {
		var bookedot = $("#ot1_id").val();
		
		jQuery("#hours").val('');
		jQuery("#case_date").val('');
		jQuery("#booking_date").val('');
		jQuery("#anesthesia_name").val('');
					
			$.ajax
			({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/otbookedtime.php",
				//dataType: 'json',
				data: ({ot1_id: bookedot}),
				cache: false,
				success: function(data)
				{
				//	alert(data);	
					$("#ottimings").html(data);
					//$(".1_close_time").html(data.message2);
				}
			});	
	});

</script>
	
	
	
