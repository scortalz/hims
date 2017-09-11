  <?php include realpath(".") . "/custom_config.php"; 
class DB {

	private $dbhost = HOST;
	private $dbuser = USER;
	private $dbpass = PWD;
	private $db = DB;

	public function __construct(){
		
	}

	public function getConnection(){
		$con = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		if ($con === false) {
			throw new Exception('Could not connect to the database server');
			// todo - log mysql error in database

		}
		return $con;
	}

	public function selectDB($con){
		$result = mysql_select_db( $this->db,$con);
		if ($result === false) {
			throw new Exception('Could not connect to the database');
			// todo - log mysql error in database

		} 
	}
	
	public function insertnew($tableName, $columnValueArray){
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		$columnName = "";
		$columnValue = "";
		$query = " insert into " . $tableName . " ";

		/*
		foreach ($columnValueArray as $key => $value) {
			$columnName .= "`" . $key . "`,";
			$columnValue .= "'" . $value . "',";
		}
		*/
		
		foreach ($columnValueArray as $key => $value) {
			$columnName .= "`" . $key . "`,";
			$columnValue .= '"' . $value . '",';
		}

		$columnName = rtrim($columnName, " ,");
		$columnValue = rtrim($columnValue, ",");

		$columnName = "(" . $columnName .")";
		$columnValue = "(" . $columnValue .")";

		$query .= $columnName . " values " . $columnValue;			

		$result = mysql_query($query);
		$Id = mysql_insert_id();

		return $Id;

		if ($result === false) {
			throw new Exception(mysql_error());
			// todo - log mysql error in database     
		}				
	}
	
	// Auto Generation of Patient Registration Number
	//Generate_Invoice_Number
	public function Generate_Patient_Registration_Number() 
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "SELECT patient_id FROM patient ORDER BY patient_id DESC LIMIT 0,1";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
			
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	// Get OT1 Schedules By Date and Time
	public function GetOTSchedules($current_time, $current_date) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		/*$sql = "SELECT * FROM ot_details ,ot 
INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where od  ot.ot_id = od.ot_master_id and  book_time = '".$current_time."' and ot_date = '".$current_date."'";*/

$sql="SELECT * FROM ot_details od ,ot INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where  ot.ot_id = od.ot_master_id and  od.book_time = '".$current_time."' and  od.ot_date = '".$current_date."' and  ot_date = '".$current_date."' and ot.ot1_id =1";
		//return $sql; exit;  
		//echo $current_time;
	//	exit; 
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
			
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	

	public function getdoc($q){

		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);

		$sql = "SELECT d.doctor_id , d.name FROM doctor d
				INNER JOIN patient p ON d.doctor_id=p.doctor_id 
				WHERE p.patient_reg_no = '".$q."'";

		$ret = mysql_query($sql);
		$data = mysql_fetch_array($ret);
		return $data;		// Get OT2 Schedules By Date and Time
	}
	public function GetOTSchedules2($current_time, $current_date) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		/*$sql = "SELECT * FROM ot_details ,ot 
INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where od  ot.ot_id = od.ot_master_id and  book_time = '".$current_time."' and ot_date = '".$current_date."'";*/

		$sql = "SELECT * FROM ot_details od ,ot INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where  ot.ot_id = od.ot_master_id and  od.book_time = '".$current_time."' and  od.ot_date = '".$current_date."' and  ot_date = '".$current_date."' and ot.ot1_id =2";
		//echo $sql; exit;  
		//echo $current_time;
	//	exit; 
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
			
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
			// Get OT3 Schedules By Date and Time
	public function GetOTSchedules3($current_time, $current_date) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		/*$sql = "SELECT * FROM ot_details ,ot 
INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where od  ot.ot_id = od.ot_master_id and  book_time = '".$current_time."' and ot_date = '".$current_date."'";*/

