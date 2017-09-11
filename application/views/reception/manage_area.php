<?php // include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 					
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_area');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('area_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_area');?>
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
                    <?php echo form_open('reception/manage_area/edit/do_update/'.$row['area_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
						 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('floor');?></label>
                                <div class="controls">
                   <select name="floor_id" class="uniform">
                  <option value="Ground Floor" <?php if($row['floor_id']=='Ground Floor')echo 'selected';?> > <?php echo get_phrase('Ground Floor');?> </option>
                  <option value="First Floor" <?php if($row['floor_id']=='First Floor')echo 'selected';?> > <?php echo get_phrase('First Floor');?></option>
				  <option value="Second Floor" <?php if($row['floor_id']=='Second Floor')echo 'selected';?> > <?php echo get_phrase('Second Floor');?></option>
									</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('area name');?></label>
                                <div class="controls">
                                <input type="text" class="validate[required]" name="area" id="area" value="<?php echo $row['area'];?>"/>
                                </div>
                            </div>
                           </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_area');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
			</div>
            <?php endif;?>
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
				<?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive"  style="width:100%;">
                	<thead>
						<tr>
                        <td align="center"  colspan="3">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="3">
                      <h1>Manage Area</h1></td>
                        </tr>
						<tr><td align="right" colspan="3">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Floor Name</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div >Area Name</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <!-- <tr>
                        <td colspan="4" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
						-->
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('floor name');?></div></th>
                            <th><div><?php echo get_phrase('area name');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($areas as $rows):
                 	$rep_html .='     <tr>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
					    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('floor',$rows['floor_id'],'floor_name').'</td>
					    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $rows['area'].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php  $count = 1;foreach($areas as $rows):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('floor',$rows['floor_id'],'floor_name'); ?></td>
                           <td><?php echo $rows['area'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               
            <?php 
					/*
                  		$rep_html .= '</tbody></table></div>';
				   		//echo $rep_html;
						
						$dompdf = new DOMPDF();
						$dompdf->load_html($rep_html);

					    $dompdf->render();

					    // The next call will store the entire PDF as a string in $pdf
						$pdf = $dompdf->output();

						// write $pdf to disk, store it in a database or stream it
						// to the client.
				
						file_put_contents("reports/area.pdf", $pdf);
						*/
				   ?>
             </div> 
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_area/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
						<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('floor');?></label>
                                <div class="controls">
                                      <select class="chzn-select" name="floor_id">
										<?php 
										$floors	=	$this->db->get('floor')->result_array();
										foreach($floors as $row2):
										?>
                                        <option value="<?php echo $row2['floor_id'];?>"><?php echo $row2['floor_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select> 
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('area name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="area" id="area"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_area');?></button>
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
		$("#area").bind("keypress", function (event) {
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
 /*
	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/area.pdf";
		  window.location = v;
 });
    });
	*/
</script>