<?php 
//echo realpath(".");
	include   realpath(".") . "/application/helpers/mydb.php";
	$db = NULL;
	$db = new DB();
	
	// Call db->method to generate patient registration number
	$arrRegNo = $db->Generate_Invoice_Number();

	$id = $arrRegNo[0]['invoice_id'] + 1;	
	$gen_inv_no = 'R-'.date('dmHi-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);

	$current_date = date('m/d/Y H:i', time());
?>
<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>	
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_invoice');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('invoice_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_invoice');?>
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
                    
                    <?php echo form_open('reception/manage_invoice/edit/do_update/'.$row['invoice_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="patient_id">
										<?php 
										$this->db->order_by('account_opening_timestamp' , 'asc');
										$patients	=	$this->db->get('patient')->result_array();
										foreach($patients as $row2):
										?>
                                        	<option value="<?php echo $row2['patient_id'];?>" <?php if($row2['patient_id']==$row['patient_id'])echo 'selected';?>>
												<?php echo $row2['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('doctor');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="doctor_id" id="doctor_id">
										<?php 
										//$this->db->order_by('account_opening_timestamp' , 'asc');
										$doctors	=	$this->db->get('doctor')->result_array();
										foreach($doctors as $row2):
										?>
                                        	<option value="<?php echo $row2['doctor_id'];?>" <?php if($row2['doctor_id']==$row['doctor_id'])echo 'selected';?>>
												<?php echo $row2['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                      <?php /*?>    <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reffered by');?></label>
                                <div class="controls">
								<select name="refferedby" id="refferedby" class="chzn-select" >
                              	<option value="RMC" <?php if($row['refferedby']=='RMC')echo 'selected';?>><?php echo get_phrase('RMC');?></option>
                               <option value="CardNo" <?php if($row['refferedby']=='CardNo')echo 'selected';?>><?php echo get_phrase('CardNo');?></option>
							<option value="OtherEntry" <?php if($row['refferedby']=='OtherEntry')echo 'selected';?>><?php echo get_phrase('OtherEntry');?></option>
							<option value="sameabove" <?php if($row['refferedby']=='sameabove')echo 'selected';?>><?php echo get_phrase('sameabove');?></option>
									</select>
			<input type="text"   name="med_card_no" id="med_card_no" value="<?php echo $row['med_card_no'];?>" style="width:13%"  />
			<input type="checkbox" name="sameasabove" id="sameasabove" /><span style="vertical-align:middle">&nbsp;Same as above</span>
								
                                </div>
                            </div><?php */?>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('total amount');?></label>
                                <div class="controls">
                             <input type="text" name="totalamount" id="totalamount" value="<?php echo $row['totalamount'];?>"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount amount');?></label>
                                <div class="controls">
                                 <input type="text" name="discountamount" id="discountamount" value="<?php echo $row['discountamount'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount (%)');?></label>
                                <div class="controls">
                                    <input type="text" name="discount" id="discount" value="<?php echo $row['discount'];?>"/>
                                </div>
                            </div>
							   <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('recieved amount');?></label>
                                <div class="controls">
                                    <input type="text" name="recievedamount" id="recievedamount" value="<?php echo $row['recievedamount'];?>"/>
                                </div>
                            </div>
							  <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('due amount');?></label>
                                <div class="controls">
                                    <input type="text" name="dueamount" id="dueamount" value="<?php echo $row['dueamount'];?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('care of');?></label>
                                <div class="controls">
                                    <input type="text" name="careof" id="careof" value="<?php echo $row['careof'];?>"/>
                                </div>
                            </div>
							<!--<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="creation_timestamp" value="<?php echo $row['creation_timestamp'];?>"/>
                                </div>
                            </div>-->
                           <?php /*?> <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                    <div class="box closable-chat-box">
                                        <div class="box-content padded">
                                                <div class="chat-message-box">
                                                <textarea name="description" id="ttt" rows="5" placeholder="<?php echo get_phrase('add_description');?>"><?php echo $row['description'];?></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                    <select name="status" class="uniform">
                                       	<option value="paid" <?php if($row['status']=='paid')echo 'selected';?>><?php echo get_phrase('paid');?></option>
                                       	<option value="unpaid" <?php if($row['status']=='unpaid')echo 'selected';?>><?php echo get_phrase('unpaid');?></option>
									</select>
                                </div>
                            </div>
                        </div><?php */?>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue"><?php echo get_phrase('edit_invoice');?></button>
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
                        <td align="center"  colspan="7">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="7">
                      <h1>Manage Invoice</h1></td>
                        </tr>
						<tr><td align="right" colspan="7">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Invoice Number</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Amount</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Phone Number</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor</div></th>
                    <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="8" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
                            <th><div><?php echo get_phrase('invoice number');?></div></th>
                            <th><div><?php echo get_phrase('amount');?></div></th>
                            <th><div><?php echo get_phrase('patient');?></div></th>
                            <th><div><?php echo get_phrase('phone number');?></div></th>
                             <th><div><?php echo get_phrase('doctor');?></div></th>
                              <th><div><?php echo get_phrase('date');?></div></th>
                               <th><div><?php echo get_phrase('Print');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($invoices as $row):
                 	   $rep_html .=' <tr>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['invoice_number'].'</td>
                    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['totalamount'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name').'</td>
				<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'phone').'</td>
			<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name').'</td>
          <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. date('m/d/Y', $row['creation_timestamp']).'</td>
                        </tr>';
						        endforeach;
                        ?>
                        
                     <?php  $count = 1;foreach($invoices as $row):?>
                        <tr>
                           <td><?php echo  $count++;?></td>
                           <td><?php echo  $row['invoice_number'];?></td>
                           <td><?php echo  $row['totalamount'];?></td>
                           <td><?php echo  $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name');?></td>
                          <td><?php echo   $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'phone');?></td>
                           <td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>
                           <td><?php echo date('m/d/Y', $row['creation_timestamp']);?></td>
                           <td>
                             <a href="javascript:" onclick="printinvoce('<?php echo  $row['invoice_number'];?>')"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print invoice');?>" class="btn btn-red">
                               <i class="icon-print"></i>
                                </a>
                           <!--discount start-->
                             <?php /*?>      <?php if($row['discount']>=10 && $row['approved']==1)
						   {?>
                           <a href="javascript:" onclick="printinvoce('<?php echo  $row['invoice_number'];?>')"
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print invoice');?>" class="btn btn-red">
                               	<i class="icon-wrench"></i>
                                </a>
                                <?php } 
							   else if($row['discount'] <=10 )
							   {  
							   ?>
					      <a href="javascript:" onclick="printinvoce('<?php echo  $row['invoice_number'];?>')"
                       rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print invoice');?>" class="btn btn-red">
                         	<i class="icon-wrench"></i>
                                </a>
									<?php 
									}
								    ?><?php */?>
                                  
                                    <!--discount end-->
                                    
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
				
						file_put_contents("reports/manageinvoice.pdf", $pdf);
						
				   ?>
             </div> 
             
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('reception/manage_invoice/create' , array('class' => 'form-horizontal validatable'));?>
                    <input type="hidden"  name="createdby" id="createdby" readonly="readonly" value="<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>"/>
                        <div class="padded">
                        <input type="hidden" id="conDisc" name="conDisc" value="0" />
                        <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('invoice_no');?></label>
                                <div class="controls">
                                    <input type="text"  name="invoice_no" id="invoice_no" readonly="readonly" value="<?php echo $gen_inv_no; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('patient');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="patient_id" id="patient_id" tabindex="1" style="width:215px;">
										<?php 
										$this->db->order_by('account_opening_timestamp' , 'asc');
										$patients	=	$this->db->get('patient')->result_array();
										foreach($patients as $row):
										?>
                                       <option value="<?php echo $row['patient_id'];?>"><?php echo $row['patient_reg_no']. ' - ( ' . $row['name']. ' - ' . $row['phone']. ')';?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
							 <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Check Box');?></label>
                                <div class="controls">
                                   <input type="radio" name="radio" id="con" value = "C" checked="checked" tabindex="2"/>&nbsp;Consultation
								   <input type="radio" name="radio" id="dia" value="D" tabindex="3" />&nbsp;Diagnostic
                                </div>
                            </div>
							  <div class="control-group" id="doctors">
                                <label class="control-label"><?php echo get_phrase('doctor');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="doctor_id" id="doctor_id"  style="display:none" tabindex="4" >
										<?php 
										//$this->db->order_by('account_opening_timestamp' , 'asc');
										$doctors	=	$this->db->get('doctor')->result_array();
										?>
										<option value="-1">------ Select Doctor ------ </option>
										<?php
										foreach($doctors as $row):
										?>
                                        	<option value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div>
                            <div class="control-group"  id="category" style="display:none;">
                                <label class="control-label"><?php echo get_phrase('Category');?></label>
                                <div class="controls">
                                    <select name="diagnostictype_id" id="diagnostictype_id" class="chzn-select" />
                                     <?php 
										//$this->db->order_by('name' , 'asc');
										$diagnostictypes	=	$this->db->get('diagnostictype')->result_array();
										?>
										<option value="-1">------ Select Category ------ </option>
										<?php
										foreach($diagnostictypes as $row):
										
									?>
                                        	<option value="<?php echo $row['diagnostictype_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                   <div id="invoice_services" name="invoice_services">&nbsp;</div>
                                </div>
                            </div>
							  <?php /*?><div class="control-group"  id="services" style="display:none;">
                                <label class="control-label"><?php echo get_phrase('service');?></label>
                                <div class="controls">
                                    <select class="chzn-select" name="service_id" id="service_id"  style="display:none"  tabindex="5"/>
										<?php 
										//$this->db->order_by('account_opening_timestamp' , 'asc');
										$services	=	$this->db->get('service')->result_array();
										foreach($services as $row):
										?>
                                        	<option value="<?php echo $row['service_id'];?>"><?php echo $row['service_name'];?></option>
                                        <?php
										endforeach;
										?>
									</select>
                                </div>
                            </div><?php */?>
							<?php /*?><div class="control-group">
                                <label class="control-label"><?php echo get_phrase('reffered by');?></label>
                                <div class="controls">
                                <select name="refferedby" id="refferedby" class="chzn-select"  >
                                    	<option id="RMC" value="RMC"><?php echo get_phrase('RMC');?></option>
                                    	<option id="CardNo"  value="CardNo"><?php echo get_phrase('CardNo');?></option>
										<option id="OtherEntry" value="OtherEntry"><?php echo get_phrase('OtherEntry');?></option>
										<option id="sameabove" value="sameabove"><?php echo get_phrase('sameabove');?></option>
                                    </select>
                                   <!--<input type="text" class="validate[required]" name="refferedby" id="refferedby" value="" tabindex="6"/>-->
                <input type="text"   name="med_card_no" id="med_card_no" style="display:none;width:13%" />
         <input type="checkbox" name="sameasabove" id="sameasabove" /><span id="labelsameabove" style="vertical-align:middle">&nbsp;Same As Above</span>
                                </div>
                            </div><?php */?>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('total amount');?></label>
                                <div class="controls">
                                <input type="text" name="totalamount"  class="validate[required]" value="" id="totalamount" readonly="readonly" tabindex="7"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount amount');?></label>
                                <div class="controls">
                                    <input type="text" name="discountamount" id="discountamount" maxlength="3" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('discount (%)');?></label>
                                <div class="controls">
                                    <input type="text" name="discount" id="discount" tabindex="8" maxlength="3" value="0"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('recieved amount');?></label>
                                <div class="controls">
                                    <input type="text" name="recievedamount" class="validate[required]" value="" id="recievedamount" tabindex="9"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('due amount');?></label>
                                <div class="controls">
                                    <input type="text" name="dueamount" id="dueamount" class="validate[required]"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Care of');?></label>
                                <div class="controls">
                                    <input type="text" name="careof" id="careof"  class="validate[required]" tabindex="9"/>
									<input type="checkbox" name="myself" id="myself" /><span style="vertical-align:middle">&nbsp;Myself</span>
                                </div>
                            </div>
							
                           <?php /*?> <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                    <div class="box closable-chat-box">
                                        <div class="box-content padded">
                                                <div class="chat-message-box">
                                                <textarea name="description" id="ttt" rows="5" placeholder="<?php echo get_phrase('add_description');?>"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div><?php */?>
							<!--<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="creation_timestamp" value=""/>
                                </div>
                            </div>-->
                            <?php /*?><div class="control-group">
                                <label class="control-label"><?php echo get_phrase('status');?></label>
                                <div class="controls">
                                    <select name="status" class="uniform">
                                       	<option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                       	<option value="paid"><?php echo get_phrase('paid');?></option>
									</select>
                                </div>
                            </div>
                        </div><?php */?>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-blue" id="save_invoice" name="save_invoice"><?php echo get_phrase('save_invoice');?></button>
                            
                        </div>
                    <?php echo form_close();?>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            <div id="result"></div> 
		</div>
	</div>
</div>

<script language="javascript">

$(document).ready(function(e) {
	
     $('#sameasabove').hide('slow');
 	 $('#labelsameabove').hide('slow');	
	
	$('input').keypress(function(e) {
        if(e.which == 13) 
		{
            jQuery(this).blur();
            //jQuery('#btnSearch').focus().click();
       	}
    });
	
	// When-Changed-StorageSize
	jQuery("select[name='service_id']").change(function()
	{     
		jQuery("#totalamount").val('');
	
		var service_id = jQuery("select[name='service_id']").val();
		//alert(service_id);
		//alert("<?php //echo realpath ("."); ?> ");
		
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getserviceprice.php",
		data: ({post_service_id: service_id}),
			success: function(response)	
			{
				//alert(response);
				if (response > 0)
				{
					jQuery("#totalamount").val(response);
				}
				else
				{
					alert('Selected service rate is set to 0, please assign rate');				
				}
				jQuery("#serviceprice").focus();
			}
		});	
 	});
	
	// Call Doctor Rate
	// When-Changed-StorageSize
	jQuery("select[name='doctor_id']").change(function()
	{     
		jQuery("#totalamount").val('');
		jQuery("#discountamount").val('');
		jQuery("#discount").val('');
		jQuery("#recievedamount").val('');
		jQuery("#dueamount").val('');
		var doctor_id = jQuery("select[name='doctor_id']").val();
		//alert(service_id);
		//alert("<?php //echo realpath ("."); ?> ");
		if (doctor_id == "-1")
		{
			return false;
		}
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/getdoctorrate.php",
		data: ({post_doctor_id: doctor_id}),
			success: function(response)	
			{
				//alert(response);
				if (response > 0)
				{
					jQuery("#totalamount").val(response);
				}
				else
				{
					alert('Selected service rate is set to 0, please assign rate');				
				}
				jQuery("#serviceprice").focus();
			}
		});	
 	});
	
	
   $('#dia').click (function () {
		if ($('#dia').is(':checked') && $('#dia').val() == 'D') 
		{
			$('#category').show('slow');
			$('#services').show('slow');
			$('#doctors').hide('slow');
			$('#totalamount').val('');
			$('#discountamount').val('');
			$('#discount').val('');
			$('#recievedamount').val('');
			$('#dueamount').val('');
		}
	});
	$('#con').click (function () {
		if ($('#con').is(':checked') && $('#con').val() == 'C') 
		{
			$('#category').hide('slow');
			$('#services').hide('slow');
			$('#doctors').show('slow');
			$('#totalamount').val('');
			$('#discountamount').val('');
			$('#discount').val('');
			$('#recievedamount').val('');
			$('#dueamount').val('');
			
		}	
	});
	
	$('#discount').blur(function(){
		
		var discount = $('#discount').val();
		var totalamount = $('#totalamount').val();
		var invoice_no = $('#invoice_no').val();
		var createdby = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
		if (discount > 100 )
		{
			alert('You did not post discount above 100%');
			$(this).focus();
			return false;
		}
		
		/*if (discount > 0 && discount <= 10 )
		{
			alert('Please notify discount % to SuperUser');
			
		}*/
		/*if (discount > 10)
		{
			//alert('You have no authority to give discount more than 10%, please get approval from Super Administrator');
			
			var confirmLeave = confirm('You have no authority to give discount more than 10%, please get approval from Super Administrator');
			if (confirmLeave==false)
			{
				$('#ajaxLoaderDone').hide();
				$('#discount').focus();
				return false;
			}
			$('#conDisc').val('1');
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url();?>/application/helpers/getApprovalForDiscount.php",
				data: ({post_invoice_no: invoice_no, post_discount_per: discount,  post_createdby : createdby, post_invoice_amount : totalamount}),
				success: function(response)	
				{
					alert(response);
					return false;
					if (response > 0)
					{
						jQuery("#totalamount").val(response);
					}
					else
					{
						alert('Selected service rate is set to 0, please assign rate');				
					}
					jQuery("#serviceprice").focus();
				}
			});	
		}*/
		
		var lessdiscount = ( ( totalamount * discount ) / 100 );
		$('#discountamount').val(lessdiscount);
		$('#recievedamount').val( totalamount - lessdiscount );
	});
	
	// Discount Amount Calculation
		$('#discountamount').blur(function(){
		
		var discountamount = $('#discountamount').val();
		var totalamount = $('#totalamount').val();
		//var invoice_no = $('#invoice_no').val();
		var createdby = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
		
		var lessdiscountper = ( ( discountamount / totalamount ) * 100);
		//alert(lessdiscountper);
		$('#discount').val( lessdiscountper );
		
		//$('#recievedamount').val( totalamount - lessdiscount );
	});
	
	$('#recievedamount').blur(function(){
		
		var totalamount = $('#totalamount').val();
		var receivedamount = $('#recievedamount').val();
		var discount = $('#discount').val();
		
		var lessdiscount = ( ( totalamount * discount ) / 100 );
		
		var dueamount = (totalamount - lessdiscount) - receivedamount;
		
		$('#dueamount').val(dueamount);
		
	});	
	
	//$('#myself').click(function(){
	//	var myself = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
	//	$('#myself').val(myself);
	//});	
	$("#myself").click(function() {
		if($('#myself').is(":checked"))
		{
			var myself = "<?php echo $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id) , 'name'); ?>";
			$('#careof').val(myself);
		}
		else
		{
			$('input[name=myself]').attr('checked', false);
			$("#careof").val('');
			$("#careof").focus();
		}
	});
	
	$("#sameasabove").click(function() {
		if($('#sameasabove').is(":checked"))
		{
			var referredby = $('#doctor_id :selected').text();
			$('#refferedby').val(referredby);
		}
		else
		{
			$('input[name=sameasabove]').attr('checked', false);
			$("#refferedby").val('');
			$("#refferedby").focus();
		}
	});
	
	$("#save_invoice").click(function() {

	//alert('abcd');
	//return;
		//$('#btnprint').show();
		var discount = $('#discount').val();
		var totalamount = $('#totalamount').val();
		//alert(discount);
		$(this).attr('disabled', true);
		if (discount >= 100 )
		{
			alert('You did not post discount 100% or above');
			$('#discount').focus();
			return false;
			
		}
		var invoice_id = $('#invoice_no').val();
		//alert(invoice_id);
		//$(location).attr('href',"application/helpers/viewreceipt.php?r="+invoice_id);
	});
	
	
	 $("#discount").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     	$(this).val($(this).val().replace(/[^0-9\.]/g,''));
		//alert(event.which);
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 8 || event.which > 8)) {
			event.preventDefault();
		}
     });

	$("#discount").keydown(function(event) {
		//alert(event.keyCode);
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 110 || event.keyCode == 190) {
            
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || event.shiftKey) {
                event.preventDefault(); 
            }   
        }
    });
	
	$("#recievedamount").keydown(function(event) {
		//alert(event.keyCode);
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 36 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40 || event.keyCode == 110 || event.keyCode == 190) {
            
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || event.shiftKey) {
                event.preventDefault(); 
            }   
        }
    });
	
	// Validate only alphabets input on ReferredBy field
	$("#refferedby").keypress(function(e) {
    	if((e.which < 97 || e.which > 122) && (e.which < 65 || e.which > 97) && (e.which < 32 || e.which > 32) && (e.which < 8 || e.which > 8) && (e.which < 0 || e.which > 0) )   {
        	e.preventDefault();
    	}
		if (e.which == 94 || e.which == 95) 
		{
			return false;
		}
	});
	
	// Validate only alphabets input on CareOf field
	$("#careof").keypress(function(e) {
    	if((e.which < 97 || e.which > 122) && (e.which < 65 || e.which > 97) && (e.which < 32 || e.which > 32) && (e.which < 8 || e.which > 8) && (e.which < 0 || e.which > 0) )   {
        	e.preventDefault();
    	}
		if (e.which == 94 || e.which == 95) 
		{
			return false;
		}
	});
	
	
	
	// Only for Integer values
	/*
	 $(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
	*/
});

