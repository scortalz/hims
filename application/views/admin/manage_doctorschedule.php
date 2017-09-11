<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_doctorschedule');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('doctorschedule_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_doctorschedule');?>
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
                    <?php echo form_open('admin/manage_doctorschedule/edit/do_update/'.$row['timing_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
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
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('timings');?></label>
                                <div class="controls">
                                 <?php include "days_timings.php"; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_doctorschedule');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
							<th><div><?php echo get_phrase('doctor name');?></div></th>
							<th><div><?php echo get_phrase('days');?></div></th>
							<th><div><?php echo get_phrase('Start Time');?></div></th>
                    		
							<th><div><?php echo get_phrase('End Time');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($schedules as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>
							<td><?php echo $row['days'] ;?></td>
							<td><?php echo  $row['1_open_time'];?></td>
							<td><?php echo  $row['1_close_time'];?></td>
							
							<td align="center">
                            	<a href="<?php echo base_url();?>index.php?admin/manage_doctorschedule/edit/<?php echo $row['timing_id'];?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_doctorschedule/delete/<?php echo $row['timing_id'];?>" onclick="return confirm('delete?')"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete');?>" class="btn btn-red">
                                		<i class="icon-trash"></i>
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
                    <?php echo form_open('admin/manage_doctorschedule/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('doctor');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="doctor_id">
										<?php 
										$doctors	=	$this->db->get('doctor')->result_array();
										foreach($doctors as $row2):
										?>
                                        <option value="<?php echo $row2['doctor_id'];?>"><?php echo $row2['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select> 
                                </div>
                            </div>
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
                                <div class="controls">
                                    <?php include "days_timings.php"; ?>
                                </div>
                            </div>
                          
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_doctorschedule');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
