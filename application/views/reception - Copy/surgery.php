<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>  					
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_surgery');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('surgery_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_surgery');?>
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
                    <?php echo form_open('reception/surgery/edit/do_update/'.$row['type_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
						 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('surgery name');?></label>
                                <div class="controls">
                   						<select class="chzn-select" name="surgery_id" id="surgery_id">
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
                      			<select class="chzn-select" name="category_id" id="category_id">
										<?php 
										$categorys	=	$this->db->get('category')->result_array();
										foreach($categorys as $row2):
										?>
                                        <option value="<?php echo $row2['category_id'];?>"><?php echo $row2['category_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select> 
                                </div>
                            </div>
							  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sub category');?></label>
                                <div class="controls">
                               <input type="text" name="type" id="type" value="<?php echo $row['type']; ?>"/>
                                </div>
                            </div>
                           </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_surgery');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
                  <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                   
					<?php $rep_html ='  <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                   
						<tr>
                        <td align="center"  colspan="4">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="4">
                      <h1>Surgery </h1></td>
                        </tr>
						<tr><td align="right" colspan="4">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Surgery Name</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Category Name</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Sub Category</div></th>
                    
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="5" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('surgery name');?></div></th>
                            <th><div><?php echo get_phrase('category name');?></div></th>
                            <th><div><?php echo get_phrase('sub category');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    
                    	<?php $count = 1;foreach($surgerys as $rows):
                 	 $rep_html .='<tr>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id_custom1('surgery_type',$rows['surgery_id'],'desc').'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('category',$rows['category_id'],'category_name').'</td>
					   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$rows['type'].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($surgerys as $rows):?>
                        <tr>
                        <td><?php echo $count++; ?></td>
						<td><?php echo $this->crud_model->get_type_name_by_id_custom1('surgery_type',$rows['surgery_id'],'desc');?></td>
						<td><?php echo $this->crud_model->get_type_name_by_id('category',$rows['category_id'],'category_name');?></td>
					   <td><?php echo $rows['type'];?></td>
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
				
						file_put_contents("reports/surgery.pdf", $pdf);
						
				   ?>
             </div>
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/surgery/create/' , array('class' => 'form-horizontal validatable'));?>
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
                                      <select class="chzn-select" name="surgery_id">
										<?php 
										$this->db->order_by('category_name' , 'asc');
										$categorys	=	$this->db->get('category')->result_array();
										foreach($categorys as $row):
										if ($cat_name != $row['category_name'])
											{
										?>
                                        <option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
                                        <?php
										$cat_name = $row['category_name'];
											}
										endforeach;
										?>
									</select> 
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sub category');?></label>
                                <div class="controls">
                               <input type="text" name="type" id="type" class="validate[required]"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_surgery');?></button>
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
		$("#type").bind("keypress", function (event) {
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
  
		  var v = "reports/surgery.pdf";
		  window.location = v;
 });
    });
	
 </script>