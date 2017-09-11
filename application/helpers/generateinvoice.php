<?php 
/*print_r($_POST);
exit;*/

include realpath(".") . "/mydb.php";
$Db = new Db();

try
{
	
	if(isset($_POST['post_reg_no']))
	{
		// Insert receipt data
		$Db->insertnew("patient_services", array (
			"patient_id" => $_POST['post_patient_id'],
			"bed_no" => $_POST['post_bed_no'],
			"patient_reg_no" => $_POST['post_reg_no'],
			"doctor_id" => $_POST['post_doctor_id'],
			"service_id" => $_POST['post_service_id'],
			"service_cat_id" => $_POST['post_cat_id'],
			"service_qty" => $_POST['post_service_qty'],
			"service_discount_per" => $_POST['post_service_discount'],
			"service_discount_amount" => $_POST['post_service_discount_amt'],
			"service_amount" => $_POST['post_service_price'],
			"service_total_amount" => $_POST['post_service_total_charges'],
			"service_received_amount" => $_POST['post_received_amt'],
			"service_due_amount" => $_POST['post_due_amt'],
			"service_start_date" => date('Y-m-d H:i', time()),
			// "remarks" => str_replace(",", "", $mRemarks),
		)); 
	}
}
catch(Exception $e)
{
   echo $e->getMessage();
}
?>