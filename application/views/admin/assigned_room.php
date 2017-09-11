<?php // include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>  					
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_assigned_room');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('assigned_room_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_room_assigned');?>
                    	</a></li>
            <li>
            	<a href="#search" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('search_room_assigned');?>
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
                    <?php echo form_open('admin/assigned_room/edit/do_update/'.$row['assignedroom_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                        <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                                <div class="controls">
                                         <select name="doctor_id" id="doctor_id" class="uniform" style="width:100%;">
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
                                <label class="control-label"><?php echo get_phrase('room name');?></label>
                                <div class="controls">
                                   <select  name="room_id" id="room_id" class="uniform" style="width:100%;">
                                   
                                    	<?php 
										$rooms = $this->db->get('room')->result_array();
										foreach($rooms as $row2):
										?>
                                   <option value="<?php echo $row2['room_id'];?>"
                                            	<?php if($row['room_id'] == $row2['room_id'])echo 'selected';?>>
													<?php echo $row2['room_name'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('days');?></label>
                                <div class="controls">
                   <select name="days" class="uniform">
                  <option value="monday" <?php if($row['days']=='monday')echo 'selected';?> > <?php echo get_phrase('monday');?> </option>
                  <option value="tuesday" <?php if($row['days']=='tuesday')echo 'selected';?> > <?php echo get_phrase('tuesday');?></option>
				<option value="wednesday" <?php if($row['days']=='wednesday')echo 'selected';?>><?php echo get_phrase('wednesday');?></option>
                <option value="thursday" <?php if($row['days']=='thursday')echo 'selected';?>><?php echo get_phrase('thursday');?></option>
				 <option value="friday" <?php if($row['days']=='friday')echo 'selected';?>><?php echo get_phrase('friday');?></option>
				<option value="saturday" <?php if($row['days']=='saturday')echo 'selected';?>><?php echo get_phrase('saturday');?></option>
                <option value="sunday" <?php if($row['days']=='sunday')echo 'selected';?>><?php echo get_phrase('sunday');?></option>
					</select>
                                </div>
                            </div>
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_assigned_room');?></button>
                        </div>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----SEARCH FORM STARTS--->
            	<div class="tab-pane box" id="search" style="padding: 5px">
                <div class="box-content">
            <?php echo form_open('admin/assigned_room/search/' , array('class' => 'form-horizontal validatable'));?>
                    Advanced Search
				<select name="searchdoctor" id="searchdoctor" class="uniform" style="width:100%;">
                <option value="-1">Select Doctor</option>
                        	<?php 
						$doctors = $this->db->get('doctor')->result_array();
					foreach($doctors as $row):
					?>
                    <option value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'];?></option>
                   <?php
						endforeach;
					?>
                      </select>
<input type="text" id="searchdate" name="searchdate" class="datepicker fill-up" placeholder="Get Date" />
<select name="searchroom" id="searchroom" class="uniform" style="width:100%;">
                <option value="-1">Select Room</option>
                        	<?php 
						$rooms = $this->db->get('room')->result_array();
					foreach($rooms as $row):
					?>
                    <option value="<?php echo $row['room_id'];?>"><?php echo $row['room_name'];?></option>
                   <?php
						endforeach;
					?>
                      </select>
        <!--<input type="text" id="searchroom" name="searchroom"  placeholder="Enter Room" />-->
        <input type="submit" name="" id="" value="Search" />
        <!--
        <input type="button" style="float:right;display:inline" name="Report" id="Report" onclick="scheduleprint()" value="Print Report" class="btn btn-blue" title="Click here to print" />-->
        <?php echo form_close();?> 
        </div>
</div>
   <!----SEARCH FORM ENDS--->
   
            <!----TABLE LISTING STARTS--->
             
                     <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
					<?php $rep_html ='<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
                   
						<tr>
                        <td align="center"  colspan="7">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="7">
                      <h1>Manage Room</h1></td>
                        </tr>
						<tr><td align="right" colspan="7">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor Name</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Room Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Days</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Start Time</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>End Time</div></th>
                    	
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <!-- <tr>
                        <td colspan="8" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
					-->
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('doctor name');?></div></th>
                            <th><div><?php echo get_phrase('room name');?></div></th>
                            <th><div><?php echo get_phrase('days');?></div></th>
                            <th><div><?php echo get_phrase('date');?></div></th>
                            <th><div><?php echo get_phrase('start time');?></div></th>
                             <th><div><?php echo get_phrase('end time');?></div></th>
                              <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($assignedrooms as $rows):
                 	   $rep_html .='    <tr>
                   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
				   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$this->crud_model->get_type_name_by_id("doctor",$rows["doctor_id"],"name").'</td>
				   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$this->crud_model->get_type_name_by_id("room",$rows["room_id"],"room_name").'</td>
				   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$rows['days'].'</td>
				   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.date("m/d/Y", strtotime($rows["today_date"])).'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$rows['1_open_time'].'</td>
				   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.$rows['1_close_time'].'</td>
                         </tr>';
						        endforeach;
                        ?>
                        
                     <?php  $count = 1;foreach($assignedrooms as $rows):?>
                        <tr>
                           <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id("doctor",$rows["doctor_id"],"name"); ?></td>
                           <td><?php echo $this->crud_model->get_type_name_by_id("room",$rows["room_id"],"room_name"); ?></td>
                           <td><?php echo $rows['days'];?></td>
                           <td><?php echo date("m/d/Y", strtotime($rows["today_date"]));?></td>
                           <td><?php echo $rows['1_open_time'];?></td>
                           <td><?php echo $rows['1_close_time'];?></td>
							<td align="center">
                            <a href="<?php echo base_url();?>index.php?admin/assigned_room/edit/<?php echo $rows['assignedroom_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/assigned_room/delete/<?php echo $rows['assignedroom_id'];?>" onclick="return confirm('delete?')"
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
				
						file_put_contents("reports/assignedroom.pdf", $pdf);
						*/
				   ?>
             </div> 
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_room/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                                <div class="controls">
                                   <select name="doctor_id" id="doctor_id" class="uniform" style="width:100%;">
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
                                <label class="control-label"><?php echo get_phrase('room name');?></label>
                                <div class="controls">
                                    <select required="required" name="room_id" id="room_id" class="uniform" style="width:100%;">
                                    <option  value="-1">Select Room</option>
                                    	<?php 
										$rooms = $this->db->get('room')->result_array();
										foreach($rooms as $row):
										?>
                                    		<option value="<?php echo $row['room_id'];?>"><?php echo $row['room_name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
							   <label class="control-label"><?php echo get_phrase('days');?></label>
                                <div class="controls">
                                   <select class="uniform" name="days">
                                      <option value="monday"><?php echo get_phrase('monday');?></option>
									  <option value="tuesday"><?php echo get_phrase('tuesday');?></option>
									  <option value="wednesday"><?php echo get_phrase('wednesday');?></option>
									  <option value="thursday"><?php echo get_phrase('thursday');?></option>
									  <option value="friday"><?php echo get_phrase('friday');?></option>
									  <option value="saturday"><?php echo get_phrase('saturday');?></option>
									  <option value="sunday"><?php echo get_phrase('sunday');?></option>
									</select>
                                </div>
                            </div>
                              <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('timings');?></label>
                                <div class="controls" id="timings">
                                    <?php //include "days_timings.php"; ?>
                                </div>
                            </div>
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_room_assigned');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>


<script>
 /*
	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = window.open("reports/assignedroom.pdf");
		  //window.location = v;
 });
    });
	*/
</script>

<script>

	$("#room_id").change(function()
	{
		var bookedroom = $("#room_id").val();
	//	alert(bookedroom);
					
			$.ajax
			({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/bookedtimings.php",
				//dataType: 'json',
				data: ({room_id: bookedroom}),
				cache: false,
				success: function(data)
				{
				//	alert(data);	
					$("#timings").html(data);
					//$(".1_close_time").html(data.message2);
				}
			});		
 	});


</script>