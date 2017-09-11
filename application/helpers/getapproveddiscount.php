<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$inv_id = $_POST['inv_idd'];
	// Check Posted Data Has Value In It
	if(isset($inv_id))
	{
		$InvoiceDiscount = $Db->getappdiscount($inv_id);
		
	//	echo $InvoiceDiscount['discount'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	