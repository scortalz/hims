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
					<?php echo get_phrase('bed_transfer_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_bed_transfer');?>
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
                    <?php echo form_open('admin/bed_transfer/edit/do_update/'.$row['bed_mapping_id'] , array('class' => 'form-horizontal validatable'));?>
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
                        <td align="center"  colspan="7">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="7">
                      <h1>Bed Transfer</h1></td>
                        </tr>
						<tr><td align="right" colspan="7">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Serial No.</div></th>
					         <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Patient Reg No</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Patient Name</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div > Reserved Bed</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Available Bed</div></th>
                <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Charges</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Bed Transfer Date/Time</div></th>
                    		
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
                            <th><div><?php echo get_phrase('patient reg no');?></div></th>
                            <th><div><?php echo get_phrase('patient name');?></div></th>
                            <th><div><?php echo get_phrase('reserved bed');?></div></th>
                    		<th><div><?php echo get_phrase('available bed');?></div></th>
							<th><div><?php echo get_phrase('charges');?></div></th>
                            <th><div><?php echo get_phrase('bed transfer date/time');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    
							<?php $count = 1;foreach($patient_bed_mappings as $row):
						
               			  $rep_html .='  <tr>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'patient_reg_no').'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name').'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->			get_type_name_by_id('bed',$row['bed_id'],'bed_number').'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type').'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'charges').'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date("d/m/Y H:i", strtotime($row["transferdate"])).'</td>
                            
							
                        </tr>';
						
                        endforeach;
                        ?>
                        
                      <?php  $count = 1;foreach($patient_bed_mappings as $row): ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'patient_reg_no');?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name');?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'bed_number'); ?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type');?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'charges');?></td>
                            <td><?php echo date("d/m/Y H:i", strtotime($row["transferdate"])) ?></td>
						<?php /*?	<td align="center">
                            ><a href="<?php echo base_url();?>index.php?reception/manage_bed_allotment/edit/<?php echo $row['bed_allotment_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a><?php */?>
                            	<!--<a href="<?php echo base_url();?>index.php?reception/manage_bed_allotment/delete/<?php echo $row['bed_allotment_id'];?>" onclick="return confirm('delete?')"
                                rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                <i class="icon-trash"></i>
                                </a>-->
        					<!--</td>-->
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
						
						file_put_contents("reports/bedtransfer.pdf", $pdf);
				   ?>
                   </div>
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/bed_transfer/create/' , array('class' => 'form-horizontal validatable'));?>
                    
                          <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="patient_id" id="patient_id" >
                                    <option>-----------Select Patient-----------</option>
										<?php 	
										$transferpatient = "";
										$arr2=$db->gettransferpatient();
										foreach($arr2 as $arrtranspatrow)
										{
											$patienttransferrow = $arrtranspatrow['patient_reg_no']. " - ". $arrtranspatrow['name'];
										
                                        ?>
                        <option value="<?php echo $arrtranspatrow['patient_id'];?>"><?php echo $patienttransferrow ?></option>
                                             
                                             <?php } ?>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reserved bed');?></label>
                                <div class="controls">
                                      <input type="hidden" name="bed_post_id" id="bed_post_id" />
                                      <input type="text" name="reservedbed" id="reservedbed" readonly />
                                </div>
                            </div>
                              <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('available bed');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="bed_id" id="bed_id">
                                    <option>------Select Available Bed-----</option>
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
                                <label class="control-label"><?php echo get_phrase('charges');?></label>
                                <div class="controls">
                        <input type="text"  name="charges" id="charges" />
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_bed_transfer');?></button>
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
  
		  var v = "reports/bedtransfer.pdf";
		  window.location = v;
 });
    });
	
	</script>
    
<script>

		$("select[name='patient_id']").change(function()
		{
			var pat_id = $("select[name='patient_id']").val();
			//alert(pat_id);

			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/getreservedbed.php",
				data: ({post_pat_id: pat_id}),
				success: function(response)	
				{
					
					var sp = response.split('-');
					
					//alert(sp);
					
					//alert(sp[0]);
					
					$("#reservedbed").val(sp[1] + ' ' + sp[2]);
					
					$('#bed_post_id').val(sp[0]);
	
					$("#reservedbed").val(response);
				}
			});	
			
		  });
		  
		$("select[name='bed_id']").change(function()
		{
			var bed_idd = $("select[name='bed_id']").val();
		//	alert(bed_idd);

			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/getavailablebedcharge.php",
				data: ({post_bed_id: bed_idd}),
				success: function(response)	
				{
					//alert(response);
	
					$("#charges").val(response);
				}
			});	
			
		  });
</script>    
    
    