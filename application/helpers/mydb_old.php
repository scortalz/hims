<?php include realpath(".") . "/custom_config.php";
class DB {

	private $dbhost = HOST;
	private $dbuser = USER;
	private $dbpass = PWD;
	private $db = DB;

	public function __construct(){
		
	}

	public function getConnection(){
		$con = mysql_pconnect($this->dbhost, $this->dbuser, $this->dbpass);
		if ($con === false) {
			throw new Exception('Could not connect to the database server');
			// todo - log mysql error in database

		}
		return $con;
	}

	public function selectDB($con){
		$result = mysql_select_db($this->db, $con);
		if ($result === false) {
			throw new Exception('Could not connect to the database');
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
	// Get OT Schedules
	public function GetOTSchedules($current_time, $current_date) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT * FROM ot INNER JOIN ot_details od ON ot.ot_id = od.ot_master_id
INNER JOIN doctor d ON ot.doctor_id = d.doctor_id where book_time = '".$current_time."' and ot_date = '".$current_date."'";
		
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
	
	// Get OT Schedules
	public function GetOTSchedulesByDate($current_date) 
	{
		$pcon = $this->getConnection(); 
		$this->selectDB($pcon);
		
		$sql = "SELECT * FROM ot_details where ot_date = '".$current_date."'";
		
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
		
		echo $sql;
		
		$RS = mysql_query($sql);
		$RC = mysql_num_rows($RS);
		if ($RC > 0) 
		{
			$V1 = mysql_fetch_array($RS);
			return $V1;
		}
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
	
	// Bed Schedules
	public function getBedSchedules($current_date)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		
		$sql = "select * from bed_allotment WHERE FROM_UNIXTIME(`allotment_timestamp`, '%d-%m-%Y') =  '" .$current_date. "'";
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
		
		$sql = 'SELECT *, p.name AS patient_name, d.name AS dr_name FROM invoice i 
INNER JOIN patient p ON i.patient_id = p.patient_id 
INNER JOIN doctor d ON i.doctor_id = d.doctor_id where invoice_number = "' .$invoice_id. '"';
		
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
	
	
	// Get Service Price
	public function getDoctorDailySales($doctor_id)
	{
		$pcon = $this->getConnection();
		$this->selectDB($pcon);
		//$sql="SELECT * FROM employee WHERE DATE_FORMAT(birthday, '%m') = '".date('m')."' ";
		
		$sql = "SELECT * FROM invoice  
INNER JOIN patient p ON invoice.patient_id = p.patient_id  where invoice.doctor_id = '" .$doctor_id. "' AND  MONTH(creation_time) = MONTH(CURDATE())";

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
