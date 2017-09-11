<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_employee');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('employee_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_employee');?>
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
                    
                    <?php echo form_open('reception/manage_employee/edit/do_update/'.$row['employee_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" name="emp_name" id="emp_name" value="<?php echo $row['emp_name'];?>"/>
                                </div>
                            </div>
                        </div>
						 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('department');?></label>
                                <div class="controls">
                                    <select name="dept" class="uniform" style="width:100%;">
                                    	<option value="admin" <?php if($row['dept']=='admin')echo 'selected';?>><?php echo get_phrase('admin');?></option>
                                    	<option value="RMO" <?php if($row['dept']=='RMO')echo 'selected';?>><?php echo get_phrase('RMO');?></option>
										<option value="sonologist" <?php if($row['dept']=='sonologist')echo 'selected';?>><?php echo get_phrase('sonologist');?></option>
                                    	<option value="OT" <?php if($row['dept']=='OT')echo 'selected';?>><?php echo get_phrase('OT');?></option>
										<option value="nursing" <?php if($row['dept']=='nursing')echo 'selected';?>><?php echo get_phrase('nursing');?></option>
                                    	<option value="reception" <?php if($row['dept']=='reception')echo 'selected';?>><?php echo get_phrase('reception');?></option>
										<option value="LAB" <?php if($row['dept']=='LAB')echo 'selected';?>><?php echo get_phrase('LAB');?></option>
                                    	<option value="housekeeping" <?php if($row['dept']=='housekeeping')echo 'selected';?>><?php echo get_phrase('housekeeping');?></option>
                                    </select>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_employee');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
					<div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                       		
              		<?php $rep_html = '<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive"  style="width:100%;">
                	<thead>
						<tr>
                        <td align="center"  colspan="3">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="3">
                        <h1>Manage Employee</h1></td>
                        </tr>
						<tr><td align="right" colspan="3">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Employee Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Department</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="4" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('employee name');?></div></th>
                    		<th><div><?php echo get_phrase('department');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($employees as $row):
                 		 $rep_html .= '<tr>
                       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
                       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row["emp_name"].'</td>
					   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row["dept"].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($employees as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['emp_name'];?></td>
							<td><?php echo $row['dept'];?></td>
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
				
						file_put_contents("reports/employee.pdf", $pdf);
						
				   ?>
             </div> 
                   
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_employee/create' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                 <input type="text" class="validate[required]" name="emp_name" id="emp_name" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('department');?></label>
                                <div class="controls">
                                   <select name="dept" class="uniform" style="width:100%;">
                                    	<option value="admin"><?php echo get_phrase('admin');?></option>
                                    	<option value="RMO"><?php echo get_phrase('RMO');?></option>
										<option value="sonologist"><?php echo get_phrase('sonologist');?></option>
                                    	<option value="OT"><?php echo get_phrase('OT');?></option>
										<option value="nursing"><?php echo get_phrase('nursing');?></option>
										<option value="reception"><?php echo get_phrase('reception');?></option>
										<option value="LAB"><?php echo get_phrase('LAB');?></option>
										<option value="housekeeping"><?php echo get_phrase('housekeeping');?></option>
                                    </select>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_employee');?></button>
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
		$("#emp_name").bind("keypress", function (event) {
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

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/employee.pdf";
		  window.location = v;
 });
    });
	
	
	
	</script>

