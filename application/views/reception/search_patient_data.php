<div class="tab-pane box  id="list">
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>Serial No.</div></th>
                    		<th><div><?php echo get_phrase('patient_reg_no.');?></div></th>
							<th><div><?php echo get_phrase('patient name');?></div></th>
                    		<!-- <th><div><?php echo get_phrase('doctor name');?></div></th> -->
                            <th><div><?php echo get_phrase('phone');?></div></th>
                             <th><div><?php echo get_phrase('patient_type');?></div></th>
                            
                             
                             <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                  
                        <?php 
					
						
						$count=1; 
                        ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $search_result->patient_reg_no;?></td>
							<td><?php echo $search_result->name?></td>
							<!-- <td><?php //echo $row['doctorname'];?></td> -->
							<td><?php echo $search_result->phone;?></td>    
                	        <td><?php echo $search_result->patient_type;?></td>
               			
                        	<!-- <td><?php //echo $Bed;?></td>    -->
                            
							<td align="center">
                            <a href="<?php echo base_url();?>index.php?reception/manage_patient/edit/<?php echo $search_result->patient_id;?>"
                                	rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit');?>" class="btn btn-blue">
                                		<i class="icon-wrench"></i>
                                </a>
                            	<a href="<?php echo base_url();?>index.php?reception/manage_invoice/"
                                rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('invoice');?>" class="btn btn-blue">
                                		<i class="iconinvoice"></i>
                                </a>
        					</td>
                        </tr>
                        <?php ?>
                    </tbody>
                </table>
                
               
             </div> 
             <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                        
              
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" id="table2">
                    <thead>
                      
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
                    
                        
                     <?php
                     
                  
                     
                       $count = 1;
                       if(isset($invoice_data)){ ?>
                        <tr>
                           <td><?php echo  $count;?></td>
                           <td><?php echo  $invoice_data->invoice_number;?></td>
                           <td><?php echo  $invoice_data->totalamount;?></td>
                           <td><?php echo  $search_result->name;?></td>
                           <td><?php echo   $search_result->phone;?></td>
                           <td><?php echo   $doctor_id->name;?></td> 
                           <td><?php echo $invoice_data->creation_time;?></td>
                           <td><?php $ans=$invoice_data->invoice_number;?>
                             <a href="<?php echo base_url().'index.php?reception/manage_invoice_report/'.$invoice_data->invoice_number ?>" target="_blank" 
                               rel="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('print invoice');?>" class="btn btn-red" </td>
                               <i class="icon-print"></i> </a>
                                                      
                             
                                    
                                 </tr>
                     <?php }
                     else {
                        echo "<tr><td><td><td><td><td><td>No Result Found</td></td></td></td></td></td></tr>";
                        echo "<script>$('#table2').hide();</script>";
                        }?>
                    </tbody>
                </table>
               
                      
             </div> 