$sql="SELECT * FROM ot_details od ,ot INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where  ot.ot_id = od.ot_master_id and  od.book_time = '".$current_time."' and  od.ot_date = '".$current_date."' and  ot_date = '".$current_date."' and ot.ot1_id =3";
		//return $sql; exit;  
		//echo $current_time;
	//	exit; 
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
			
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}

	//function for file uploading
	public function upload($filename){
	   $config['upload_path']          = './uploads/';
       $config['allowed_types']        = 'jpg|png/jpeg';
       $config['max_size']             = 5000;
       $config['encrypt_name']         = TRUE;
    /*   $config['max_width']            = 1024;
       $config['max_height']           = 768;*/

        $this->load->library('upload', $config);

       if ($this->upload->do_upload($filename))
       {
	       	return $this->upload->data();
       }
	}
	
	// Get OT1 Schedules By Date
	public function GetOTSchedulesByDate($current_date) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		//$sql = "SELECT * FROM ot_details, ot where ot_date = '".$current_date."' and  ot.ot1_id=1 and ot_details.ot_master_id=ot.ot_id";
		$sql = "SELECT * FROM ot_details, ot where ot_date = '".$current_date."' and  ot.ot1_id=2 and ot_details.ot_master_id=ot.ot_id";
		//echo $sql; exit; 
		//$sql = "SELECT * FROM ot_details where ot_date = '".$current_date."'";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
			
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
		
	// Get Cancel OT Hour Schedules
	public function Cancel_OT_Hours($id) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "DELETE FROM ot_details where id = '".$id."'";
		
		$RS = mysql_query($sql);	
	}
	
	// Get Doctor Rate
	public function getDoctorRate($doctor_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from amount where doctor_id = '" .$doctor_id. "'";

		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	// Check Patient Duplicate Email 
	public function CheckDuplicatePatientEmail($email_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from patient where email = '" .$email_id. "'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	// Check Doctor Duplicate Email 
	public function CheckDuplicateDoctorEmail($email_id1)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from doctor where email = '" .$email_id1. "'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	// Check Nurse Duplicate Email 
	public function CheckDuplicateNurseEmail($email_id2)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from nurse where email = '" .$email_id2. "'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	// Check reception Duplicate Email 
	public function CheckDuplicatereceptionEmail($email_id3)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from reception where email = '" .$email_id3. "'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	// Get Doctor Rate
	public function getPostDiscountAboveTenPercentage($invoice_no, $created_by, $discount_per, $invoice_amount)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "INSERT INTO approved_discount (invoice_no, discount_per, discount_amount, created_by, created_datetime) values ('".$invoice_no."',".$discount_per. ",".$invoice_amount.",'".$created_by. "','".date('Y-m-d H:i:s', time())."')";
		
		$RS = mysql_query($sql);
	}




	public function Insertpatientservice($patientid,$serviceid,$categoryid,$serviceqty,$servicedis,$serviceactamt,$serviceprice,$serviceramt,$servicedamt)
	{
		
	$pcon = $this->getConnection();
	$this->selectDB($pcon);

	$sql = "INSERT INTO patient_services (patient_reg_no, service_id, service_cat_id,
	service_qty, service_discount_amount,service_amount,service_total_amount,service_received_amount,service_due_amount) 
		VALUES ('".$patientid."',".$serviceid.",".$categoryid.",".$serviceqty.",".$servicedis.",".$serviceactamt.",".$serviceprice.",".$serviceramt.",".$servicedamt.")";		
	
	if(mysql_query($sql) == true){
		return true;
	}
	else {

		return false;
	}

}

public function savesim(){
	
}

	// Get Service Price
	public function getServicePrice($service_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from service where service_id = '" .$service_id. "'";

		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	
	// Get Service Price
	public function getServicePriceDiag($service_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from diagnosticservice where diagnosticservice_id = '" .$service_id. "'";
		
		//echo $sql;
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	
		public function getdueamt($q)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "SELECT SUM(service_due_amount) FROM patient_services WHERE patient_reg_no = '" .$q. "'";
		
		//echo $sql;
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	
	public function clrdueamt($q)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "UPDATE patient_services SET service_due_amount = '0' where patient_reg_no = '" .$q. "'";
		
		mysql_query($sql);
		return true;
	}
	
	// Get All Service
	public function GetAllServices()
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from service "; // where service_id = '" .$service_id. "'";
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  }
		  return $CI;
		}
	}

	
	// Get All Service
	public function Getservicename()
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from diagnosticservice "; //where diagnosticservice_id = '" .$diagnosticservice_id. "'"; //service name and charges
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  }
		  return $CI;
		}
	}
	
		// Get getPatientDoctor
	public function getPatientDoctor($doctor_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from doctor where doctor_id = '" .$doctor_id. "'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
		// Get getPatient Receipt
	public function getPatientReceipt($pid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from invoice where patient_id = '" .$pid. "' where selected_services != 614";
		//echo $sql;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
		// Get getRoomType
/*	public function getRoomType($charges_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from room_charges where charge_id = '" .$charges_id. "'";
		//echo $sql;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}*/
		// Get getPatient Service
		/*
	public function getPatientServices($regno) //, $admission_date)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "SELECT *,d.name AS service_name, c.name AS cat_name FROM patient_services p INNER JOIN diagnostictype c ON p.service_cat_id = c.diagnostictype_id 
INNER JOIN diagnosticservice d ON p.service_id = d.diagnosticservice_id WHERE patient_reg_no = '" .$regno. "' order by service_start_date"; //" and date_format(p.service_start_date, '%Y-%m-d') = '$admission_date' order by service_start_date";
		echo $sql;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	*/
		
	// Get All Category
	public function GetAllCategory()
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from diagnostictype "; // where service_id = '" .$service_id. "'";  //category name
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  }
		  
		  return $CI;

		}
	}
	
	// Get All Service
	public function GetservicenameForInvoice($serviceid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from diagnosticservice where diagnostictype_id = $serviceid "; //where diagnosticservice_id = '" .$diagnosticservice_id. 
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  }
		  return $CI;
		}
	}
	// Bed Number
	public function getBedNumber()
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from bed ";
		//echo $sql."</br>";
		//exit;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Bed Schedules
	public function getBedSchedules($current_date)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		/*$sql = "select * from bed_allotment b, patient p WHERE FROM_UNIXTIME(b.`allotment_timestamp`, '%m/%d/%Y') =  '" .$current_date. "' and b.`patient_id` = p.`patient_id` ";*/
	
		$sql = "
