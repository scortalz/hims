<div class="tab-pane box  id="list">
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<!-- <th><div>Serial No.</div></th> -->
                    		<th><div><?php echo get_phrase('appointment_id.');?></div></th>
							<th><div><?php echo get_phrase('appointment_timestamp');?></div></th>
                    		 <th><div><?php echo get_phrase('doctor_id');?></div></th> 
                            <th><div><?php echo get_phrase('patient_id');?></div></th>
                             
                            
                             
                             <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                  
                        <?php 
					
						
						$count=1; 
                        ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $search_result->appointment_id;?></td>
							<td><?php echo $search_result->appointment_timestamp?></td>
                            <td><?php echo $search_result->doctor_id?></td>
							<!-- <td><?php //echo $row['doctorname'];?></td> -->
                            <td><?php echo $search_result->patient_id?></td>
							


               			
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