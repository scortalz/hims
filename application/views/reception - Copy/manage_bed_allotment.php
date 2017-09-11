<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";

 include   realpath(".") . "/application/helpers/mydb.php";
 $db = NULL;
 $db = new DB();
?>

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
                    <?php echo form_open('reception/manage_bed_allotment/edit/do_update/'.$row['bed_allotment_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bed_number');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="bed_id" id="bed_id" >
										<?php 
										$Bedallotment = "";
										$arr=$db->getAvailableBeds();
										foreach($arr as $arrbedrow)
										{
											
										 $bedrow = $arrbedrow['bed_number']. " - ".$arrbedrow['type'];
										?>
                          <option value="<?php echo $arrbedrow['bed_id'];?>" selected="selected"><?php echo $bedrow ?></option>
                          
                                        <?php
										 }
										  ?>
									</select>
                                 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                        <select class="chzn-select" name="patient_id" id="patient_id">
										<?php 	
										$patientallotment = "";
										$arr1=$db->getavailablepatient();
										foreach($arr1 as $arrpatrow)
										{
									 
                                         
										$patientrow = $arrpatrow['patient_reg_no']. " - ". $arrpatrow['name'];
										
                                        if ($arrpatrow['patient_type']=='IPD')
 					 					 {
                                         ?>
                                 <option value="<?php echo $arrpatrow['patient_id'];?>"><?php echo $patientrow ?></option>
                                             <?php 
											 } 
											 ?>
                                             <?php } ?>
                                       
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('allotment_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="allotment_timestamp" value="<?php echo date('m/d/Y', $row['allotment_timestamp']);?>"/>
                                </div>
                            </div>
                            <!--<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discharge_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="discharge_timestamp" value="<?php echo date('m/d/Y', $row['discharge_timestamp']);?>"/>
                                </div>
                            </div>-->
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
                        <td align="center"  colspan="5">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="5">
                      <h1>Bed Allotment</h1></td>
                        </tr>
						<tr><td align="right" colspan="5">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Serial No.</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Bed Number</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Bed Type</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Patient Name</div></th>
                      <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Allotment Time</div></th>
                   <!-- <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discharge Date Time</div></th>-->
                    		
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
                            <th><div><?php echo get_phrase('allotment time');?></div></th>
                            <!--<th><div><?php echo get_phrase('discharge date time');?></div></th>-->
                    	<?php /*?>	<th><div><?php echo get_phrase('options');?></div></th><?php */?>
						</tr>
					</thead>
                    <tbody>
                    
							<?php $count = 1;foreach($bed_allotment as $row):
						
               			  $rep_html .='  <tr>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->			get_type_name_by_id('bed',$row['bed_id'],'bed_number').'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type').'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name').'</td>
     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['allotment_time'].'</td>
                            <!--<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('d/m/Y', $row['discharge_timestamp']).'</td>-->
							
                        </tr>';
						
                        endforeach;
                        ?>
                        
                      <?php  $count = 1;foreach($bed_allotment as $row): ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'bed_number'); ?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type');?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name');?></td>
                            <td><?php echo $row['allotment_time']; ?></td>
                            <?php /*?><td><?php echo date('d/m/Y', $row['discharge_timestamp']); ?></td><?php */?>
						<?php /*?>	<td align="center">
                            <a href="<?php echo base_url();?>index.php?reception/manage_bed_allotment/edit/<?php echo $row['bed_allotment_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a><?php */?>
                            	<!--<a href="<?php echo base_url();?>index.php?reception/manage_bed_allotment/delete/<?php echo $row['bed_allotment_id'];?>" onclick="return confirm('delete?')"
                                rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                <i class="icon-trash"></i>
                                </a>
        					</td>-->
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
                    <?php echo form_open('reception/manage_bed_allotment/create/' , array('class' => 'form-horizontal validatable'));?>
                    
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('bed_number');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="bed_id" id="bed_id" >
										<?php 
										$Bedallotment = "";
										$arr=$db->getAvailableBeds();
										foreach($arr as $arrbedrow)
										{
										 $bedrow = $arrbedrow['bed_number']. " - ".$arrbedrow['type'];
										?>
                          <option value="<?php echo $arrbedrow['bed_id'];?>"><?php echo $bedrow ?></option>
                                        <?php
										 }
										  ?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="patient_id" id="patient_id">
										<?php 	
										$patientallotment = "";
										$arr1=$db->getavailablepatient();
										foreach($arr1 as $arrpatrow)
										{
										$patientrow = $arrpatrow['patient_reg_no']. " - ". $arrpatrow['name'];
										
                                        if ($arrpatrow['patient_type']=='IPD')
 					 					 {
                                         ?>
                                 <option value="<?php echo $arrpatrow['patient_id'];?>"><?php echo $patientrow ?></option>
                                             <?php 
											 } 
											 ?>
                                             <?php 
											 } 
											 ?>

									</select>
                                </div>
                            </div>
                           <!-- <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('allotment_time');?></label>
                                <div class="controls">
                        <input type="text" required="required" class="datepicker fill-up" name="allotment_timestamp" id="allotment_timestamp" />
                                </div>
                            </div>-->
                           <?php /*?> <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discharge_time');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="discharge_timestamp"/>
                                </div>
                            </div>
                        </div><?php */?>
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
    