</script>

<script>
// Reffered by onchange

		$('#refferedby').change (function () {
		
		var s = $('#refferedby').val();
		if (s == 'CardNo')
		{
			$('#med_card_no').val('');
			$('#sameasabove').hide('slow');
			$('#labelsameabove').hide('slow');
			$('#med_card_no').show('slow');
			$("#med_card_no").attr("required", "required");
			$("#med_card_no").focus();
		}
		else if (s == 'OtherEntry')
		{
			$('#med_card_no').val('');
			$('#sameasabove').hide('slow');
			$('#labelsameabove').hide('slow');
			$('#med_card_no').show('slow');
			$("#med_card_no").attr("required", "required");
			$("#med_card_no").focus();
		}
		else if (s == 'sameabove')
		{
			$('#med_card_no').val('');
			$('#sameasabove').show('slow');
			$('#labelsameabove').show('slow');
			$('#med_card_no').show('slow');
			$("#med_card_no").attr("required", "required");
			$("#med_card_no").focus();
		}
		else
		{
			$('#med_card_no').val('');
			$('#sameasabove').hide('slow');
			$('#labelsameabove').hide('slow');
			$('#med_card_no').hide('slow');
		//	$("#med_card_no").attr("required", false);
			$("#med_card_no").focus();
		
		}
		
		$("#sameasabove").click(function() {
		if($('#sameasabove').is(":checked"))
		{
			var referredby = $('#doctor_id :selected').text();
			$('#med_card_no').val(referredby);
		}
		else
		{
			//$("#refferedby").val('');
			//$("#refferedby").focus();
			$('#med_card_no').val('');
		}
	});
			
	});

