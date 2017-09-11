<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 
<div class="box">
<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_category');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('category_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_category');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
          <?php	if(isset($edit_profile)):?>
			<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php 
					foreach($edit_profile as $row):?>
                    <?php echo form_open('admin/manage_category/edit/do_update/'.$row['category_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
						 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('surgery name');?></label>
                                <div class="controls">
                 					 <select name="surgery_id" id="surgery_id" class="uniform" style="width:100%;">
                                    	<?php 
										$departments = $this->db->get('surgery_type')->result_array();
										foreach($departments as $row2):
										?>
                                    		<option value="<?php echo $row2['surgery_id'];?>"
                                            	<?php if($row['surgery_id'] == $row2['surgery_id'])echo 'selected';?>>
													<?php echo $row2['desc'];?>
                                                    	</option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('category name');?></label>
                                <div class="controls">
                                <input type="text" class="validate[required]" name="category_name" id="category_name" value="<?php echo $row['category_name'];?>"/>
                                </div>
                            </div>
                           </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_category');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
                        
                <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                   
				<?php $rep_html ='  <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
                    
						<tr>
                        <td align="center"  colspan="3">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="3">
                      <h1>Manage Category</h1></td>
                        </tr>
						<tr><td align="right" colspan="3">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Surgery Name</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Category Name</div></th>
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
							<th><div><?php echo get_phrase('surgery name');?></div></th>
                            <th><div><?php echo get_phrase('category name');?></div></th>
                             <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    
                    	<?php $count = 1;foreach($categorys as $rows):
                 	$rep_html .='    <tr>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
				    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id_custom1('surgery_type',$rows['surgery_id'],'desc').'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['category_name'].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($categorys as $rows):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id_custom1('surgery_type',$rows['surgery_id'],'desc');?></td>
                            <td><?php echo $rows['category_name'];?></td>
							<td align="center">
                            <a href="<?php echo base_url();?>index.php?admin/manage_category/edit/<?php echo $rows['category_id'];?>"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                               	<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?admin/manage_category/delete/<?php echo $rows['category_id'];?>" onclick="return confirm('delete?')"
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
				
						file_put_contents("reports/surgerycategory.pdf", $pdf);
						
				   ?>
             </div> 
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_category/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
						<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('surgery name');?></label>
                                <div class="controls">
                                      <select class="chzn-select" name="surgery_id">
										<?php 
										$surgery_types	=	$this->db->get('surgery_type')->result_array();
										foreach($surgery_types as $row2):
										?>
                                        <option value="<?php echo $row2['surgery_id'];?>"><?php echo $row2['desc'];?></option>
                                        <?php
										endforeach;
										?>
									</select> 
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('category name');?></label>
                                <div class="controls">
                                    <input type="text"  name="category_name" id="category_name" class="validate[required]"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_category');?></button>
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
		$("#category_name").bind("keypress", function (event) {
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
  
		  var v = "reports/surgerycategory.pdf";
		  window.location = v;
 });
    });
	
 </script>