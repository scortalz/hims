<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?> 
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_diagnosticservice');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('diagnostic_service_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_diagnostic_service');?>
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
                    
                    <?php echo form_open('reception/diagnostic_service/edit/do_update/'.$row['diagnosticservice_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                        <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('title');?></label>
                                <div class="controls">
                                   <input type="text" name="title" id="title" value="<?php echo $row['title'];?>"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('service name');?></label>
                                <div class="controls">
                                   <input type="text" name="name" id="name" value="<?php echo $row['name'];?>"/> 
                                </div>
                            </div>
							  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('corporate charges');?></label>
                                <div class="controls">
                                   <input type="text" name="corporatecharges" id="corporatecharges" value="<?php echo $row['corporatecharges'];?>"/>
                                </div>
                            </div>
                           
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_diagonosticservice');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
					</div>
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
                      <h1>Diagnostic Service</h1></td>
                        </tr>
						<tr><td align="right" colspan="4">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Title</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Service Name</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Corporate Charges</div></th>
						
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
							<th><div><?php echo get_phrase('title');?></div></th>
                            <th><div><?php echo get_phrase('service name');?></div></th>
                            <th><div><?php echo get_phrase('corporate charges');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($diagnosticservices as $row):
                 	     $rep_html .=' <tr>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
                            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('diagnostictype',$row['diagnostictype_id'],'name').'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
							<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['corporatecharges'].'</td>
						
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($diagnosticservices as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('diagnostictype',$row['diagnostictype_id'],'name');?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['corporatecharges'];?></td>
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
				
						file_put_contents("reports/diagnosticservice.pdf", $pdf);
						
				   ?>
             </div> 
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/diagnostic_service/create' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                         <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('title');?></label>
                                <div class="controls">
                              <select class="chzn-select" name="diagnostictype_id" id="diagnostictype_id">
										<?php 
										$diagnostictypes	=	$this->db->get('diagnostictype')->result_array();
										foreach($diagnostictypes as $row):
										?>
                                        	<option value="<?php echo $row['diagnostictype_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                              <?php /*?>     <input type="text" name="title" id="title" /> <?php */?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('service name');?></label>
                                <div class="controls">
                                   <input type="text" class="validate[required]" name="name" id="name"/>
                                </div>
                            </div>
							  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('corporate charges');?></label>
                                <div class="controls">
                                  <input type="text" class="validate[required]" name="corporatecharges" id="corporatecharges" maxlength="7"/>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_diagonosticservice');?></button>
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
 $("#corporatecharges").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  //alert(event.which);
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
   event.preventDefault();
  }
  
      });
*/
</script>

<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/diagnosticservice.pdf";
		  window.location = v;
 });
    });
	
	</script>