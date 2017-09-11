 <?php // include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
 <div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_complain');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('complain_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_complain');?>
                    	</a></li>
                        <li>
            	<a href="#search" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('search_complain');?>
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
                    <?php echo form_open('reception/manage_complain/edit/do_update/'.$row['id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('floor name');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="floor_id" id="floor_id">
										<?php 
										$floors	=	$this->db->get('floor')->result_array();
										foreach($floors as $row2):
										?>
                                        	<option value="<?php echo $row2['floor_id'];?>" <?php if($row2['floor_id'] == $row['floor_id'])echo 'selected';?>>
												<?php echo $row2['floor_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('area');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="area_id" id="area_id">
										<?php 
										$areas	=	$this->db->get('area')->result_array();
										foreach($areas as $row2):
										?>
                                        	<option value="<?php echo $row2['area_id'];?>" <?php if($row2['area_id'] == $row['area_id'])echo 'selected';?>>
												<?php echo $row2['area'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('room name');?></label>
                                <div class="controls">
                                     <select class="chzn-select" name="room_id">
										<?php 
										$rooms	=	$this->db->get('room')->result_array();
										foreach($rooms as $row2):
										?>
                                        	<option value="<?php echo $row2['room_id'];?>" <?php if($row2['room_id'] == $row['room_id'])echo 'selected';?>>
												<?php echo $row2['room_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                        
						<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('complain type');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="comp_type_id" id="comp_type_id">
										<?php 
										$complain_types	=	$this->db->get('complain_type')->result_array();
										foreach($complain_types as $row2):
										?>
                                        	<option value="<?php echo $row2['comp_type_id'];?>" <?php if($row2['comp_type_id'] == $row['comp_type_id'])echo 'selected';?>>
												<?php echo $row2['complain_title'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('complain by');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="from_person" id="from_person" value="<?php echo $row['from_person'] ?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('complain_desc');?></label>
                                <div class="controls">
                                    <textarea name="complain_desc" > <?php echo $row['complain_desc'] ?> </textarea>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                    <select name="status" class="uniform">
                                       	<option value="resolved" <?php if($row['status']=='resolved')echo 'selected';?>><?php echo get_phrase('resolved');?></option>
                                       	<option value="unresolved" <?php if($row['status']=='unresolved')echo 'selected';?>><?php echo get_phrase('unresolved');?></option>
									</select>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_complain');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----SEARCH FORM STARTS--->
            	<div class="tab-pane box" id="search" style="padding: 5px">
                <div class="box-content">
            <?php echo form_open('reception/manage_complain/search/' , array('class' => 'form-horizontal validatable'));?>
                    Advanced Search
				<select name="searchfloor" id="searchfloor" class="uniform" style="width:100%;">
                <option value="-1">Select Floor</option>
                        	<?php 
						$floors = $this->db->get('floor')->result_array();
					foreach($floors as $row):
					?>
                    <option value="<?php echo $row['floor_id'];?>"><?php echo $row['floor_name'];?></option>
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
        <input type="submit" name="" id="" value="Search" />
        <?php echo form_close();?> 
        </div>
</div>
   <!----SEARCH FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            
             <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
				<?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
                  
						<tr>
                        <td align="center"  colspan="8">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="8">
                      <h1>Manage Complain</h1></td>
                        </tr>
						<tr><td align="right" colspan="8">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Floor</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Area</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Room</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Complain By</div></th>
                        <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Type</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Status</div></th>
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
							<th><div><?php echo get_phrase('floor');?></div></th>
                            <th><div><?php echo get_phrase('area');?></div></th>
                            <th><div><?php echo get_phrase('room');?></div></th>
                            <th><div><?php echo get_phrase('complain by');?></div></th>
                            <th><div><?php echo get_phrase('type');?></div></th>
                             <th><div><?php echo get_phrase('date');?></div></th>
                             <th><div><?php echo get_phrase('status');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($complains as $rows):
                 	  $rep_html .='   <tr>
                      <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
                      <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('floor',$rows['floor_id'],'floor_name').'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('area',$rows['area_id'],'area').'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('room',$rows['room_id'],'room_name').'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['from_person'].'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id_custom('complain_type',$rows['comp_type_id'],'complain_title').'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. date('m/d/Y' , strtotime($rows['complain_date'])).'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['status'].'</td>
				
                 </tr>';
						        endforeach;
                        ?>
                        
                     <?php  $count = 1;foreach($complains as $rows):?>
                        <tr>
                           <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('floor',$rows['floor_id'],'floor_name'); ?></td>
                           <td><?php echo  $this->crud_model->get_type_name_by_id('area',$rows['area_id'],'area');?></td>
                           <td><?php echo $this->crud_model->get_type_name_by_id('room',$rows['room_id'],'room_name');?></td>
                           <td><?php echo $rows['from_person'];?></td>
                        <td><?php echo $this->crud_model->get_type_name_by_id_custom('complain_type',$rows['comp_type_id'],'complain_title');?></td>
                           <td><?php echo date('m/d/Y' , strtotime($rows['complain_date']));?></td>
                           <td><?php echo $rows['status'];?></td>
							
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
				
						file_put_contents("reports/managecomplain.pdf", $pdf);
						*/
				   ?>
             </div> 
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_complain/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('floor name');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="floor_id">
										<?php 
										$floors	=	$this->db->get('floor')->result_array();
										foreach($floors as $row):
										?>
                                        	<option value="<?php echo $row['floor_id'];?>"><?php echo $row['floor_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('area');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="area_id">
										<?php 
										$areas	=	$this->db->get('area')->result_array();
										foreach($areas as $row):
										?>
                                        	<option value="<?php echo $row['area_id'];?>"><?php echo $row['area'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('room');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="room_id">
										<?php 
										
										$rooms	=	$this->db->get('room')->result_array();
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
                                <label class="control-label"><?php echo get_phrase('complain by');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="from_person" id="from_person" placeholder="enter person name"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('type');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="comp_type_id">
										<?php 
										
										$complain_types	=	$this->db->get('complain_type')->result_array();
										foreach($complain_types as $row):
										?>
                                        	<option value="<?php echo $row['comp_type_id'];?>"><?php echo $row['complain_title'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                   <textarea name="complain_desc"></textarea>
                                </div>
                            </div>
                           <?php /*?> <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="complain_date"/>
                                </div>
                            </div><?php */?>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                    <select class="uniform" name="status">
                                      <option value="resolved"><?php echo get_phrase('resolved');?></option>
									  <option value="unresolved"><?php echo get_phrase('unresolved');?></option>
									</select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_complain');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

<script type='text/javascript' src='jquery.min.js'></script>
<!-- JavaScript Patient Validation Code Start -->
	<script language="javascript">
	$(document).ready(function () {
		$("#from_person").bind("keypress", function (event) {
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
 /*
	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = window.open("reports/managecomplain.pdf");
		  //window.location = v;
 });
    });
	*/
</script>