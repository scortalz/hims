<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
	<?php /*?>	<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_doctor_payment_voucher');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('doctor_payment_voucher_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_approved_discount');?>
                    	</a></li><?php */?>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
        	
            <!----EDITING FORM ENDS--->
            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                                    
             <?php $rep_html =' <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
					<tr>
                        <td colspan="6" align="right">
                <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
						<tr>
                        <td align="center"  colspan="6">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="6">
                      <h1>Doctor Payment Voucher</h1></td>
                        </tr>
						<tr><td align="right" colspan="6">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date/Time</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Amount</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Share</div></th>	
						</tr>
					</thead>
                    <tbody>';
                      ?>
                      
                       <?php
				     		   $count = 1; 
							$Total_Received_Amount = 0;
							$Share_Amount = 0 ;
							$Total_Shared_Amount = 0;
							for($i=0;$i<count($invoices); $i++)
							{
								$Total_Received_Amount += $invoices[$i]['recievedamount'];
								$Share_Amount = (($invoices[$i]['recievedamount'] * 70 ) / 100);
								$Total_Shared_Amount += $Share_Amount;
								
                  			$rep_html .='     <tr>
                      <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
					  <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $this->crud_model->get_type_name_by_id('doctor',$invoices[$i]['doctor_id'],'name').'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y', $invoices[$i]['creation_timestamp']).'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$this->crud_model->get_type_name_by_id('patient',$invoices[$i]['patient_id'],'name').'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;" >'.number_format($invoices[$i]['recievedamount'], 0).'</td>
                    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;" >'.number_format((($invoices[$i]['recievedamount'] * 70 ) / 100), 0).'</td>
                        </tr>';
                      
           					   }
							   ?>
						
						<?php
					
							/*$rep_html .= '<tr>
							<td colspan="3">
							<div style="float: right;margin:10px;">
							<input style="width:220px;height:40px;" type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" />
							</div>
							</td>
							</tr>';*/

                			$rep_html .= '</tbody></table></div>';
				   			echo $rep_html;
							
							
							  $rep_html .=' <table  align="right" >';
                
							$rep_html .=' 	
							<tr > 
							<td colspan="4"> <br/> </td>
						  </tr>	
						   <tr style="background:#3A6EA5; height:40px;"> 
							<td style="width:20%; color:#fff;" colspan="5"> Grand Total: </td>
							<td style="width:35%; color:#fff;text-align:right;"> '. number_format($Total_Received_Amount, 0).'</td>
							<td style="width:35%; color:#fff;text-align:right;"> '. number_format($Total_Shared_Amount, 0).'</td>
						  </tr>';
						
							$dompdf = new DOMPDF();
							$dompdf->load_html($rep_html);

							   $dompdf->render();
	
							  // The next call will store the entire PDF as a string in $pdf
							  $pdf = $dompdf->output();
	
							  // write $pdf to disk, store it in a database or stream it
							  // to the client.
					
							 file_put_contents("reports/doctorpaymentvoucher.pdf", $pdf);
				  			 ?>
							<table  align="right" >
							<tr style="background:#3A6EA5; height:40px;"> 
							<td style="width:20%; color:#fff;" colspan="2"> Grand Total: </td>
							<td style="width:20%; color:#fff;text-align:right;"></th><?php echo  number_format($Total_Received_Amount, 0);?></td>
							<td style="width:20%; color:#fff;text-align:right;"><?php echo number_format($Total_Shared_Amount, 0);?></td>
						  </tr>
							</table>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>

<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
		  var v = "reports/doctorpaymentvoucher.pdf";
		  window.location = v;
		  
 });
    });
	
	</script>