SELECT p.name, p.patient_id, MAX(pb.transferdate) transferdate, MAX(pb.bed_id) bed_id, status FROM patient_bed_mapping pb, patient p
WHERE p.patient_id = pb.patient_id and DATE_FORMAT(pb.`transferdate`, '%m/%d/%Y') = '".$current_date."' and status = 1
GROUP BY p.name, p.patient_id ORDER BY pb.bed_mapping_id DESC";

		//echo $sql."</br>";
		//exit;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	

	// Get Receipt Information
	public function getReceiptInformation($invoice_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = 'SELECT *, p.phone as p_phone, p.name AS patient_name, d.name AS dr_name FROM invoice i 
INNER JOIN patient p ON i.patient_id = p.patient_id 
LEFT JOIN doctor d ON i.doctor_id = d.doctor_id where invoice_number = "' .$invoice_id. '"';
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get Doctor Voucher
	public function getDoctorVoucher($invoice_number)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = 'SELECT *, p.name AS patient_name, d.name AS dr_name FROM invoice i 
INNER JOIN patient p ON i.patient_id = p.patient_id 
INNER JOIN doctor d ON i.doctor_id = d.doctor_id where invoice_number = "' .$invoice_number. '"';
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	
	// Auto Generation of Invoice
	public function Generate_Invoice_Number() 
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "SELECT invoice_id FROM invoice ORDER BY invoice_id DESC LIMIT 0,1";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
			
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get All Sub Category
	public function Getallsubcategory($subcategoryid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from surgery where type_id = $subcategoryid "; //where type_id = '" .$subcategoryid. 
	//return $sql; exit;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  }
		  return $CI;
		}
	}



	public function invoicekiedit($col, $vl, $id){
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
				$sql = "UPDATE patient_services SET ".$col." = '".$vl."' WHERE id = '".$id."' ";
				
		//   echo $sql;   
		   mysql_query($sql);
		}
	//GET patient invoice
	public function getPatientInvoice($reg_no){
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		$sql = "select patient_services.id, patient_services.service_id,patient_services.service_cat_id,patient_services.service_qty,patient_services.service_discount_per,patient_services.service_discount_amount,patient_services.service_amount,patient_services.service_total_amount,patient_services.service_received_amount,patient_services.service_due_amount,diagnostictype.name,diagnosticservice.name as name1 
		from patient_services
		join diagnostictype on patient_services.service_cat_id = diagnostictype.diagnostictype_id 
		join diagnosticservice on patient_services.service_id = diagnosticservice.diagnosticservice_id
		 where patient_reg_no = '".$reg_no."'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_assoc($RS);		  
		  } 
		  return $CI;
		}
	}
	// Get getPatientProfile
	public function getPatientProfile($reg_no)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from patient where patient_reg_no = '" .$reg_no. "'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get Update Patient Discharge date
	public function Updatepatientdischargedate($patient_reg_no, $dc_type)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "update patient set discharge_date=NOW(), discharge_type = '".$dc_type."' where patient_reg_no = '" .$patient_reg_no. "'";
	//	echo $sql;

		$RS = mysql_query($sql);
		
		 $sql1 = "update patient_bed_mapping set status = 0 where patient_id IN (select patient_id from patient where patient_reg_no = '".$patient_reg_no."') and status=1";
		    mysql_query($sql1);
	}
	

	
	// Get Daly Doctor Sale
 public function getDoctorDailySales($doctor_id, $selected_date, $selected_date_to)
 {
  $pcon = $this->getConnection();
  $this->selectDB($pcon);
  
  if ($doctor_id == "-1")
  {
   $where = ""; 
  }
  else
  {
   $where = " and invoice.doctor_id = '" .$doctor_id. "'"; 
  }
  
// $sql = "SELECT * FROM invoice  INNER JOIN patient p ON invoice.patient_id = p.patient_id  where invoice.doctor_id = '" .$doctor_id. "' AND  (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to')";

  $sql = "SELECT  *,p.name AS patname FROM invoice  INNER JOIN patient p ON invoice.patient_id = p.patient_id INNER JOIN doctor d ON invoice.doctor_id = d.doctor_id where (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to') $where";


  $RS = mysql_query($sql);
  $RC = mysql_num_rows($RS);
  $CI=array();
  if ($RC > 0)
  {   
    for ($i=0; $i<$RC; $i++) 
    {
   $CI[$i]=mysql_fetch_array($RS);    
    } 
    return $CI;
  }
 }
	
		// Get Daily Reception Shift Wise Sale
	public function getdailyreceptionsale($login, $selected_date)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$selected_date = strtolower($selected_date);
		
		/*
		$sql = "SELECT p.patient_reg_no, p.name, i.createdby, i.careof, i.creation_time, (CASE WHEN i.doctor_id > 0 THEN d.name ELSE 'Service Charges' END) AS dr_name, SUM(recievedamount) as receivedamount FROM invoice i
INNER JOIN patient p ON i.patient_id = p.patient_id LEFT JOIN doctor d ON i.doctor_id = d.doctor_id WHERE DATE_FORMAT(i.creation_time, '%m/%d/%Y') = '$selected_date' 
and createdby = '".$login."' GROUP BY i.createdby, i.creation_time";
*/

