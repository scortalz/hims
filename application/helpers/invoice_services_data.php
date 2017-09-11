<?php
	include realpath(".") . "/mydb.php";
	$Db = new Db();
?>
<br />
<table align="left" width="330" >
    <tr>
        <td>
    	<div style="margin-left:-43px;display:inline;font-size:12px; color: #5f5f5f;">Service</div>
        <?php 
        $GAS = array();
					$GAS = $Db->GetservicenameForInvoice($_POST['post_did']);
					
					if(count($GAS)>0) 
					{ 
						?>
                     
						<select name="selected_services" id="selected_services"  class="chzn-select">
                        <option value="-1">-------Select Service------</option>
                  		<?php
						foreach ($GAS as $value) 
						{ 
							$serviceid= $value['diagnosticservice_id'];
							$servicename = $value['name'];
														
				?>
                  <option value="<?php echo $serviceid; ?>"><?php echo $servicename; ?></option>
               
				<?php
				     	} 
					?>
				 	</select>
                  
				<?php
					}
			  ?>		
          </td>
    </tr>
    </table>
	
