<?php

	include realpath(".") . "/mydb.php";
	
	// Create Objects Of Required Classes
	$Db = NULL;
	$Db = new  DB();

		$advappointmentreport = $Db->getadvappointmentreport($_POST['post_doctorid'], $_POST['post_selected_date']);
		
		if (count($advappointmentreport) <= 0 )
		{
			echo  "<center><span style='color:red;font-size:20px;'>Advance Appointment Not Found</span></center>";
			return;	
		}
			
?>
				<!----TABLE LISTING STARTS--->
                
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="forpint11new">
            
          		 <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                                         <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Token No.</div></th>
                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
                                       <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Doctor Name</div></th>
                                            		
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date/Time</div></th>
	
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Phone</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Area</div></th>
                        <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Status</div></th>
						</tr>
					</thead>
                    <tbody>
					
				<?php $count= 1; 
				
				foreach($advappointmentreport as $row):
                        
						?>
                        
            		    <tr>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo ($count++);?></td>
                       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row['tokenno']; ?></td>
			            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row['patname']; ?></td>
                             <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row['docname']; ?></td>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row["appdate"]; ?></td>
					    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row['phone']; ?></td>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row['area']; ?></td>
                         <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><?php echo $row['status']; ?></td>
                        </tr>
                        
                         <?php
						
						endforeach;
						?>
                        
                </table></td></tr></tbody></table>
                
                <input type="button" class="btn btn-green" name="print" id="print" value="Print Report" onClick="forprintdiv()" />
                
   	   
               	      
 	      </div>
          
<script>
    
  function forprintdiv() 
    {
        
        var data1 = $('#forpint11new').html();
        var mywindow = window.open('', 'my div', 'height=600,width=1500');
        mywindow.document.write('<html><head><title>Advance Appointment Report</title>');
        mywindow.document.write('</head><body>');
        mywindow.document.write(data1);
        mywindow.document.write('</body></html>');

        mywindow.print();
       // mywindow.close();

        return true;
    }
    
    </script>

        