$sql = "SELECT
  p.patient_reg_no,
  p.name,
  i.createdby,
  i.careof,
  i.creation_time,
  i.selected_services,
  dg.name AS service_type,
  (CASE WHEN i.doctor_id > 0 THEN d.name ELSE 'Service Charges' END) AS dr_name,
  SUM(recievedamount) AS receivedamount
FROM invoice i
  INNER JOIN patient p
    ON i.patient_id = p.patient_id
  LEFT JOIN doctor d
    ON i.doctor_id = d.doctor_id
    
  LEFT JOIN diagnostictype dg
    ON i.diagnostictype_id = dg.diagnostictype_id
   LEFT JOIN diagnosticservice ds
    ON i.selected_services = ds.diagnosticservice_id WHERE DATE_FORMAT(i.creation_time, '%m/%d/%Y') = '$selected_date' 
and createdby = '".$login."' GROUP BY i.createdby, i.creation_time";


		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get Patient Total Invoice Amount
	public function getTotalAmount($pat_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select sum(service_total_amount) as total_amount from patient_services where patient_reg_no = '" .$pat_id. "'";
		
		//echo $sql;
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	
		// Get Patient Total Remainig Amount
	public function getTotalRemainingAmount($pat_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select sum(service_received_amount) as total_remaining_amount from patient_services where patient_reg_no = '" .$pat_id. "'";
		
		//echo $sql;
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
	}
	
			// Get OT Booked Timings
/*	public function getotbookedtime($doctorid) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "select * from ot where doctor_id =$doctorid ";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}*/
	
     	// Get OT Booked Timings
	public function getotbookedtime($otid) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "select * from ot where ot1_id =$otid ";
		/*$sql = "SELECT ots.1_open_time, ots.1_close_time FROM ot ots, ot_details otd
WHERE DATE_FORMAT(ots.case_date, '%m/%d/%Y')='$selectdate' AND ots.ot_id=otd.ot_master_id AND ots.ot1_id=$otid";
echo $sql;exit();*/
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
	   	// Get Bed Allotment Timings
	public function getbedallotment($allotmentdate) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
	//	$sql = "SELECT * FROM bed_allotment  INNER JOIN bed bd ON
 //bed_allotment.bed_id = bd.bed_id  WHERE bed_allotment.patient_id = '"  .$allotmentdate."'
// AND  DATE_FORMAT(allotment_timestamp, '%m/%d/%Y') = '15/09/2014'; ";
	$sql = "SELECT * FROM bed_allotment b,  bed bd WHERE 
	FROM_UNIXTIME(b.`allotment_timestamp`, '%m/%d/%Y') ='$allotmentdate' AND bd.`bed_id` = b.`bed_id`";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
		// Get RoomCharges
	public function getRoomCharges($chargeid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from room_charges where charge_id = '" .$chargeid. "'";
		//echo $sql;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}

			// Get  BedCharges
	public function getBedCharges($bedid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from bed where bed_id = '" .$bedid. "'";
		//echo $sql;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get invoice Discount
	public function getappdiscount($discountamt) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "update invoice set approved='1' where invoice_id = $discountamt ";
		$RS = mysql_query($sql);
		
	}
	
		// Get single invoice print
	public function getsingleinvprint($printsingleinv) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "select * from invoice where invoice_id >= $invoice_id ";
		$RS = mysql_query($sql);
		
	}
	
		// Get Booked Timings
	public function getbookedtiming($romid) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "select * from assignedroom where room_id =$romid ";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
	// Get Booked Timings
	public function getPatientBed($pat_id) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "SELECT CONCAT(bed_number, ' ',   TYPE) AS bed FROM bed b INNER JOIN bed_allotment ba ON b.bed_id = ba.bed_id
INNER JOIN patient p ON ba.patient_id = p.patient_id WHERE p.patient_id =$pat_id and patient_type='IPD'";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
	// Get Bed Allotment
	public function getAvailableBeds() 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		//$sql = "SELECT * FROM bed WHERE bed_id NOT IN (SELECT bed_id FROM bed_allotment) AND STATUS = 0";
		$sql = "SELECT * FROM bed WHERE bed_id NOT IN (SELECT bed_id FROM patient_bed_mapping where status = 1) ";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
		// Get Bed Allotment
	public function getnotavailableBeds() 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "SELECT * FROM bed_allotment ba, patient_bed_mapping bm, bed b WHERE ba.patient_id = bm.patient_id  AND ba.bed_id = bm.bed_id AND ba.bed_id = b.bed_id";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
	// Get available patient
	public function getavailablepatient() 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		//$sql = "SELECT * FROM patient WHERE patient_id NOT IN (SELECT patient_id FROM bed_allotment )";
		//$sql = "SELECT * FROM patient WHERE patient_id NOT IN (SELECT patient_id FROM patient_bed_mapping WHERE STATUS=0) AND ( LENGTH(discharge_type) = 0 OR discharge_type) IS NULL  AND patient_type = 'IPD' ";
		$sql = "SELECT * FROM patient WHERE ( LENGTH(discharge_type) = 0 OR discharge_type) IS NULL  AND patient_type = 'IPD' ";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
	// Get transfer patient
	public function gettransferpatient() 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		//$sql = "SELECT * FROM bed_allotment ba INNER JOIN patient p ON ba.patient_id=p.patient_id";
		//$sql = "SELECT * FROM patient WHERE patient_id NOT IN (SELECT patient_id FROM patient_bed_mapping WHERE status=0) AND ( LENGTH(discharge_type) = 0 OR discharge_type) IS NULL  AND patient_type = 'IPD'";
		
		$sql = "SELECT * FROM patient WHERE ( LENGTH(discharge_type) = 0 OR discharge_type) IS NULL  AND patient_type = 'IPD'";
		//echo $sql;
		//exit;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
		// Get reserved bed
	public function getreservedbed($pat_id) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT * FROM patient_bed_mapping where patient_id = $pat_id ";
		$RS = mysql_query($sql);
		
		$RC = mysql_num_rows($RS);
		if ($RC > 1)
		{
			$sql = "SELECT bed_id, type, bed_number FROM bed
WHERE bed_id IN (SELECT bed_id FROM patient_bed_mapping WHERE patient_id = $pat_id ORDER BY bed_mapping_id DESC ) ORDER BY bed_id DESC LIMIT 0,1 ";	
		}
		else
		{
			$sql = "SELECT * FROM bed_allotment ba INNER JOIN bed bd ON ba.bed_id=bd.bed_id where ba.patient_id = $pat_id ";
		}
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
	  // Get reserved bed
	public function getavailablebedcharges($bedidd) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		$sql = "SELECT * FROM bed where bed_id=$bedidd";
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
		
	}
	
		  // Get Update  Bed Schedule
	public function UpdateBedSchedule($selectdate) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "select * from patient_bed_mapping where date_format(transferdate,'%Y-%m-%d')='$selectdate' and status=1";
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
		  // Get Update  Bed Schedule
	public function getInvoiceSelectedService($service_id) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT * FROM diagnosticservice WHERE diagnosticservice_id = $service_id";
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get Daily Reception Shift Wise Sale
	public function getDailyCashSummaryReport($selected_date)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$selected_date = strtolower($selected_date);
		
		
		/* $sql = "SELECT p.patient_reg_no, p.name, i.createdby, i.careof, i.creation_time, (CASE WHEN i.doctor_id > 0 THEN d.name ELSE 'Service Charges' END) AS dr_name, SUM(recievedamount) AS receivedamount FROM invoice i
INNER JOIN patient p ON i.patient_id = p.patient_id LEFT JOIN doctor d ON i.doctor_id = d.doctor_id WHERE DATE_FORMAT(i.creation_time, '%m/%d/%Y') = '$selected_date' 
 GROUP BY i.createdby, i.creation_time";
 */
 
 $sql = "SELECT   p.patient_reg_no,  p.name,  i.createdby,  i.careof,  i.creation_time,  i.selected_services,  dg.name AS service_type,  (CASE WHEN i.doctor_id > 0 THEN d.name ELSE 'Service Charges' END) AS dr_name,  SUM(recievedamount) AS receivedamount FROM invoice i  INNER JOIN patient p
    ON i.patient_id = p.patient_id  LEFT JOIN doctor d    ON i.doctor_id = d.doctor_id  LEFT JOIN diagnostictype dg ON i.diagnostictype_id = dg.diagnostictype_id  LEFT JOIN diagnosticservice ds ON i.selected_services = ds.diagnosticservice_id WHERE DATE_FORMAT(i.creation_time, '%m/%d/%Y') = '$selected_date'  GROUP BY i.createdby, i.creation_time";
 
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	 // Get admitted patient bed report
 public function admittedbedreport($regno)
 {
  $pcon = $this->getConnection();
  $this->selectDB($pcon);

  $sql = "SELECT p.patient_reg_no, p.name, b.bed_number, b.type, pbm.transferdate,b.charges FROM bed b INNER JOIN patient_bed_mapping pbm ON b.bed_id = pbm.bed_id
INNER JOIN patient p ON pbm.patient_id = p.patient_id WHERE p.patient_reg_no= '".$regno."' order by pbm.transferdate";
  //echo $sql; exit;
  $RS = mysql_query($sql);
  $RC = mysql_num_rows($RS);
  $CI=array();
  if ($RC > 0)
  {   
    for ($i=0; $i<$RC; $i++) 
    {
   $CI[$i]=mysql_fetch_array($RS);    
    } 
    return $CI;
  }
 }
 
 // Get Today's token number
	public function getTodayToken($doctor_id, $today) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT LPAD(COUNT(invoice_id)+ 1, 4, '0000') AS token FROM invoice WHERE doctor_id = $doctor_id AND DATE_FORMAT(creation_time, '%Y-%m-%d') = '$today' ";
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	// Get OPD Room
	public function getTokenOPDRoom($doctor_id) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT * FROM assignedroom ar INNER JOIN room r ON ar.room_id = r.room_id WHERE doctor_id = $doctor_id";
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get Services from Mapping
	public function getInvoiceMappingService($inv_no) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT * FROM invoice_service_mapping m INNER JOIN diagnosticservice d ON m.service_id = d.diagnosticservice_id WHERE invoice_no = '".$inv_no."'";
		//echo $sql;
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	public function getAdmittedPatientCount()
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$selected_date = strtolower($selected_date);
		
		
		$sql = "select * from patient where patient_type = 'IPD' and discharge_type is null";
 
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	public function getPatientAdvancePayment($pid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		// AND discharge_type IS NULL
		$sql = "SELECT * FROM invoice i INNER JOIN patient p ON i.patient_id = p.patient_id WHERE patient_type = 'IPD'  AND i.selected_services = 614 AND p.patient_id = $pid";
	
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
public function getPatientBedCharges($pat_id)
 {
  $pcon = $this->getConnection();
  $this->selectDB($pcon);

  $sql = "SELECT sum(b.charges) as charges FROM bed b INNER JOIN patient_bed_mapping pbm ON b.bed_id = pbm.bed_id 
INNER JOIN patient p ON pbm.patient_id = p.patient_id WHERE p.patient_reg_no= '".$pat_id."' ";
  //echo $sql; exit;
  $RS = mysql_query($sql);
  $RC = mysql_num_rows($RS);
  $CI=array();
  if ($RC > 0)
  {   
    for ($i=0; $i<$RC; $i++) 
    {
   $CI[$i]=mysql_fetch_array($RS);    
    } 
    return $CI;
  }
 }	
	
	
	public function getPatientAllAdvancePayment($pid)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "SELECT sum(recievedamount) as recievedamount FROM invoice i INNER JOIN patient p ON i.patient_id = p.patient_id WHERE patient_type = 'IPD' AND discharge_type IS NULL AND i.selected_services = 614 AND p.patient_reg_no = '$pid'";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	// Get Daly Doctor Sale
	public function getSalesReport($selected_date, $selected_date_to)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		//$sql = "SELECT * FROM invoice  INNER JOIN patient p ON invoice.patient_id = p.patient_id  where (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to') AND recievedamount > 0 order by creation_time asc";
		$sql = "SELECT *,p.name as patname FROM invoice  INNER JOIN patient p  ON invoice.patient_id = p.patient_id LEFT JOIN doctor d ON invoice.doctor_id = d.doctor_id   where (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to') AND recievedamount > 0 order by creation_time asc";
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	public function getTotalDiscounts($regno)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);

		$sql = "SELECT discount,p.patient_reg_no, p.name, datetime FROM discounts d INNER JOIN patient p ON d.patient_reg_no = p.patient_reg_no
 WHERE p.patient_reg_no = '" .$regno. "'";
 

		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	public function getTotalRefunds($regno)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);

		$sql = "SELECT refund,p.patient_reg_no, p.name, datetime FROM refunds r INNER JOIN patient p ON r.patient_reg_no = p.patient_reg_no
 WHERE p.patient_reg_no = '" .$regno. "'";
 

		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	public function getTotalZakaats($regno)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);

		$sql = "SELECT zakaat,p.patient_reg_no, p.name, datetime FROM zakaat z INNER JOIN patient p ON z.patient_reg_no = p.patient_reg_no
 WHERE p.patient_reg_no = '" .$regno. "'";
 

		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	}
	
	
	 // Get get Sales Category Report
 public function getCategorySalesReport($cat_name,$selected_date, $selected_date_to)
 {
  $pcon = $this->getConnection();
  $this->selectDB($pcon);
  
 // $sql = "SELECT *,p.name as patient_name, dd.name as cat_name FROM invoice  INNER JOIN patient p ON invoice.patient_id = p.patient_id INNER JOIN diagnostictype dd ON invoice.diagnostictype_id = dd.diagnostictype_id where (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to') AND recievedamount > 0 and invoice.diagnostictype_id = $cat_name order by creation_time asc";
 // $sql = "SELECT *,p.name as patient_name, dd.name as cat_name,ds.name as ser_name FROM invoice  INNER JOIN patient p ON invoice.patient_id = p.patient_id INNER JOIN diagnostictype dd ON invoice.diagnostictype_id = dd.diagnostictype_id INNER JOIN diagnosticservice ds ON dd.diagnostictype_id = ds.diagnostictype_id LEFT JOIN doctor d ON invoice.doctor_id = d.doctor_id  where (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to') AND recievedamount > 0 and invoice.diagnostictype_id = $cat_name AND invoice.selected_services = ds.diagnosticservice_id order by creation_time asc";
 $sql = "SELECT *,p.name as patient_name, dd.name as cat_name,ds.name as ser_name FROM invoice  INNER JOIN patient p ON invoice.patient_id = p.patient_id INNER JOIN diagnostictype dd ON invoice.diagnostictype_id = dd.diagnostictype_id INNER JOIN diagnosticservice ds ON dd.diagnostictype_id = ds.diagnostictype_id   where (DATE_FORMAT(creation_time, '%m/%d/%Y') BETWEEN '$selected_date' AND '$selected_date_to') AND recievedamount > 0 and invoice.diagnostictype_id = $cat_name AND invoice.selected_services = ds.diagnosticservice_id order by creation_time asc";
  //echo $sql;
  
  $RS = mysql_query($sql);
  $RC = mysql_num_rows($RS);
  $CI=array();
  if ($RC > 0)
  {   
    for ($i=0; $i<$RC; $i++) 
    {
   $CI[$i]=mysql_fetch_array($RS);    
    } 
    return $CI;
  }
 }

 // Auto Generate Next Day Token Number
 public function Generate_nextdaytoken_Number($date,$doctorid) 
 {
  $pcon = $this->getConnection();
  $this->selectDB($pcon);
  
  $sql = "SELECT (COUNT(tokenno) + 1) as today_token_no FROM advappointment WHERE DATE_FORMAT(appdate, '%Y-%m-%d') = '".$date."' AND doctor_id='".$doctorid."'";
 
  $RS = mysql_query($sql);
  $RC = mysql_num_rows($RS);
   
  $CI=array();
  if ($RC > 0)
  {   
    for ($i=0; $i<$RC; $i++) 
    {
   $CI[$i]=mysql_fetch_array($RS);    
    } 
    return $CI;
  }
 }
		// Get Advance Patient Appointment Report
		
		public function getadvappointmentreport($doctorid,$selecteddate)
		{
			
			$pcon = $this->getConnection();
			$this->selectDB($pcon);

			if ($doctorid == "-1")
			{
				$where = " WHERE DATE_FORMAT(appdate, '%m/%d/%Y')= '".$selecteddate."'";
			}
			else
			{
				$where = " WHERE DATE_FORMAT(appdate, '%m/%d/%Y')= '".$selecteddate."'  and ad.doctor_id='".$doctorid."'";
			}
		$sql = "SELECT ad.patname,ad.appdate,ad.phone,ad.area,ad.tokenno,ad.status,ad.tokenno,d.name as docname FROM advappointment ad
                 INNER JOIN doctor d ON ad.doctor_id = d.doctor_id $where AND STATUS='schedule' ";
			//echo $sql;			
			$RS = mysql_query($sql);
			$RC = mysql_num_rows($RS);
			$CI=array();
			if ($RC > 0)
			{			
			  for ($i=0; $i<$RC; $i++) 
			  {
				$CI[$i]=mysql_fetch_array($RS);		  
			  } 
			  return $CI;
			}
		}
		
		// Get Manage Patient Doctor
  
  public function manage_patientdoctor()
  {
   
   $pcon = $this->getConnection();
   $this->selectDB($pcon);

   
  $sql = "SELECT d.name AS doctorname,p.patient_id,p.patient_reg_no,p.name 
	AS patname,p.phone,p.admission_date,p.patient_type,p.discharge_type FROM patient 
	p LEFT JOIN doctor d ON p.doctor_id=d.doctor_id ORDER BY p.admission_date DESC";
   //echo $sql;   
   $RS = mysql_query($sql);
   $RC = mysql_num_rows($RS);
   $CI=array();
   if ($RC > 0)
   {   
     for ($i=0; $i<$RC; $i++) 
     {
    $CI[$i]=mysql_fetch_array($RS);    
     } 
     return $CI;
   }
  }
  
  
  // Get Diagnostic Service Type
  
  public function diagnosticservicetype()
  {
   
   $pcon = $this->getConnection();
   $this->selectDB($pcon);

   
  $sql = "SELECT dy.name AS title,ds.name  AS diagnosticname,ds.corporatecharges,ds.diagnosticservice_id FROM diagnosticservice ds
  INNER JOIN diagnostictype dy ON ds.diagnostictype_id = dy.diagnostictype_id order by diagnosticservice_id ASC";
   //echo $sql;   
   $RS = mysql_query($sql);
   $RC = mysql_num_rows($RS);
   $CI=array();
   if ($RC > 0)
   {   
     for ($i=0; $i<$RC; $i++) 
     {
    $CI[$i]=mysql_fetch_array($RS);    
     } 
     return $CI;
   }
  }

   public function manageinvoicepatient()
  {
   
   	$pcon = $this->getConnection();
   	$this->selectDB($pcon);

	/*
		old join from ex dev
	   	SELECT p.name AS patname, p.phone, d.name AS doctorname, i.invoice_number,i.totalamount, i.creation_timestamp,i.invoice_id
         FROM invoice i INNER JOIN patient p ON p.patient_id = i.patient_id INNER JOIN doctor d ON i.doctor_id = i.doctor_id
         AND p.doctor_id = d.doctor_id ORDER BY i.invoice_id DESC */
   
  	$sql = "SELECT p.name AS patname, p.phone, d.name AS doctorname, i.invoice_number,i.totalamount, i.creation_timestamp,i.invoice_id FROM invoice i JOIN patient p ON p.patient_id = i.patient_id LEFT JOIN doctor d ON i.doctor_id = d.doctor_id ORDER BY i.invoice_id DESC";
		//   echo $sql;   
		   $RS = mysql_query($sql);
		   $RC = mysql_num_rows($RS);
		   $CI=array();
		   if ($RC > 0)
		   {   
			 for ($i=0; $i<$RC; $i++) 
			 {
			$CI[$i]=mysql_fetch_array($RS);    
			 } 
			 return $CI;
		   }
		   
	}

			// Get getPatient Service
	public function getPatientServices($regno,$admissiondate) //, $admission_date)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "SELECT *,d.name AS service_name, c.name AS cat_name FROM patient_services p INNER JOIN diagnostictype c ON p.service_cat_id = c.diagnostictype_id INNER JOIN diagnosticservice d ON p.service_id = d.diagnosticservice_id WHERE patient_reg_no = '" .$regno. "' AND DATE_FORMAT(service_start_date, '%d-%m-%Y') >= '" .$admissiondate. "'
ORDER BY service_start_date"; //" and date_format(p.service_start_date, '%Y-%m-d') = '$admission_date' order by service_start_date";
		//echo $sql;
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		$CI=array();
		if ($RC > 0)
		{			
		  for ($i=0; $i<$RC; $i++) 
		  {
			$CI[$i]=mysql_fetch_array($RS);		  
		  } 
		  return $CI;
		}
	  }


	    
	
}
?>
