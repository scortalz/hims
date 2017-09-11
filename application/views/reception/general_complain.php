<?php // include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_general_complain');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('general_complain_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_general_complain');?>
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
                    <?php echo form_open('reception/general_complain/edit/do_update/'.$row['general_comp_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                           <?php /*?> <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('incident date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="incident_date" value="<?php echo $row['incident_date'] ?>"/>
                                </div>
                            </div><?php */?>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                   <textarea name="description" id="description" class="validate[required]"><?php echo $row['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                 <select name="status" class="uniform">
                  <option value="resolved" <?php if($row['status']=='resolved')echo 'selected';?> > <?php echo get_phrase('resolved');?> </option>
                  <option value="unresolved" <?php if($row['status']=='unresolved')echo 'selected';?> > <?php echo get_phrase('unresolved');?></option>
									</select>
								   
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                 <select name="option" class="uniform">
                  <option value="guilty" <?php if($row['option']=='guilty')echo 'selected';?> > <?php echo get_phrase('guilty');?> </option>
                  <option value="non guilty" <?php if($row['option']=='non guilty')echo 'selected';?> > <?php echo get_phrase('non guilty');?></option>
									</select>
								   
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_general_complain');?></button>
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
                        <td align="center"  colspan="4">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="4">
                      <h1>General Complain</h1></td>
                        </tr>
						<tr><td align="right" colspan="4">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Incident Date</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Description</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Status</div></th>	
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <!-- <tr>
                        <td colspan="5" align="right">
                  <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
						-->
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('incident date');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                             <th><div><?php echo get_phrase('status');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($general_complains as $row):
                 		 $rep_html .='<tr>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y ', strtotime($row['incident_date'])).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['description'].'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['status'].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($general_complains as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo date('m/d/Y ', strtotime($row['incident_date']));?></td>
							<td><?php echo $row['description'];?></td>
                            <td><?php echo $row['status'];?></td>
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
				
						file_put_contents("reports/generalcomplain.pdf", $pdf);
						*/
				   ?>
             </div> 
                   
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/general_complain/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                          <?php /*?>  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('incident date');?></label>
                                <div class="controls">
                                  <input type="text" class="datepicker fill-up" name="incident_date"/>
                                </div>
                            </div><?php */?>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                   <textarea name="description" id="description" class="validate[required]"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                    <select name="status" class="uniform" style="width:100%;">
                                    	<option value="resolved"><?php echo get_phrase('resolved');?></option>
                                    	<option value="unresolved"><?php echo get_phrase('unresolved');?></option>
                                    </select>
                                </div>
                            </div>
                           <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('option');?></label>
                                <div class="controls">
                                    <select name="option" class="uniform" style="width:100%;">
                                    	<option value="guilty"><?php echo get_phrase('guilty');?></option>
                                    	<option value="non guilty"><?php echo get_phrase('non guilty');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_general_complain');?></button>
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

 <script>
/*
	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/generalcomplain.pdf";
		  window.location = v;
 });
    });
	*/
	</script>
