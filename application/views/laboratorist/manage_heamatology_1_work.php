<div class="box">
	<div class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_hematology_1)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_heamatology1_report');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_hematology_1))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('Heamatology1_Report_list');?>
                    	</a></li>
			<li>
                            <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('add_heamatology1_report');?>
                                    </a></li>
		</ul>
    	<!--CONTROL TABS END-->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	<?php if(isset($edit_hematology_1)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_hematology_1 as $row):?>
                    <?php echo form_open('laboratorist/manage_hematology_1_work/edit/do_update/'.$row['id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" value="<?php echo $row['patient_name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="age" value="<?php echo $row['age'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                        <option value="male" <?php if($row['sex']=='male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                        <option value="female" <?php if($row['sex']=='female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('cons . phy / clinic');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="doc_name" value="<?php echo $row['doc_name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('mobile no');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mobile_no" value="<?php echo $row['mobile_no'];?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone_no');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                                <div class="controls">
                                    <select name="blood_group" class="uniform" style="width:100%;">
                                        <option value="A+" <?php if($row['blood_group']=='A+')echo 'selected';?>>A+</option>
                                        <option value="A-" <?php if($row['blood_group']=='A-')echo 'selected';?>>A-</option>
                                        <option value="B+" <?php if($row['blood_group']=='B+')echo 'selected';?>>B+</option>
                                        <option value="B-" <?php if($row['blood_group']=='B-')echo 'selected';?>>B-</option>
                                        <option value="AB+" <?php if($row['blood_group']=='AB+')echo 'selected';?>>AB+</option>
                                        <option value="AB-" <?php if($row['blood_group']=='AB-')echo 'selected';?>>AB-</option>
                                        <option value="O+" <?php if($row['blood_group']=='O+')echo 'selected';?>>O+</option>
                                        <option value="O-" <?php if($row['blood_group']=='O --')echo 'selected';?>>O-</option>
                                    </select>
                                </div>
                            </div>
                             <div class="control-group">
                                
                                <div class="controls">
                                    <input type="hidden" class="" name="laboratrist_name" value="<?php echo $row['laboratrist_name'];?>"/>
                                </div>
                            </div>
                          <!--  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('neutrophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="neutrophills" value="<?php echo $row['neutrophills'];?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('lymphocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="lymphocytes" value="<?php echo $row['lymphocytes'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('eosinophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="eosinophills" value="<?php echo $row['eosinophills'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('monocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="monocytes" value="<?php echo $row['monocytes'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('basophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="basophills" value="<?php echo $row['basophills'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('premature w . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="premature" value="<?php echo $row['premature'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="blasts" value="<?php echo $row['blasts'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('normoblasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="normoblasts" value="<?php echo $row['normoblasts'];?>"/>
                                </div>
                            </div>-->
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('haemoglobin');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="haemoglobin" value="<?php echo $row['haemaglobin'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('red cells');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="redcells" value="<?php echo $row['red_cells'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                
                                <div class="controls">
                                    <input type="hidden" class="" name="pcv" value="<?php echo $row['laboratrist_name'];?>"/>
                                </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('p . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="pcv" value="<?php echo $row['pcv'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mcv" value="<?php echo $row['mcv'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mch" value="<?php echo $row['mch'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h .c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mchc" value="<?php echo $row['mchc'];?>"/>
                                </div>
                            </div>
                           <!--   <div class="control-group">
                              <label class="control-label"><?php echo get_phrase('e. s . r');?></label>
                              <div class="controls">
                                  <input type="text" class="" name="esr" value="<?php echo $row['esr'];?>"/>
                              </div>
                                                       </div>
                                                       <div class="control-group">
                              <label class="control-label"><?php echo get_phrase('platelets');?></label>
                              <div class="controls">
                                  <input type="text" class="" name="platelets" value="<?php echo $row['platelets'];?>"/>
                              </div>
                                                       </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('morphology of r . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="morphology" value="<?php echo $row['morphology'];?>"/>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_heamatology1_report');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            </div>
            <?php endif;?>
            <!--EDITING FORM ENDS-->
            
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_hematology_1)) echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('age');?></div></th>
                    		<th><div><?php echo get_phrase('report date');?></div></th>
                    		<th><div><?php echo get_phrase('Docter Name');?></div></th>
                    		<th><div><?php echo get_phrase('laboratorist name');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($hematology_1_report_data as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['patient_name'];?></td>
							<td><?php echo $row['age'];?></td>
							<td><?php echo $row['report_date'];?></td>
							<td><?php echo $row['doc_name'];?></td>
							<td><?php echo $row['laboratrist_name'];?></td>
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?laboratorist/manage_hematology_1_work/edit/<?php echo $row['id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?laboratorist/manage_hematology_1_work/delete/<?php echo $row['id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
                                </a>
                                <?php $image="uploads/report_logo.png"?>
                                <a href="<?php echo base_url();?>index.php?laboratorist/manage_Heamatology_1/<?php echo $row['id']?>" target="blank"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print');?>" class="btn btn-blue">
                                        <i ><img src="<?php echo base_url($image)?>"/></i>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('laboratorist/manage_hematology_1_work/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('age');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="age"/>
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
                                <label class="control-label"><?php echo get_phrase('cons . phy / clinic');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="doc_name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('mobile no');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mobile_no"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone_no');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('department_no');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="department_no"/>
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('laboratorist name');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="laboratorist_name"/>
                                </div>
                            </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blood_group');?></label>
                                <div class="controls">
                                    <select name="blood_group" class="uniform" style="width:100%;">
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
                            <!-- <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('leucocytes total');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="leucocytes"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('neutrophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="neutrophills"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('lymphocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="lymphocytes"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('eosinophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="eosinophills"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('monocytes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="monocytes"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('basophills');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="basophills"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('premature w . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="premature"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('blasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="blasts"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('normoblasts');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="normoblasts"/>
                                </div>
                            </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('haemoglobin');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="haemoglobin"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('red cells');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="redcells"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('p . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="pcv"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . v');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mcv"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mch"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('m . c . h .c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mchc"/>
                                </div>
                            </div>
                            <!--  <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('e. s . r');?></label>
                               <div class="controls">
                                   <input type="text" class="" name="esr"/>
                               </div>
                                                        </div>
                                                        <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('platelets');?></label>
                               <div class="controls">
                                   <input type="text" class="" name="platelets"/>
                               </div>
                                                        </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('morphology of r . b . c');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="morphology"/>
                                </div>
                            </div>

                           <!--  <div class="control-group">
                               <label class="control-label"><?php echo get_phrase('last_donation_date');?></label>
                               <div class="controls">
                                   <input type="text" class="datepicker fill-up" name="last_donation_timestamp"/>
                               </div>
                           </div>
                                                    --></div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_hematology1_report');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>