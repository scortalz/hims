<?php
// Start Session
/*session_start();
try
{
	// Include Required Classes
	require_once realpath(dirname(__FILE__) . "/../classes/db.php");

	// Create Objects Of Required Classes
	$Db = new Db();

	// Check Posted Data Has Value In It
	if(isset($_POST['post_doctor_id']))
	{
		$arr_new_id = $Db->getServicePrice($_POST['post_doctor_id']);
		echo $arr_new_id[0]['name'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}*/
// Check Posted Data Has Value In It
	if(isset($_POST['post_doctor_id']))
	{
		$arr_new_id = $Db->getServicePrice($_POST['post_doctor_id']);
		echo $arr_new_id[0]['name'];
	}
?>	
<!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
				
				
                         
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>Serial No.</div></th>
							<th><div><?php echo get_phrase('doctor name');?></div></th>
							<th><div><?php echo get_phrase('Date/Time');?></div></th>
							<th><div><?php echo get_phrase('Patient Name');?></div></th>
						  	<th><div><?php echo get_phrase('Amount');?></div></th>
							<th><div><?php echo get_phrase('Share');?></div></th>
                    		
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($invoices as $row):
						
							$Total_Received_Amount += $row['recievedamount'];
							$Share_Amount = (($row['recievedamount'] * 70 ) / 100);
							$Total_Shared_Amount += $Share_Amount;
						?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>
							<td ><?php echo date('m/d/Y', $row['creation_timestamp']);?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('patient',$row['patient_id'],'name');?></td>
							<td align="right"><?php echo number_format($row['recievedamount'], 0);?></td>
                            <td align="right"><?php echo number_format((($row['recievedamount'] * 70 ) / 100), 0);?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
               

                <table border="1" align="right" style="margin-top:10px;">
                	<tr style="background:black; height:40px;"> 
                    	<th style="width:20%; color:#fff;"> Grand Total: </th>
                        <th style="width:20%; color:#fff;"> <?php echo number_format($Total_Received_Amount, 0); ?></th>
                        <th style="width:20%; color:#fff;"> <?php echo number_format($Total_Shared_Amount, 0); ?></th>
                    </tr>
                    <tr>
                    	<td colspan="3">
                        	<div style="float: right;margin:10px;">
 								<input style="width:220px;height:40px;" type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print"/>
							</div>
                        </td>
                    </tr>
                </table>
                
                
			</div>
            
            