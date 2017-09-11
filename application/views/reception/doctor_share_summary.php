
	<h2>Doctor Share Summary Report</h2>

<hr />
	<?php echo form_open('reception/doctor_share_summary_report' , array('class' => 'form-horizontal validatable'));?>

		<div class="control-group">
	        <label class="control-label " ><?php echo get_phrase('From');?></label>
	        <div class="controls">
	            <input type="date" class="" name="date_from" value="" required="required"/>
	        </div> 
	    </div>
	    <div class="control-group">
	    	<label class="control-label"><?php echo get_phrase('To');?></label>
	        <div class="controls">
	            <input type="date" class="" name="date_to" value="" required="required" />
	        </div> 
	    	
	    </div>

	    <label class="control-label"><?php echo get_phrase('Doctor Name');?></label>
	       <div class="controls">
	          <select name="doctor_id" id="doctor_id" class="uniform" style="width:100%;" required="required">
				 <option value="-1"> ------- Select Doctor -------</option>
	        	<?php $doctors = $this->db->get('doctor')->result_array();
				foreach($doctors as $row2): ?>
	       			<option value="<?php echo $row2['doctor_id'];?>"><?php echo $row2['name'];?></option>
	           <?php endforeach; ?>
	         </select>
	       </div>
		<div class="form-actions">
	        <button type="submit" class="btn btn-blue">Generate Report</button>
	    </div>

	<?php echo form_close();?>	

</div>