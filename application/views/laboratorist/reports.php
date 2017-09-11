<?php if($tab_add == 1){
$selectedservice = $this->db->get_where('patient_services', array(
				'id' => $this->uri->segment(4)
			))->result_array();
 ?>


<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tab1" >
                <div class="box-content pagination-centered">
					<div class="jumbotron">
					<?php foreach ($selectedservice as $selectedrow) { ?>
						
					
				<h1><?php $dptname = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $selectedrow['service_id']))->result_array(); echo get_phrase($dptname[0]['dept_name']) ;?></h1>

				<h3><?php $sername = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $selectedrow['service_id']))->result_array(); echo get_phrase($sername[0]['name']) ;?></h3>

					</div>

					<h3></h3>
              <?php echo form_open('waiting', array('class' => 'form-dhorizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">

         <?php $patientname = $this->db->get_where('patient',array('patient_reg_no' => $selectedrow['patient_reg_no']))->result_array();

         if(empty($patientname[0]['name'])) {
         ?>
              <label class="control-label"><?php echo get_phrase('not registered'); ?></label>
		<?php } else {  ?>
              <label class="control-label"><?php echo get_phrase($patientname[0]['name']); ?></label>
	                        <div class="controls">
	                        <input type="text" readonly name="" value="<?php echo $selectedrow['patient_reg_no'];?>" />
	                        </div>
           <?php } ?>         

                            </div>
                <div class="control-group">
                            <label class="control-label"><?php echo get_phrase('Select');?></label>
                            <div class="controls">
                            <select class="" name="" id="">

                              <option value="">--------------SELECT--------------</option>

                  			</select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                    <input type="text" name="" id="" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                    <input type="text" name="" id="" value=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                    <input type="text" name="" id="" value=""/>
                                </div>
                            </div>
                 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                    <input type="text" name="" id="" value=""/>
                                </div>
                            </div>
                <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                    <input type="text" name="" id="" value=""/>
                                </div>
                            </div>
              <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('care of');?></label>
                                <div class="controls">
                                    <input type="text" name="careof" id="careof" value=""/>
                                </div>
                            </div>

               <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('Generate report');?></button>
                        </div>
                        <?php } ?>
                    <?php echo form_close();?>
                </div>                
			</div>
		</div>

<?php } else { ?>
<div class="box">
	<div class="box-header">
			<div class="tab-pane box" id="tablast" >
                <div class="box-content">
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="color: grey !important;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('patient mr number'); ?></th>
                            <th><?php echo get_phrase('Service Type');?></th>
                            <th><?php echo get_phrase('service name');?></th>
                            <th><?php echo get_phrase('dept name');?></th>
                            <th><?php echo get_phrase('Quantity');?></th>
                            <th><?php echo get_phrase('service amount');?></th>
                            <th><?php echo get_phrase('Amount received');?></th>
                            <th><?php echo get_phrase('Amount discount');?></th>
                            <th><?php echo get_phrase('Amount Due');?></th>
                            <<th><?php echo get_phrase('Options');?></th>
                        </tr>

                        </thead>
                        <tbody>
                            <?php $count = 1; foreach ($services as $row) { ?>
                            	
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row['patient_reg_no']; ?></td>
							
							<td><?php $servicetype = $this->db->get_where('diagnostictype',array('diagnostictype_id' => $row['service_cat_id']))->result_array(); echo get_phrase($servicetype[0]['name']) ;?></td>
                        
                            <td><?php $servicename = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $row['service_id']))->result_array();  echo get_phrase($servicename[0]['name']) ;?></td>

                            <td><?php $deptname = $this->db->get_where('diagnosticservice',array('diagnosticservice_id' => $row['service_id']))->result_array();  echo get_phrase($deptname[0]['dept_name']) ;?></td>

                            <td><?php echo $row['service_qty']; ?></td>
                            <td><?php echo $row['service_amount']; ?></td>
                            <td><?php echo $row['service_received_amount']; ?></td>
                            <td><?php echo $row['service_discount_amount']; ?></td>
                            <td><?php echo $row['service_due_amount']; ?></td>
                            <td align="center">
							<a href="<?php echo base_url();?>index.php?laboratorist/labreports/add_report/<?php echo $row['id'];?>" rel="tooltip" data-placement="top" 
							data-original-title="<?php echo get_phrase('add');?>" 
							class="btn btn-info"> <i class="icon-plus"></i>
    						</a>
                       		 </td>
                        </tr>
                           <?php } ?>
                        </tbody>
                    </table>  
                </div>                
			</div>
	</div>
</div>
<?php } ?>