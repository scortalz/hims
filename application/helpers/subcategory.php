<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$type_id = $_POST['post_subcategory'];
	//$surgy=$_POST['surgy'];
	// Check Posted Data Has Value In It
	if(isset($type_id))
	{
		$arrServiceRate = $Db->Getallsubcategory($type_id);
		
		//print_r($arrServiceRate); exit;
			if(count($arrServiceRate)>0) 
					{ 
						?>
                     
						                                    <select class="chzn-select" name="type_id" id="type_id">
                  		<?php
						foreach ($arrServiceRate as $value) 
						{ 
							$serviceid= $value['type_id'];
							$servicename = $value['type'];
														
				?>
                  <option value="<?php echo $serviceid; ?>"><?php echo $servicename; ?></option>
               
				<?php
				  	} 
					?>
				 	</select>
                  
				<?php
					}
			 	 	
              
              
    //          
	//	print_r($arrServiceRate); exit;
		//echo $arrServiceRate['rate'];
	//	echo $arrServiceRate['type'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	
	
