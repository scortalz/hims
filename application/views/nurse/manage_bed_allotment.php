<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_bed_allotment');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('bed_allotment_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_bed_allotment');?>
                    	</a></li>
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
                    <?php echo form_open('nurse/manage_bed_allotment/edit/do_update/'.$row['bed_allotment_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bed_number');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="bed_id" id="bed_id">
										<?php 
										$this->db->order_by('type' , 'asc');
										$beds	=	$this->db->get('bed')->result_array();
										foreach($beds as $row2):
										?>
                                        	<option value="<?php echo $row2['bed_id'];?>" <?php if($row2['bed_id'] == $row['bed_id'])echo 'selected';?>>
												<?php echo $row2['bed_number'].' - '.$row2['type'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="patient_id" id="patient_id">
										<?php 
										$this->db->order_by('account_opening_timestamp' , 'asc');
										$patients	=	$this->db->get('patient')->result_array();
										foreach($patients as $row2):
										?>
                                        	<option value="<?php echo $row2['patient_id'];?>" <?php if($row2['patient_id'] == $row['patient_id'])echo 'selected';?>>
												<?php echo $row2['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('allotment_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="allotment_timestamp" value="<?php echo date('m/d/Y', $row['allotment_timestamp']);?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discharge_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="discharge_timestamp" value="<?php echo date('m/d/Y', $row['discharge_timestamp']);?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_bed_allotment');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
                        
                 <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
			    <?php	$rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
                     <tr>
                     <td colspan="7" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
						<tr>
                        <td align="center"  colspan="6">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="6">
                      <h1>Bed Allotment</h1></td>
                        </tr>
						<tr><td align="right" colspan="6">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Serial No.</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Bed Number</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Bed Type</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Patient Name</div></th>
                      <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Allotment Date Time</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discharge Date Time</div></th>
                    		
						</tr>
					</thead>
                    <tbody>';
					
					?>
                
                 <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="7" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
                    		<th><div><?php echo get_phrase('bed number');?></div></th>
							<th><div><?php echo get_phrase('bed type');?></div></th>
                            <th><div><?php echo get_phrase('patient name');?></div></th>
                            <th><div><?php echo get_phrase('allotment date time');?></div></th>
                            <th><div><?php echo get_phrase('discharge date time');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    
							<?php $count = 1;foreach($bed_allotment as $row):
						
               			  $rep_html .='  <tr>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->			get_type_name_by_id('bed',$row['bed_id'],'bed_number').'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type').'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name').'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y', $row['allotment_timestamp']).'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y', $row['discharge_timestamp']).'</td>
							
                        </tr>';
						
                        endforeach;
                        ?>
                        
                      <?php  $count = 1;foreach($bed_allotment as $row): ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'bed_number'); ?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type');?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name');?></td>
                            <td><?php echo date('m/d/Y', $row['allotment_timestamp']); ?></td>
                            <td><?php echo date('m/d/Y', $row['discharge_timestamp']); ?></td>
							<td align="center">
                            <a href="<?php echo base_url();?>index.php?nurse/manage_bed_allotment/edit/<?php echo $row['bed_allotment_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?nurse/manage_bed_allotment/delete/<?php echo $row['bed_allotment_id'];?>" onclick="return confirm('delete?')"
                                rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                <i class="icon-trash"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
						
					<?php 	$rep_html .= '</tbody></table></div>';
				   		//echo $rep_html;
						
						$dompdf = new DOMPDF();
						$dompdf->load_html($rep_html);

					    $dompdf->render();

					    // The next call will store the entire PDF as a string in $pdf
						$pdf = $dompdf->output();

						// write $pdf to disk, store it in a database or stream it
						// to the client.<a href="../../../uploads/pdfreports/approveddiscount.pdf">
						
						file_put_contents("reports/bedallotment.pdf", $pdf);
				   ?>
                   </div>
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('nurse/manage_bed_allotment/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bed_number');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="bed_id">
										<?php 
										$this->db->order_by('type' , 'asc');
										$beds	=	$this->db->get('bed')->result_array();
										foreach($beds as $row):
										?>
                                        	<option value="<?php echo $row['bed_id'];?>"><?php echo $row['bed_number'].' - '.$row['type'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="patient_id">
										<?php 
										$this->db->order_by('account_opening_timestamp' , 'asc');
										$patients	=	$this->db->get('patient')->result_array();
										foreach($patients as $row):
										?>
                                        	<option value="<?php echo $row['patient_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('allotment_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="allotment_timestamp"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discharge_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="discharge_timestamp"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_bed_allotment');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

 <script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/bedallotment.pdf";
		  window.location = v;
 });
    });
	
	</script>