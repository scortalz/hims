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
                    
                    <?php echo form_open('admin/manage_employee/edit/do_update/'.$row['employee_id'] , array('class' => 'form-horizontal validatable'));?>
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
                                  <option value="administration" <?php if($row['dept']=='administration')echo 'selected';?>><?php echo get_phrase('administration');?></option>
                                <option value="RMO" <?php if($row['dept']=='RMO')echo 'selected';?>><?php echo get_phrase('RMO');?></option>
								<option value="sonologist" <?php if($row['dept']=='sonologist')echo 'selected';?>><?php echo get_phrase('sonologist');?></option>
                                <option value="accounts" <?php if($row['dept']=='accounts')echo 'selected';?>><?php echo get_phrase('accounts');?></option>
								<option value="cashier" <?php if($row['dept']=='cashier')echo 'selected';?>><?php echo get_phrase('cashier');?></option>
                                <option value="inventory controller" <?php if($row['dept']=='inventory controller')echo 'selected';?>><?php echo get_phrase('inventory controller');?></option>
							<option value="sales officer" <?php if($row['dept']=='sales officer')echo 'selected';?>><?php echo get_phrase('sales officer');?></option>
                            <option value="junior staff nurse IPD" <?php if($row['dept']=='junior staff nurse IPD')echo 'selected';?>><?php echo get_phrase('junior staff nurse IPD');?></option>
                              <option value="female staff nurses IPD" <?php if($row['dept']=='female staff nurses IPD')echo 'selected';?>><?php echo get_phrase('female staff nurses IPD');?></option>
                                <option value="female staff nurses OPD" <?php if($row['dept']=='female staff nurses OPD')echo 'selected';?>><?php echo get_phrase('female staff nurses OPD');?></option>
                               <option value="male staff nurse IPD" <?php if($row['dept']=='male staff nurse IPD')echo 'selected';?>><?php echo get_phrase('male staff nurse IPD');?></option>
                            <option value="male OPD staff" <?php if($row['dept']=='male OPD staff')echo 'selected';?>><?php echo get_phrase('male OPD staff');?></option>
                            
                            <option value="OT technicians" <?php if($row['dept']=='OT technicians')echo 'selected';?>><?php echo get_phrase('OT technicians');?></option>
                            <option value="patient relationship officer" <?php if($row['dept']=='patient relationship officer')echo 'selected';?>><?php echo get_phrase('patient relationship officer');?></option>
                            <option value="front desk" <?php if($row['dept']=='front desk')echo 'selected';?>><?php echo get_phrase('front desk');?></option>
                             <option value="electrician-AC technician" <?php if($row['dept']=='electrician-AC technician')echo 'selected';?>><?php echo get_phrase('electrician-AC technician');?></option>
                             <option value="Lab Staff" <?php if($row['dept']=='Lab Staff')echo 'selected';?>><?php echo get_phrase('Lab Staff');?></option>
                               <option value="Housekeeping" <?php if($row['dept']=='Housekeeping')echo 'selected';?>><?php echo get_phrase('Housekeeping');?></option>
                                <option value="driver" <?php if($row['dept']=='driver')echo 'selected';?>><?php echo get_phrase('driver');?></option> 
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
                             <th><div><?php echo get_phrase('options');?></div></th>
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
							<td align="center">
                            <a href="<?php echo base_url();?>index.php?admin/manage_employee/edit/<?php echo $row['employee_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_employee/delete/<?php echo $row['employee_id'];?>" onclick="return confirm('delete?')"
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
				
						file_put_contents("reports/employee.pdf", $pdf);
						
				   ?>
             </div> 
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_employee/create' , array('class' => 'form-horizontal validatable'));?>
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
                                    	<option value="administration"><?php echo get_phrase('administration');?></option>
                                    	<option value="RMO"><?php echo get_phrase('RMO');?></option>
										<option value="sonologist"><?php echo get_phrase('sonologist');?></option>
                                        <option value="accounts"><?php echo get_phrase('accounts');?></option>
                                        <option value="cashier"><?php echo get_phrase('cashier');?></option>
                                        <option value="inventory controller"><?php echo get_phrase('inventory controller');?></option>
                                         <option value="sales officer"><?php echo get_phrase('sales officer');?></option>
                                    	<option value="junior staff nurse IPD"><?php echo get_phrase('junior staff nurse IPD');?></option>
										<option value="female staff nurses IPD"><?php echo get_phrase('female staff nurses IPD');?></option>
                                        <option value="female staff nurses OPD"><?php echo get_phrase('female staff nurses OPD');?></option>
                                        <option value="male staff nurse IPD"><?php echo get_phrase('male staff nurse IPD');?></option>
										<option value="male OPD staff"><?php echo get_phrase('male OPD staff');?></option>
										<option value="OT technicians"><?php echo get_phrase('OT technicians');?></option>
										<option value="patient relationship officer"><?php echo get_phrase('patient relationship officer');?></option>
										<option value="front desk"><?php echo get_phrase('front desk');?></option>
                                        <option value="electrician-AC technician"><?php echo get_phrase('electrician-AC technician');?></option>
                                        <option value="Lab Staff"><?php echo get_phrase('Lab Staff');?></option>
                                        <option value="Housekeeping"><?php echo get_phrase('Housekeeping');?></option>
                                        <option value="driver"><?php echo get_phrase('driver');?></option>
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



