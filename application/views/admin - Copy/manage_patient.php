<?php 
	include   realpath(".") . "/application/helpers/mydb.php";
	$db = NULL;
	$db = new DB();
	
	// Call db->method to generate patient registration number
	$arrRegNo = $db->Generate_Patient_Registration_Number();

	$id = $arrRegNo[0]['patient_id'] + 1;	
	$gen_reg_no = 'MR-'.date('ym-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);

	$current_date = date('m/d/Y H:i', time());
?>

<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery-ui.js"></script>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>-->


<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
			
     <div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_patient');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('patient_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_patient');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded" >
		<div class="tab-content" >
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px" >
                <div class="box-content">
                	<?php foreach($edit_profile as $row):?>
                    <?php echo form_open('admin/manage_patient/edit/do_update/'.$row['patient_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
						<div class="control-group">	
                                <label class="control-label"><?php echo get_phrase('Registration no');?></label>
                                <div class="controls">
                                    <input type="text" name="patient_reg_no" id="patient_reg_no" value="<?php echo $row['patient_reg_no'];?>" readonly="readonly"/>
                                </div>
                            </div>
								<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient type');?></label>
                                <div class="controls">
                                    <select name="patient_type" id="patient_type" class="chzn-select" >
                                  <option value="OPD" <?php if($row['patient_type']=='OPD')echo 'selected';?>><?php echo get_phrase('OPD');?></option>
                                 <option value="IPD" <?php if($row['patient_type']=='IPD')echo 'selected';?>><?php echo get_phrase('IPD');?></option>
									</select>
                                </div>
                            </div>
							<?php /*?><div class="control-group" id="rooms" >
                                <label class="control-label"><?php echo get_phrase('room type');?></label>
                                <div class="controls">
                                         <select name="bed_id" id="bed_id" class="chzn-select" >
                                    	<?php 
										$beds = $this->db->get('bed')->result_array();
										foreach($beds as $row2):
										?>
                                   <option value="<?php echo $row2['bed_id'];?>"
                                            	<?php if($row['bed_id'] == $row2['bed_id'])echo 'selected';?>>
											<?php echo $row2['bed_number'].' - '.$row2['type'];?>
                                            		
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                              	<div class="control-group" id="roomcharge">
                                <label class="control-label"><?php echo get_phrase('room charges');?></label>
                                <div class="controls">
                               <input type="text" name="charges" id="charges" value="<?php echo $row['charges'];?>"/>
                                </div>
                            </div><?php */?>
								<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                                <div class="controls">
                                         <select name="doctor_id" id="doctor_id" class="chzn-select" >
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
						<?php /*?><div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reffered by');?></label>
                                <div class="controls">
								<select name="refferedby" id="refferedby" class="chzn-select" >
                              	<option value="RMC" <?php if($row['refferedby']=='RMC')echo 'selected';?>><?php echo get_phrase('RMC');?></option>
                               <option value="CardNo" <?php if($row['refferedby']=='CardNo')echo 'selected';?>><?php echo get_phrase('CardNo');?></option>
							<option value="OtherEntry" <?php if($row['refferedby']=='OtherEntry')echo 'selected';?>><?php echo get_phrase('OtherEntry');?></option>
												<option value="sameabove" <?php if($row['refferedby']=='sameabove')echo 'selected';?>><?php echo get_phrase('sameabove');?></option>
									</select>
			<input type="text" required="required" name="med_card_no" id="med_card_no" value="<?php echo $row['med_card_no'];?>" style="width:13%"  />
			<input type="checkbox" name="sameasabove" id="sameasabove" /><span style="vertical-align:middle">&nbsp;Same as above</span>
								
                                </div>
                            </div><?php */?>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('salutation');?></label>
                                <div class="controls">
                                <select name="salutation" id="salutation" class="chzn-select">
                              	<option value="Mr." <?php if($row['salutation']=='Mr.')echo 'selected';?>><?php echo get_phrase('Mr.');?></option>
                                <option value="Mrs." <?php if($row['salutation']=='Mrs.')echo 'selected';?>><?php echo get_phrase('Mrs.');?></option>
								<option value="B/O." <?php if($row['salutation']=='B/O.')echo 'selected';?>><?php echo get_phrase('B/O.');?></option>
						     <option value="Miss." <?php if($row['salutation']=='Miss.')echo 'selected';?>><?php echo get_phrase('Miss.');?></option>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]"  name="name" id="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('F / H. Name');?></label>
                                <div class="controls">
                                <input type="text" class="validate[required]" name="father_husbandname" id="father_husbandname" value="<?php echo $row['father_husbandname'];?>"/>
                                </div>
                            </div>
                           <!-- <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('email');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="email" id="email" value="<?php echo $row['email'];?>"/>
                                    <span id="ErrorContactEmail" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls">
                                    <input type="password" class="validate[required]" maxlength="15" name="password" id="password" value="<?php echo $row['password'];?>"/>
                                    <span id="result"></span>
                                </div>
                            </div>-->
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('nic no');?></label>
                                <div class="controls">
                                <input type="text"  name="nic_no" id="nic_no" value="<?php echo $row['nic_no'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text"  name="address" id="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" id="phone" maxlength="14" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex');?></label>
                                <div class="controls">
                                    <select name="sex" id="sex" class="chzn-select" >
                                    <option value="male" <?php if($row['sex']=='male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                 <option value="female" <?php if($row['sex']=='female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birth_date');?></label>
                                <div class="controls">
                           <input type="text"  name="birth_date" id="birth_date" value="<?php echo $row['birth_date'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="age" id="age" value="<?php echo $row['age'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                                <div class="controls">
                                    <select name="blood_group" id="blood_group" class="chzn-select" >
                                    	<option value="A+" <?php if($row['blood_group']=='A+')echo 'selected';?>>A+</option>
                                        <option value="A-" <?php if($row['blood_group']=='A-')echo 'selected';?>>A-</option>
                                        <option value="B+" <?php if($row['blood_group']=='B+')echo 'selected';?>>B+</option>
                                        <option value="B-" <?php if($row['blood_group']=='B-')echo 'selected';?>>B-</option>
                                        <option value="AB+" <?php if($row['blood_group']=='AB+')echo 'selected';?>>AB+</option>
                                        <option value="AB-" <?php if($row['blood_group']=='AB-')echo 'selected';?>>AB-</option>
                                        <option value="O+" <?php if($row['blood_group']=='O+')echo 'selected';?>>O+</option>
                                        <option value="O-" <?php if($row['blood_group']=='O-')echo 'selected';?>>O-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_patient');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->

                 <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                          
				<?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
    				<tr>
                        <td align="center"  colspan="8">
                      	<img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="8">
                      <h1>Manage Patient</h1></td>
                        </tr>
						<tr><td align="right" colspan="8">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                      <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Reg No.</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor Name</div></th>
						
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Phone</div></th>
               <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Age</div></th>
              <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Sex</div></th> -->
			<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Type</div></th>
		<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Bed</div></th>
		<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discharge Type</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="10" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
                    		<th><div><?php echo get_phrase('patient_reg_no.');?></div></th>
							<th><div><?php echo get_phrase('patient name');?></div></th>
                    		<th><div><?php echo get_phrase('doctor name');?></div></th>
                           <?php /*?> <th><div><?php echo get_phrase('reffered by');?></div></th><?php */?>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                      <!--       <th><div><?php echo get_phrase('age');?></div></th>
                             <th><div><?php echo get_phrase('sex');?></div></th> -->
                             <th><div><?php echo get_phrase('patient_type');?></div></th>
                             <th><div><?php echo get_phrase('bed');?></th>
                             <th><div><?php echo get_phrase('discharge type');?></th>
                             <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($patients as $row):
                        $Bed = "";
							$arrPD = $db->getPatientBed($row['patient_id']);
							if (count($arrPD) > 0 )
							{
								$Bed = $arrPD[0]['bed'];
							}
                         $rep_html .=' <tr>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_reg_no'].'</td>
					 <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name').'</td>
				
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['phone'].'</td>
		<!-- <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['age'].'</td>
			<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['sex'].'</td> -->
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_type'].'</td>
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $Bed.'</td>
	<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['discharge_type'].'</td>				
                           </tr>';
						        endforeach;
                        ?>
                        
                        <?php $count = 1;foreach($patients as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['patient_reg_no'];?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>
							<td><?php echo $row['phone'];?></td>
						<!--	<td><?php echo $row['age'];?></td>
							<td><?php echo $row['sex'];?></td> -->
                            <td><?php echo $row['patient_type'];?></td>
                            <?php 
							$Bed = "";
							$arrPD = $db->getPatientBed($row['patient_id']);
							if (count($arrPD) > 0 )
							{
								$Bed = $arrPD[0]['bed'];
							}
						
						?>
                             <td><?php echo $Bed;?></td>  
                          <td><?php echo $row['discharge_type'];?></td>    
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_patient/edit/<?php echo $row['patient_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_patient/delete/<?php echo $row['patient_id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
            <?php 
					
                  		$rep_html .= '</tbody></table></div>';
				   		//echo $rep_html;
						
						$dompdf = new DOMPDF();
						$dompdf->load_html($rep_html);

					    $dompdf->render();

					    // The next call will store the entire PDF as a string in $pdf
						$pdf = $dompdf->output();

						// write $pdf to disk, store it in a database or stream it
						// to the client.
				
						file_put_contents("reports/registeredpatient.pdf", $pdf);
						
				   ?>
             </div>   
			 <!----TABLE LISTING ENDS--->
         
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_patient/create/' , array('class' => 'form-horizontal validatable'));?>
                    <form method="post" action="<?php echo base_url();?>index.php?" class="form-horizontal validatable">
                        <div class="padded">
						<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('registration no');?></label>
                                <div class="controls">
                              <input type="text"  name="patient_reg_no" id="patient_reg_no" readonly="readonly" value="<?php echo $gen_reg_no; ?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient type');?></label>
                                <div class="controls">
                                   <select name="patient_type" id="patient_type" class="chzn-select" >
                                    	<option  id="OPD" value="OPD"><?php echo get_phrase('OPD');?></option>
                                    	<option id="IPD" value="IPD"><?php echo get_phrase('IPD');?></option>
                                    </select>
                                </div>
                            </div>
						<?php /*?>  <div class="control-group" id="rooms" style="display:none">
                                <label class="control-label"><?php echo get_phrase('room type');?></label>
                                <div class="controls">
                      <select class="chzn-select" name="bed_id" id="bed_id" style="width: 310px!important;">
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
                            	<div class="control-group" id="roomcharge" style="display:none">
                                <label class="control-label"><?php echo get_phrase('room charges');?></label>
                                <div class="controls">
                               <input type="text"  name="charges" id="charges" value="<?php echo $row['charges'];?>"/>
                                </div>
                            </div><?php */?>
						<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('consultant name');?></label>
                                <div class="controls">
                                   <select name="doctor_id" id="doctor_id" class="chzn-select" >
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
						<?php /*?>	<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reffered by');?></label>
                                <div class="controls">
								<select name="refferedby" id="refferedby" class="chzn-select"  >
                                    	<option id="RMC" value="RMC"><?php echo get_phrase('RMC');?></option>
                                    	<option id="md"  value="CardNo"><?php echo get_phrase('CardNo');?></option>
										<option id="oe" value="OtherEntry"><?php echo get_phrase('OtherEntry');?></option>
										<option id="sa" value="sameabove"><?php echo get_phrase('sameabove');?></option>
                                    </select>
					<input type="text"  required="required"  name="med_card_no" id="med_card_no" style="display:none;width:13%" />
				<input type="checkbox" name="sameasabove" id="sameasabove"/><span id="labelsameabove" style="vertical-align:middle">&nbsp;Same as above</span>
                                    <!--<input type="text" class="validate[required]" name="refferedby" />-->
                                </div>
                            </div><?php */?>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('salutation');?></label>
                                <div class="controls">
                                    <select name="salutation" class="chzn-select" >
                                    	<option value="Mr."><?php echo get_phrase('Mr.');?></option>
                                    	<option value="Mrs."><?php echo get_phrase('Mrs.');?></option>
										<option value="B/O."><?php echo get_phrase('B/O.');?></option>
										<option value="Miss."><?php echo get_phrase('Miss.');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label"><?php echo get_phrase('patient name');?></label>
                              <div class="controls" >
                                    <input type="text" class="validate[required]"  name="name" id="name"/>
                                </div>
                            </div>
							<div class="control-group">
                              <label class="control-label"><?php echo get_phrase('F / H. Name');?></label>
                              <div class="controls">
                                    <input type="text" class="validate[required]" name="father_husbandname" id="father_husbandname" />
                                </div>
                            </div>
                         <!--   <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('email');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="email" id="email"/>
									<span id="ErrorContactEmail" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls" >
                                    <input type="password" class="validate[required]" name="password" id="password" maxlength="15"/>
									<span id="result"></span>
                                </div>
                            </div>-->
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('nic no');?></label>
                                <div class="controls">
                                    <!--<input type="text" class="validate[required]" name="nic_no" id="nic_no" />-->
				<input type="text" name="start_5" id="start_5" placeholder="12345"  maxlength="5" style="width:6%"/>
				<input type="text" name="mid_7" id="mid_7" placeholder="1234567"  maxlength="7" style="width:7%"/>
				<input type="text" name="end_1" id="end_1" placeholder="1"  maxlength="1" style="width:2%"/>
								<!--<span id="ErrorCNIC"></span>-->
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text"  name="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
								<!--<input type="text"  name="" id="" value="+92" style="width:4%" readonly=""/>-->
                                    <input type="text" class="validate[required]"  name="phone" id="phone" maxlength="12" style="width:17%"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                    	<option value="male"><?php echo get_phrase('male');?></option>
                                    	<option value="female"><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birth_date');?></label>
                                <div class="controls">
                                    <input type="text"  name="birth_date" id="birth_date" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text"  name="age" value="" id="age" readonly=""/>
                                </div>
                            </div>
                           <?php /*?> <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Created Datetime');?></label>
                                <div class="controls">
                                    <input type="text"  name="created_datetime" value="<?php echo $current_date; ?>" id="created_datetime"/>
                                </div>
                            </div><?php */?>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                                <div class="controls">
                                    <select name="blood_group" class="uniform" style="width:100%;">
                                    <option value="0">Select Group</option>
                                    	<option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_patient');?></button>
                        </div>
                    <?php echo form_close();?>                
                <!--</div>                
			</div>-->
			<!----CREATION FORM ENDS--->
            
	<!--	</div>
	</div>
</div>-->

<script type="text/javascript">
$(document).ready(function() {

$('#birth_date').change(function(){

var today = new Date();
var dd = Number(today.getDate());
var mm = Number(today.getMonth()+1);

var yyyy = Number(today.getFullYear()); 

var myBD = $('#birth_date').val();
var myBDM = Number(myBD.split("/")[0])
var myBDD = Number(myBD.split("/")[1])
var myBDY = Number(myBD.split("/")[2])
var age = yyyy - myBDY;
//$('#age input').attr("disabled","disabled")

        if(mm < myBDM)
        {
        age = age - 1;      
        }
        else if(mm == myBDM && dd < myBDD)
        {
        age = age - 1
        };
		
		
        $('#age').val(age);
    });

});
</script>

<script>
$(function() {
  var currentTime = new Date();
  var year = currentTime.getFullYear()
//alert(year-1);
$( "#birth_date" ).datepicker({maxDate: new Date(year-1,8,31)});
});
</script>

<script type="text/javascript">
    
        $(document).ready(function(){
    
       $("#patient_type").change(function(){
            var type = $("#patient_type").val();
            if (type == 'OPD')
            {
                $("#rooms").hide();
				$("#roomcharge").hide('slow');
				$("#nodays").hide('slow');
				nodays
            }
            else
            {
                $("#rooms").show('slow');
				$("#roomcharge").show('slow');
				$("#nodays").show('slow');
            }
    
        });
     
    });
       	var chargess='';
	$("select[name='bed_id']").change(function()
	{
		var bed_id_id = $("select[name='bed_id']").val();
		//alert(bed_id_id);
		$('#charges').val();
		
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/getbedcharges.php",
			data: ({post_bed_id: bed_id_id}),
			success: function(response)	
			{
			//	alert(response);
			chargess=response;
				$("#charges").val(response);
				$('#days').val('');
			}
		});	
		
	  });
	  
	  $('#days').blur(function(){
		var charges  = chargess;//$('#roomcharges').val();
		var days  = $('#days').val();
		
		//alert(days);
		var totalroomcharges = parseInt(parseInt(charges) * parseInt(days));//.toFixed(2);
			
			$('#charges').val(totalroomcharges);
			//alert($('#dueamount').val());
 	});
    </script>

<script type='text/javascript' src='jquery.min.js'></script>
<!-- JavaScript Patient Validation Code Start -->
	<script language="javascript">
	$(document).ready(function () {
		$("#name").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	$("#father_husbandname").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	});
	
		
	$("#phone").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[0-9-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	}); 
	
	$("#start_5").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[0-9-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	}); 
	
	$("#mid_7").bind("keypress", function (event) {
		if (event.charCode!=0) {
			var regex = new RegExp("^[0-9-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		}
	}); 
	
	$("#end_1").bind("keypress", function (event) {
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
	</script>	
	
<script>

$(document).ready(function() {
 $('#sameasabove').hide('slow');
 $('#labelsameabove').hide('slow');
 
 
    $('#password').keyup(function(){
    $('#result').html(checkStrength($('#password').val()))
    })  
 
    function checkStrength(password){
 
	 //password should not be null or empty, return message.
    if (password=="" || password=="null") {
        $('#result').removeClass()
        $('#result').addClass('password field should not be empty')
           return '<span style="color:red">password field should not be empty </span>' 
    }
	
    //if the password length is less than 6, return message.
    if (password.length < 6) {
        $('#result').removeClass()
        $('#result').addClass('short')
        return '<span style="color:red">Too short </span>'
    }
  	
	 //if the password length is greater than 6, return message.
    if (password.length > 6) {
        $('#result').removeClass()
        $('#result').addClass('Password is Strong')
        return '<span style="color:green"> Password is Strong </span> '
    }
   
}
     	
});

</script>
 
<script>

// Email Validation
   $('#email').blur(function(){
   
   var e=document.getElementById('email').value;
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{3,5})$/;
   if(reg.test(e) == false) {
    $('#ErrorContactEmail').show();
    $('#ErrorContactEmail').text('Invalid Email Address');
	$('#email').focus();
    return false;
   }
   else
   {
    $('#ErrorContactEmail').hide();
    $('#ErrorContactEmail').text('');
   }
    
});


</script>

<script>
// Reffered by onchange

		$('#refferedby').change (function () {
		
		var s = $('#refferedby').val();
		if (s == 'CardNo')
		{
			$('#med_card_no').val('');
			$('#sameasabove').hide('slow');
			$('#labelsameabove').hide('slow');
			$('#med_card_no').show('slow');
		//	$("#med_card_no").attr("required", "required");
			$("#med_card_no").focus();
		}
		else if (s == 'OtherEntry')
		{
			$('#med_card_no').val('');
			$('#labelsameabove').hide('slow');
			$('#sameasabove').hide('slow');
			$('#med_card_no').show('slow');
		//	$("#med_card_no").attr("required", "required");
			$("#med_card_no").focus();
		}
		else if (s == 'sameabove')
		{
			$('#med_card_no').val('');
			$('#sameasabove').show('slow');
			$('#labelsameabove').show('slow');
			$('#med_card_no').show('slow');
		//	$("#med_card_no").attr("required", "required");
			$("#med_card_no").focus();
		}
		else
		{
			$('#med_card_no').val('');
			$('#sameasabove').hide('slow');
			$('#labelsameabove').hide('slow');
			$('#med_card_no').hide('slow');
		//	$("#med_card_no").attr("required", false);
			$("#med_card_no").focus();
		
		}
		
		$("#sameasabove").click(function() {
		if($('#sameasabove').is(":checked"))
		{
			var referredby = $('#doctor_id :selected').text();
			$('#med_card_no').val(referredby);
		}
		else
		{
			//$('input[name=sameasabove]').attr('checked', false);
			//$("#refferedby").val('');
			//$("#refferedby").focus();
			$('#med_card_no').val('');
		}
	});
			
	});

	

</script>

<script type="text/javascript">
	$("#email").blur(function(){
			var value = $("#email").val();
			//alert(value);
			
			$.post("<?php echo base_url();?>/application/helpers/checkduplicateemail.php", { post_email_id : value }, 
			function (data){
					if( data == 1)
					{
						if (value.length != 0 )
						{
							$("#ErrorContactEmail").show();
							$("#ErrorContactEmail").text('Duplicate EmailID.');
							return false;
						}
					}
					else
					{
						$("#ErrorContactEmail").hide();
						$("#ErrorContactEmail").text('');
					}
			});
		});


</script>

<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/registeredpatient.pdf";
		 // alert(v);
		  window.location = v;
 });
    });
	
	
	
	</script>
	