<?php // include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 
<div class="box" />
	<div class="box-header" />
   <?php  error_reporting(0);
   include   realpath(".") . "/application/helpers/mydb.php";
	$db = NULL;
	$db = new DB();
	foreach($advappointments as $row):
	$doctorid=$row['doctor_id'];
	endforeach;
	$today = date('Y-m-d', time());
	$arrDay = $db->Generate_nextdaytoken_Number($today,$doctorid);
	$tokenno=$arrDay[0]['today_token_no'] ;						

    ?>
    
    	<!------CONTROL TABS START------->
        
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_advanceppointment');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('advanceppointment_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_advanceppointment');?>
                    	</a></li>
		</ul>
        
    	<!------CONTROL TABS END------->
        
	</div>
    
	<div class="box-content padded" />
	<div class="tab-content" />
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_profile)):?>
	<div class="tab-pane box active" id="edit" style="padding: 5px">
      <div class="box-content">
                	<?php foreach($edit_profile as $row):?>
                    <?php echo form_open('admin/advanceappointment/edit/do_update/'.$row['app_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <input type="text" name="patname" id="patname" value="<?php echo $row['patname'] ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                                <div class="controls">
                                         <select name="doctor_id" id="doctor_id" class="chzn-select">
										 <option value="-1"> ------- Select Doctor -------</option>
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
                                <label class="control-label"><?php echo get_phrase('appointment date');?></label>
                                <div class="controls">
                              <input type="text" class="datepicker fill-up" name="appdate" id="appdate" value="<?php echo $row['appdate'] ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" name="phone" id="phone" value="<?php echo $row['phone'] ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('area');?></label>
                                <div class="controls">
                                    <input type="text" name="area" id="area" value="<?php echo $row['area'] ?>"/>
                                </div>
                            </div>
                            </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                 <select name="status" id="status" class="chzn-select" >
                                 <option value="schedule" <?php if($row['status']=='schedule')echo 'selected';?>><?php echo get_phrase('schedule');?></option>
                                 <option value="cancel" <?php if($row['status']=='cancel')echo 'selected';?>><?php echo get_phrase('cancel');?></option>
									</select>
                                </div>
                            </div>
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_advanceppointment');?></button>
                        </div>
                    <?php echo form_close(); ?>
                    <?php endforeach;  ?>
                </div>
			</div>
            
            <?php endif;  ?>
            
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>"  id="list"/>
                   
                  <?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
				  
                	<thead>
						<tr>
                        <td align="center"  colspan="5">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="5">
                      <h1>Advance Appointment</h1></td>
                        </tr>
						<tr><td align="right" colspan="5">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
					   <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Token No.</div></th>
					   <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
					   <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor Name</div></th>
					   <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Appointment Date</div></th>	
					   <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Phone</div></th>
					    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Area</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Status</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                	<?php 
					
					$count = 1;foreach($advappointments as $row):
						//$appointdate=$row['appdate'];
                 		  $rep_html ='  <tr>
                    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['tokenno'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patname'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name').'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y ', strtotime($row['appdate'])).'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['phone'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['area'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['status'].'</td>
                        </tr>';
						
					   endforeach;
								
                    ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>				
                		<tr>
                    		<th><?php echo get_phrase('serial no');?></th>
                            <th><?php echo get_phrase('token no');?></div></th>
							<th><?php echo get_phrase('patient name');?></div></th>
                    		<th><?php echo get_phrase('doctor name');?></th>
                             <th><?php echo get_phrase('appointment date');?></th>
                             <th><?php echo get_phrase('phone');?></th>
                             <th><?php echo get_phrase('area');?></th>
                             <th><?php echo get_phrase('status');?></th>
                             <th><?php echo get_phrase('option');?></th>
						</tr>
					</thead>
                    <tbody>

                     <?php $count = 1;foreach($advappointments as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['tokenno'];?></td>
                            <td><?php echo $row['patname'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>
							<td><?php echo date('m/d/Y ', strtotime($row['appdate']));?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['area'];?></td></div>
                            <td><?php echo $row['status'];?></td></div>
                            <td align="center">
                            <a href="<?php echo base_url();?>index.php?admin/advanceappointment/edit/<?php echo $row['app_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/advanceappointment/delete/<?php echo $row['app_id'];?>" onclick="return confirm('delete?')"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                <i class="icon-trash"></i>
                                </a>
        					</td>
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
				
						file_put_contents("reports/advanceppointment.pdf", $pdf);
						*/
				   ?>
             </div> 
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
            
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/advanceappointment/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                  <input type="text"  name="patname" id="patname" class="validate[required]"/>
                                </div>
                            </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                                <div class="controls">
                                   <select name="doctor_id" id="doctor_id" class="chzn-select" >
									<option value="-1"> ------- Select Doctor -------</option>
                                    	<?php 
										$doctors = $this->db->get('doctor')->result_array();
										foreach($doctors as $row):
										?>
                                    		<option value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('appointment date');?></label>
                                <div class="controls">
                                  <input type="text" class="datepicker fill-up" name="appdate" id="appdate" />
                                </div>
                            </div>
                           	<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                  <input type="text"  name="phone" id="phone" class="validate[required]"/>
                                </div>
                            </div>
                            	<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('area');?></label>
                                <div class="controls">
                                  <input type="text"  name="area" id="area" class="validate[required]"/>
                                </div>
                            </div>
                        	<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('token no.');?></label>
                                <div class="controls"> 
							<input type="text"  name="tokenno" id="tokenno" class="validate[required]" value="<?php echo $tokenno;?>"/>
                                </div>
                            </div>
                               <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                   <select name="status" id="status" class="chzn-select">
									<option value="-1"> ------- Select Status -------</option>
                                    <option value="schedule">schedule</option>
                                    <option value="cancel">cancel</option>  
                                    </select>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_advanceppointment');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
            <div id="docid"> </div>
            
		</div>
        
	</div>
    
</div>


	<script>

	$(document).ready(function(e) 
	{
       $('#btnReport').click(function () 
		{

		var v = "reports/advanceppointment.pdf";
		window.location = v;
		  
  		});
 
    });
	
	$("#doctor_id").change(function()
	 {

		var doctorid = jQuery("select[name='doctor_id']").val();
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getdoctortoken.php",
		data: ({post_doctor_id: doctorid}),
		success: function(response)	
		 {
			jQuery("#tokenno").val(response);
		 }
			
		});
			
 	    });

       	var st = $('#status').val();
		if (st == "-1")
		{
			alert("Please select a status");	
			return false;
			
		}
	
	</script>