</script>

 <script>
 
	$(document).ready(function(e) {
			
        $('#btnReport').click(function () {
  
		  var v = "reports/manageinvoice.pdf";
		  window.location = v;
 		});
		
		
		$('#diagnostictype_id').change (function () {
						
			var did = $('#diagnostictype_id').val();
			
			jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/invoice_services_data.php",
			data: ({post_did: did}),
			success: function(response)	
			{
				
				//alert(response);
				$('#invoice_services').html(response);
				
					$('#selected_services').change( function()
					{     
						//alert('asdasd');
						jQuery("#totalamount").val('');
					
						var selected_services = $('#selected_services').val();
							
						jQuery.ajax({
						type: "POST",
						url: "<?php echo base_url();?>/application/helpers/getServicePriceDiag.php",
						data: ({post_service_id: selected_services}),
							success: function(response)	
							{
								//alert(response);
								if (response > 0)
								{
									jQuery("#totalamount").val(response);
								}
								else
								{
									alert('Selected service rate is set to 0, please assign rate');				
								}
								jQuery("#serviceprice").focus();
							}
						});	
					});
	
	
			} // success: function(response)	
		 });
    });
});
</script>

	<script>
	//$("#print invoice").click(function() 
//	{
	function printinvoce(inv_id)
	{
		//var inv_id = $('#invoice_no').val();
		//alert(inv_id);
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url();?>/application/helpers/getsingleinvprint.php?r="+inv_id,
			//data: ({inv_idd: inv_id}),
			success: function(response)	
			{
			//	alert(response)
				
				 var mywindow = window.open('', 'my div', 'height=1000,width=1200,scrollbars=1');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

      //  mywindow.print();
        //mywindow.close();


			}
		});	
	}
 	
</script>


<script>
	// When-Changed-StorageSize
	jQuery("#invoice_services").change(function()
	{     
		jQuery("#discountamount").val('');
		jQuery("#discount").val('');
		jQuery("#recievedamount").val('');
		jQuery("#dueamount").val('');
	
 	});

</script>
