<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	$invoice_no = $_POST['post_invoice_no'];
	$discount_per = ($_POST['post_discount_per']);
	$created_by = $_POST['post_createdby'];
	$invoice_amount = $_POST['post_invoice_amount'];
	// Check Posted Data Has Value In It
	if(isset($invoice_no))
	{
		$arrGA = $Db->getPostDiscountAboveTenPercentage($invoice_no, $created_by, $discount_per, $invoice_amount);
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	