 <?php
 	include realpath(".") . "/mydb.php";
	$Db = new Db();
	$GAS = array();
	$GAS = $Db->GetservicenameForInvoice($_POST['post_did']);
	if(count($GAS)>0) 
	{ 
		?>
		<select name="ServiceName" id="ServiceName" class="chzn-select" style="width:140px!important">
		<?php
		foreach ($GAS as $value) 
		{ 
			$serviceid= $value['diagnosticservice_id'];
			$servicename = $value['name'];
			
?>
			<option value="<?php echo $serviceid; ?>"><?php echo $servicename; ?></option>
			
<?php  	} ?>
			
		</select>
<?php
	}
?>		