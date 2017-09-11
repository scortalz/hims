<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>  		
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_service');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('service_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_service');?>
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
                    
                    <?php echo form_open('reception/manage_service/edit/do_update/'.$row['service_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('service');?></label>
                                <div class="controls">
                                    <input type="text" name="service_name" id="service_name" value="<?php echo $row['service_name'];?>"/>
                                </div>
                            </div>
                        </div>
						 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('main category');?></label>
                                <div class="controls">
                                    <select name="maincategory" class="uniform" style="width:100%;">
                                    	<option value="X-RAY" <?php if($row['maincategory']=='X-RAY')echo 'selected';?>><?php echo get_phrase('X-RAY');?></option>
                                    	<option value="ULTRASOUND" <?php if($row['maincategory']=='ULTRASOUND')echo 'selected';?>><?php echo get_phrase('ULTRASOUND');?></option>
										<option value="LABORATORY" <?php if($row['maincategory']=='LABORATORY')echo 'selected';?>><?php echo get_phrase('LABORATORY');?></option>
                                    	<option value="EEG" <?php if($row['maincategory']=='EEG')echo 'selected';?>><?php echo get_phrase('EEG');?></option>
								<option value="ECHOCARDIOGRAPHY" <?php if($row['maincategory']=='ECHOCARDIOGRAPHY')echo 'selected';?>><?php echo get_phrase('ECHOCARDIOGRAPHY');?></option>
                                    	<option value="ECG" <?php if($row['maincategory']=='ECG')echo 'selected';?>><?php echo get_phrase('ECG');?></option>
                                    </select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('total amount');?></label>
                                <div class="controls">
                                    <input type="text" name="totalamount" id="totalamount" value="<?php echo $row['totalamount'];?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('share');?></label>
                                <div class="controls">
                                    <input type="text" name="share" id="share" value="<?php echo $row['share'];?>"/>
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_service');?></button>
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
                      <h1>Manage Service</h1></td>
                        </tr>
						<tr><td align="right" colspan="3">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Service</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Main Category</div></th>
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
							<th><div><?php echo get_phrase('service');?></div></th>
                            <th><div><?php echo get_phrase('main category');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($services as $row):
                 	     $rep_html .=' <tr>
                       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
                       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['service_name'].'</td>
					   <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['maincategory'].'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php $count = 1;foreach($services as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['service_name'];?></td>
                            <td><?php echo $row['maincategory'];?></td>
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
				
						file_put_contents("reports/service.pdf", $pdf);
						
				   ?>
             </div> 
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_service/create' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('service');?></label>
                                <div class="controls">
                                   <input type="text" class="validate[required]" name="service_name" id="service_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('main category');?></label>
                                <div class="controls">
                                   <select name="maincategory" class="uniform" style="width:100%;">
                                    	<option value="X-RAY"><?php echo get_phrase('X-RAY');?></option>
                                    	<option value="ULTRASOUND"><?php echo get_phrase('ULTRASOUND');?></option>
										<option value="LABORATORY"><?php echo get_phrase('LABORATORY');?></option>
                                    	<option value="EEG"><?php echo get_phrase('EEG');?></option>
										<option value="ECHOCARDIOGRAPHY"><?php echo get_phrase('ECHOCARDIOGRAPHY');?></option>
										<option value="ECG"><?php echo get_phrase('ECG');?></option>
                                    </select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('total amount');?></label>
                                <div class="controls">
                                   <input type="text" class="validate[required]" name="totalamount" id="totalamount">
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('share');?></label>
                                <div class="controls">
                                   <input type="text" class="validate[required]" name="share" id="share">
                                </div>
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('add_service');?></button>
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
		$("#service_name").bind("keypress", function (event) {
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

$("#totalamount").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  //alert(event.which);
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
   event.preventDefault();
  }
     });
	 
	 $("#share").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  //alert(event.which);
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
   event.preventDefault();
  }
     });
</script>

<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/service.pdf";
		  window.location = v;
 });
    });
	
	</script>