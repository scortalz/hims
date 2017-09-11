<?php 
 include   realpath(".") . "/application/helpers/mydb.php";
 $db = NULL;
 $db = new DB();
 
 // Call db->method to generate patient registration number
 $arrRegNo = $db->Generate_Patient_Registration_Number();

 $id = $arrRegNo[0]['patient_id'] + 1; 
 $gen_reg_no = 'MR-'.date('ym-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);

 $current_date = date('m/d/Y H(idea)', time());
?>

<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery-ui.js"></script>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>-->

<?php include realpath(".") .  "/application/dompdf/dompdf_config.inc.php";?>
     <div class="box" >
	<div class="box-header">
     
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        	<?php if(isset($edit_profile)):?>
			<li class="active">
            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
					<?php echo get_phrase('edit_patient');?>
                    	</a></li>
            <?php endif;?>
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('discharge_patient_list');?>
                    	</a></li>
			
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>

            <!----TABLE LISTING STARTS--->
             <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                          
				<?php $rep_html ='     <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
    				<tr>
                        <td align="center"  colspan="7">
                      	<h1><img src="application/helpers/img/logo.PNG" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="7">
                      <h1>Manage Patient</h1></td>
                        </tr>
						<tr><td align="right" colspan="7">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
                      <th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Reg No.</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
					
						
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discharge Date/Time</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Age</div></th>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Sex</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discharge Type</div></th>
						</tr>
					</thead>
                    <tbody>';
				
                ?>
                
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                      <tr>
                        <td colspan="7" align="right">
                       <input type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" /></td>
                        </tr>
                		<tr>
                    		<th><div>Serial No.</div></th>
                    		<th><div><?php echo get_phrase('patient_reg_no.');?></div></th>
							<th><div><?php echo get_phrase('patient name');?></div></th>
                            <th><div><?php echo get_phrase('discharge_date/Time');?></div></th>
                             <th><div><?php echo get_phrase('age');?></div></th>
                             <th><div><?php echo get_phrase('sex');?></div></th>
                             <th><div><?php echo get_phrase('discharge_type');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($patients as $row):
                         if ($row['discharge_type']=='normal')
 					  {
						  
                         $rep_html .=' <tr>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_reg_no'].'</td>
					 <td style="color:green;font-weight:bold;text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
				
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">
					'.$row['discharge_date'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['age'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['sex'].'</td>
					<td style="color:green;font-weight:bold;text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">
					'.$row['discharge_type'].'</td>';
					   } ?>
                       
                           </tr>
                       <?php  if ($row['discharge_type']=='lama')
 					  {
						  
                         $rep_html .=' <tr>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_reg_no'].'</td>
					 <td style="color:red;font-weight:bold;text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
				
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">
					'.$row['discharge_date'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['age'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['sex'].'</td>
					<td style="color:red;font-weight:bold;text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">
					'.$row['discharge_type'].'</td>';
					   } ?>
                       
                           </tr>
                       <?php       if ($row['discharge_type']=='death')
 					  {
						  
                         $rep_html .=' <tr>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"> '.($count++).'</td>
                     <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_reg_no'].'</td>
					 <td style="color:orange;font-weight:bold;text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
				
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">
					'.$row['discharge_date'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['age'].'</td>
					<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $row['sex'].'</td>
					<td style="color:orange;font-weight:bold;text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">
					'.$row['discharge_type'].'</td>';
					   } ?>
                       
                           </tr>
                           <?php
						        endforeach;
                        ?>
                        <?php $count = 1;foreach($patients as $row):?>
                         <?php 
						// if ($row['patient_type']=='IPD' )
						 if ($row['discharge_type']=='normal')
 					  {
						  ?>
                        <tr>
                            
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['patient_reg_no'];?></td>
							<td style="color:rgb(55,158,196);font-weight:bold"><?php echo $row['name'];?></td>
							<td><?php echo $row['discharge_date']?></td>
							<td><?php echo $row['age'];?></td>
							<td><?php echo $row['sex'];?></td>           
                			<td style="color:rgb(55,158,196);font-weight:bold"><?php echo $row['discharge_type'];?></td>
                           <?php
						    }
						  ?>
                          <?php if ($row['discharge_type']=='lama')
 					  {
						  ?>
                        <tr>
                            
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['patient_reg_no'];?></td>
							<td style="color:red;font-weight:bold"><?php echo $row['name'];?></td>
							<td><?php echo $row['discharge_date']?></td>
							<td><?php echo $row['age'];?></td>
							<td><?php echo $row['sex'];?></td>           
                			<td style="color:red;font-weight:bold"><?php echo $row['discharge_type'];?></td>
                           <?php
						    }
						  ?>
                             <?php if ($row['discharge_type']=='death')
 					  {
						  ?>
                        <tr>
                            
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['patient_reg_no'];?></td>
							<td style="color:orange;font-weight:bold"><?php echo $row['name'];?></td>
							<td><?php echo $row['discharge_date']?></td>
							<td><?php echo $row['age'];?></td>
							<td><?php echo $row['sex'];?></td>           
                			<td style="color:orange;font-weight:bold"><?php echo $row['discharge_type'];?></td>
                           <?php
						    }
						  ?>
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
				
						file_put_contents("reports/dischargepatientlist.pdf", $pdf);
						
				   ?>
             </div>   
            <!----TABLE LISTING ENDS--->
            
<script>

	//$(document).ready(function(e) {
        $('#btnReport').click(function () {
  		
		  var v = "reports/dischargepatientlist.pdf";
		  window.location = v;
 //});
    });
	
	</script>            
			
    
  
		

 
 
      
	



