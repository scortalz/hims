<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 1 August, 2013
 *	University Of Dhaka, Bangladesh
 *	Hospital Management system
 *	http://codecanyon.net/user/joyontaroy
 */

class reception extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
	/***Default function, redirects to login page if no admin logged in yet***/
	public function index()
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($this->session->userdata('reception_login') == 1)
			redirect(base_url() . 'index.php?reception/dashboard', 'refresh');
	}
	
	/***reception DASHBOARD***/
	function dashboard()
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = get_phrase('reception_dashboard');
		$this->load->view('index', $page_data);
	}
	
	/***Manage patients**/
 function manage_patient($param1 = '', $param2 = '', $param3 = '')
 {
  if ($this->session->userdata('reception_login') != 1)
   redirect(base_url() . 'index.php?login', 'refresh');
   
  if ($param1 == 'create') {
   $data['patient_reg_no']           = $this->input->post('patient_reg_no');
   $data['doctor_id']                = $this->input->post('doctor_id');
   $data['patient_type']             = $this->input->post('patient_type');
   $data['refferedby']               = $this->input->post('refferedby');
   $data['med_card_no']              = $this->input->post('med_card_no');
   $data['salutation']               = $this->input->post('salutation');
   $data['name']                      = $this->input->post('name');
   $data['father_husbandname']        = $this->input->post('father_husbandname');
   $data['email']                     = $this->input->post('email');
   $data['password']                  = $this->input->post('password');
   $data['nic_no']                  = $this->input->post('start_5').'-'.$this->input->post('mid_7').'-'.$this->input->post('end_1');
   $data['address']                   = $this->input->post('address');
   $data['phone']                     = $this->input->post('phone');
   $data['sex']                       = $this->input->post('sex');
   $data['birth_date']                = $this->input->post('birth_date');
   $data['age']                       = $this->input->post('age');
   $data['blood_group']               = $this->input->post('blood_group');
    $data['admission_date']               = date('Y-m-d H:i:s', time());
   $data['account_opening_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i'));
   $this->db->insert('patient', $data);
   $id = mysql_insert_id();
   $this->email_model->account_opening_email('patient', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
   $this->session->set_flashdata('flash_message', get_phrase('account_opened'));
   
  /* $reg_no = 'MR-'.date('ym-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);
   
   $conn = mysql_connect('localhost', 'root','');
   mysql_select_db ('incisivermc');
   $sql = "update patient set patient_reg_no = '".$reg_no."' where patient_id = $id";
   $r = mysql_query ($sql, $conn);*/
   
   redirect(base_url() . 'index.php?reception/manage_patient', 'refresh');
  }
  
  if ($param1 == 'edit' && $param2 == 'do_update') {
		   
			$data['patient_reg_no']       = $this->input->post('patient_reg_no');
			$data['doctor_id']             = $this->input->post('doctor_id');
			$data['patient_type']          = $this->input->post('patient_type');
			$data['refferedby']            = $this->input->post('refferedby');
			$data['med_card_no']           = $this->input->post('med_card_no');
			$data['salutation']            = $this->input->post('salutation');
			$data['name']                  = $this->input->post('name');
			$data['father_husbandname']    = $this->input->post('father_husbandname');
			$data['email']                 = $this->input->post('email');
			$data['password']              = $this->input->post('password');
			$data['nic_no']                = $this->input->post('nic_no');
			$data['address']               = $this->input->post('address');
			$data['phone']                 = $this->input->post('phone');
			$data['sex']                   = $this->input->post('sex');
			$data['birth_date']            = $this->input->post('birth_date');
			$data['age']                   = $this->input->post('age');
			$data['blood_group']           = $this->input->post('blood_group');
			
			$this->db->where('patient_id', $param3);
			$this->db->update('patient', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?reception/manage_patient', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('patient', array(
				'patient_id' => $param2
			))->result_array();
		}
  
  $page_data['page_name']  = 'manage_patient';
  $page_data['page_title'] = get_phrase('manage_patient');
	//$this->db->order_by("patient_reg_no","desc");  /*/this line added by ali/*/
  $page_data['patients']   = $this->db->get('patient')->result_array();
   
  $this->load->view('index', $page_data);
 }

     	 /***Discharge patients**/
		
		 function dischargepatient($param1 = '', $param2 = '', $param3 = '')
			 {
			  if ($this->session->userdata('reception_login') != 1)
			   redirect(base_url() . 'index.php?login', 'refresh');

			  $page_data['page_name']  = 'dischargepatient';
			  $page_data['page_title'] = get_phrase('discharge patient');
			  $page_data['patients']   = $this->db->get('patient')->result_array();
			   
			  $this->load->view('index', $page_data);
			 }
			 
	/***Manage Doctor Schedule**/
	
	function doctor_schedule($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['days']          = $this->input->post('days');
			$data['doctor_id']          = $this->input->post('doctor_id');
			$data['1_open_time'] = $this->input->post('1_open_time');
			$data['1_close_time'] = $this->input->post('1_close_time');
			
			$this->db->insert('schedule', $data);
			//$this->email_model->account_opening_email('speciality', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?reception/doctor_schedule', 'refresh');
		}
		
		$page_data['page_name']  = 'doctor_schedule';
		$page_data['page_title'] = get_phrase('doctor_schedule');
		$page_data['schedules']    = $this->db->get('schedule')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage Doctor Speciality**/
	function doctor_speciality($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['speciality_name']          = $this->input->post('speciality_name');
			$data['sub_speciality']          = $this->input->post('sub_speciality');
			
			$this->db->insert('speciality', $data);
			//$this->email_model->account_opening_email('speciality', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?reception/doctor_speciality', 'refresh');
		}
		
		$page_data['page_name']  = 'doctor_speciality';
		$page_data['page_title'] = get_phrase('doctor_speciality');
		$page_data['specialitys']    = $this->db->get('speciality')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage doctors**/
	function manage_doctor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']          = $this->input->post('name');
			$data['email']         = $this->input->post('email');
			$data['password']      = $this->input->post('password');
			$data['address']       = $this->input->post('address');
			$data['phone']         = $this->input->post('phone');
			$data['doj']         = $this->input->post('doj');
			$data['ratio']         = $this->input->post('ratio');
			$data['department_id'] = $this->input->post('department_id');
			$data['speciality_id'] = $this->input->post('speciality_id');
			$data['created_by'] = $this->input->post('created_by');
			//$data['profile']       = $this->input->post('profile');
			$this->db->insert('doctor', $data);
			$this->email_model->account_opening_email('doctor', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?reception/manage_doctor', 'refresh');
		}
		
		$page_data['page_name']  = 'manage_doctor';
		$page_data['page_title'] = get_phrase('manage_doctor');
		$page_data['doctors']    = $this->db->get('doctor')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
		/***Manage doctors**/
/***DEPARTMENTS OF DOCTORS********/
	function manage_department($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->insert('department', $data);
			$this->session->set_flashdata('flash_message', get_phrase('department_opened'));
			redirect(base_url() . 'index.php?reception/manage_department', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->where('department_id', $param3);
			$this->db->update('department', $data);
			$this->session->set_flashdata('flash_message', get_phrase('department_updated'));
			redirect(base_url() . 'index.php?reception/manage_department', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('department', array(
				'department_id' => $param2
			))->result_array();
		}
		$page_data['page_name']   = 'manage_department';
		$page_data['page_title']  = get_phrase('manage_department');
		$page_data['departments'] = $this->db->get('department')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/******MANAGE Rate*****/
	function manage_rate($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['doctor_id']         = $this->input->post('doctor_id');
			$data['service_id']         = $this->input->post('service_id');
			$data['rate']         = $this->input->post('rate');
			
			$this->db->insert('amount', $data);
			$this->session->set_flashdata('flash_message', get_phrase('amount_created'));
			redirect(base_url() . 'index.php?reception/manage_rate', 'refresh');
		}
		
		$page_data['page_name']  = 'manage_rate';
		$page_data['page_title'] = get_phrase('manage_rate');
		$page_data['amounts'] = $this->db->get('amount')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
		/***Manage Complain**/
	function manage_complain($param1 = '', $param2 = '', $param3 = '')
	{
		
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
            
			$data['floor_id']          = $this->input->post('floor_id');
			$data['area_id']          = $this->input->post('area_id');
			$data['room_id']          = $this->input->post('room_id');
			$data['comp_type_id']     = $this->input->post('comp_type_id');
			$data['from_person']      = $this->input->post('from_person');
			$data['complain_date']    = date('Y-m-d');
			//$data['complain_date']  = $this->input->post('complain_date');
			$data['current_time']     = date('Y-m-d H:i:s',time());  //added to check
			$data['complain_desc']    = $this->input->post('complain_desc');
			$data['status'] = $this->input->post('status');
			$this->db->insert('complain', $data);
			/*$this->email_model->account_opening_email('doctor', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL*/
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?reception/manage_complain', 'refresh');
		}

		$page_data['page_name']  = 'manage_complain';
		$page_data['page_title'] = get_phrase('manage_complain');
		
		//print_r($_POST);
		
	if ($param1 == 'search')
	{

		$where='1';
		if(isset($_POST['searchfloor']) && $_POST['searchfloor'] !=-1)
		{
	    $floor=$_POST['searchfloor'];
		$where.= "  AND floor_id='$floor'";
		
		}
				if(isset($_POST['searchdate']) && $_POST['searchdate'] !='')
		{
		
		$sdate=date('Y-m-d',strtotime($_POST['searchdate']));
		$where.= " AND complain_date='$sdate'";
		
		
		}
		 if(isset($_POST['searchroom']) && $_POST['searchroom']!=-1 )
		{
							$dr=$_POST['searchroom'];
		$where.= " AND room_id='$dr'";
			
	}

		$page_data['complains']= $this->db->query("SELECT * FROM complain where $where ")->result_array();
		
	}
		else{
		
		$page_data['complains'] = $this->db->get('complain')->result_array();
		}
		$this->load->view('index', $page_data);
	}
		//$page_data['complains']    = $this->db->get('complain')->result_array();
		//$this->load->view('index', $page_data);   

	
	/***Maintenance Complain Type**/
	function maintenance_complain($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {

			$data['complain_title']          = $this->input->post('complain_title');
			$data['description']         = $this->input->post('description');
			
			$this->db->insert('complain_type', $data);
		//	$this->email_model->account_opening_email('complain_type', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?reception/maintenance_complain', 'refresh');
		}

		$page_data['page_name']  = 'maintenance_complain';
		$page_data['page_title'] = get_phrase('maintenance_complain');
		$page_data['complain_types']    = $this->db->get('complain_type')->result_array();
		$this->load->view('index', $page_data);   

	}
	
	/******MANAGE Room*****/
	function manage_room($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['room_name']         = $this->input->post('room_name');
			
			$this->db->insert('room', $data);
			$this->session->set_flashdata('flash_message', get_phrase('room_created'));
			redirect(base_url() . 'index.php?reception/manage_room', 'refresh');
		}
		
		$page_data['page_name']  = 'manage_room';
		$page_data['page_title'] = get_phrase('manage_room');
		$page_data['rooms'] = $this->db->get('room')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/******Assigned Room*****/
	function assigned_room($param1 = '', $param2 = '', $param3 = '' ,$param4 = '')
	{
		
		//print_r($_POST); 
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['room_id']         = $this->input->post('room_id');
			$data['days']              = $this->input->post('days');
		    $data['today_date']        = date('Y-m-d H:i:s', time());
			$data['doctor_id']         = $this->input->post('doctor_id');  
			$data['1_open_time']       = $this->input->post('1_open_time');
			$data['1_close_time']      = $this->input->post('1_close_time');
			$this->db->insert('assignedroom', $data);
			$this->session->set_flashdata('flash_message', get_phrase('assignedroom_created'));
			redirect(base_url() . 'index.php?reception/assigned_room', 'refresh');
		}
	
		$page_data['page_name']  = 'assigned_room';
		$page_data['page_title'] = get_phrase('assigned_room');
		
		
		//print_r($_POST);
	if ($param1 == 'search')
	{
		$where='1 ';
		if(isset($_POST['searchdoctor']) && $_POST['searchdoctor'] !=-1)
		{
			$dr=$_POST['searchdoctor'];
		$where.="AND doctor_id='$dr'";
		}
				if(isset($_POST['searchdate']) && $_POST['searchdate'] !='')
		{
		
				$sdate=date('Y-m-d',strtotime($_POST['searchdate']));
		$where.="AND today_date='$sdate'";

		}
		 if(isset($_POST['searchroom']) && $_POST['searchroom']!=-1 )
		{
							$dr=$_POST['searchroom'];
		$where.="AND room_id='$dr'";
			
	}

		$page_data['assignedrooms']= $this->db->query("SELECT * FROM assignedroom where $where ")->result_array();
		
	}
		else{
		
		$page_data['assignedrooms'] = $this->db->get('assignedroom')->result_array();
		}
		$this->load->view('index', $page_data);
	}
	
	/***Manage Booked**/
	function manage_booked($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['booked_name']          = $this->input->post('booked_name');
		
			$this->db->insert('booked', $data);
			//$this->email_model->account_opening_email('ot', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?reception/manage_booked', 'refresh');
		}
		
		$page_data['page_name']  = 'manage_booked';
		$page_data['page_title'] = get_phrase('manage_booked');
		$page_data['booked_names']    = $this->db->get('booked')->result_array();
		$this->load->view('index', $page_data);   

	}

		 /***Manage OT**/
 	function manage_ot($param1 = '', $param2 = '', $param3 = '')
	{
	  if ($this->session->userdata('reception_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	   
	  if ($param1 == 'create') {
		  
	   $data['ot1_id']              = $this->input->post('ot1_id');
	   $data['patient_id']          = $this->input->post('patient_id');		 
	   $data['doctor_id']          = $this->input->post('doctor_id');
	   $data['anesthesia_name']    = $this->input->post('anesthesia_name');
	   $data['1_open_time']        = $this->input->post('1_open_time');
	   $data['1_close_time']       = $this->input->post('1_close_time');
	   $data['hours']              = $this->input->post('hours');
	   $data['case_date']          = date('Y-m-d', strtotime($this->input->post('case_date')));
	   $data['no_cases']           = $this->input->post('no_cases');
	   $data['surgery_id']         = $this->input->post('surgery_id');
	   $data['category_id']        = $this->input->post('category_id');
	   $data['type_id']            = $this->input->post('type_id');
	   $data['booking_date']       = date('Y-m-d', strtotime($this->input->post('booking_date')));
	   $data['description']        = $this->input->post('description');
	   $data['booked_id']          = $this->input->post('booked_id');
	   $this->db->insert('ot', $data);
	    $id = mysql_insert_id();
	   //$this->email_model->account_opening_email('ot', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
	   $this->session->set_flashdata('flash_message', get_phrase('account_opened'));
	   
	   $total_hours = $this->input->post('hours');
	  
	   $total_hours1 =$total_hours ;
	   //echo $total_hours1.'abcd';
	   //exit;
	   $start_time = $this->input->post('1_open_time');
	   for ($i=0; $i<=$total_hours1*2-1; $i++)
	   {	
			$data1['ot_date'] = date('Y-m-d', strtotime($this->input->post('case_date')));
			
			$data1['book_time']  = $start_time;
			$data1['ot_master_id']  = $id;
			$end_time = strtotime($start_time . ' + 30 minutes '); 
			$data1['end_time']  = date('H:i',$end_time); 
			$this->db->insert('ot_details', $data1);
			//if($i+1>$total_hours)
			$start_time = strtotime($start_time . ' + 30 minutes ');  
				//else			
			//$start_time = strtotime($start_time . ' + 1 hours');  
			
			$start_time = date("H:i",$start_time);
	   }
	   redirect(base_url() . 'index.php?reception/manage_ot', 'refresh');
	  }
	   	  
	  if ($param1 == 'edit' && $param2 == 'do_update')
	   {
	   $data['ot1_id']          = $this->input->post('ot1_id');	
	   $data['patient_id']          = $this->input->post('patient_id');	
	   $data['doctor_id']          = $this->input->post('doctor_id');
	   $data['anesthesia_name']    = $this->input->post('anesthesia_name');
	   $data['1_open_time']         = $this->input->post('1_open_time');
	   $data['1_close_time']         = $this->input->post('1_close_time');
	   $data['hours']                 = $this->input->post('hours');
	   $data['case_date']             = date('Y-m-d', strtotime($this->input->post('case_date')));
	   $data['no_cases']               = $this->input->post('case_date');
	   $data['surgery_id']        = $this->input->post('surgery_id');
	   $data['category_id']        = $this->input->post('category_id');
	   $data['type_id']            = $this->input->post('type_id');
	   $data['booking_date']            = date('Y-m-d', strtotime($this->input->post('booking_date')));
	   $data['description']              = $this->input->post('description');
	   $data['booked_id']                = $this->input->post('booked_id');
	   
	   $this->db->where('ot_id', $param3);
	   $this->db->update('ot', $data);
	   $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
	   
	   redirect(base_url() . 'index.php?reception/manage_ot', 'refresh');
	  } 
	  
	  else if ($param1 == 'edit')
	   {
	   $page_data['edit_profile'] = $this->db->get_where('ot', array(
		'ot_id' => $param2
	   ))->result_array();
	  }
	  if ($param1 == 'delete') {
	   $this->db->where('ot_id', $param2);
	   $this->db->delete('ot');
	   $this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
	   
	   $this->db->where('ot_master_id', $param2);
	   $this->db->delete('ot_details');
	   $this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
	   
	   redirect(base_url() . 'index.php?reception/manage_ot', 'refresh');
	
	  }
	  $page_data['page_name']  = 'manage_ot';
	  $page_data['page_title'] = get_phrase('manage_ot');
	  $page_data['ot1']    = $this->db->get('ot')->result_array();
	  $this->load->view('index', $page_data);   
	
	 }
	 
	 	 	/******MANAGE OT SCHEDULES1*****/
	function ot_schedules1($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'ot_schedules1';
		$page_data['page_title'] = get_phrase('OT Schedules 1');	
		//$sql = "SELECT * FROM ot ";
		//$page_data['ot1']= $this->db->query("SELECT * FROM ot where ot1_id =1")->result_array();	
		//$page_data['ot2']= $this->db->query("SELECT * FROM ot where ot1_id =2")->result_array();	
		$this->load->view('index', $page_data);
	}
	
		 	/******MANAGE OT SCHEDULES2*****/
	function ot_schedules2($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'ot_schedules2';
		$page_data['page_title'] = get_phrase('OT Schedules 2');	
		//$sql = "SELECT * FROM ot ";
		//$page_data['ot1']= $this->db->query("SELECT * FROM ot where ot1_id =1")->result_array();	
		//$page_data['ot2']= $this->db->query("SELECT * FROM ot where ot1_id =2")->result_array();	
		$this->load->view('index', $page_data);
	}
	 
	  	/******MANAGE OT SCHEDULES3*****/
	function ot_schedules3($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'ot_schedules3';
		$page_data['page_title'] = get_phrase('OT Schedules 3');	
		//$sql = "SELECT * FROM ot ";
		//$page_data['ot1']= $this->db->query("SELECT * FROM ot where ot1_id =1")->result_array();	
		//$page_data['ot2']= $this->db->query("SELECT * FROM ot where ot1_id =2")->result_array();	
		$this->load->view('index', $page_data);
	}
	
	/******VIEW BLOOD BANK*****/
	function view_blood_bank($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']    = 'view_blood_bank';
		$page_data['page_title']   = get_phrase('view_blood_bank');
		$page_data['blood_donors'] = $this->db->get('blood_donor')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	
	/******MANAGE BILLING / INVOICES WITH STATUS*****/
	function manage_invoice($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
		
			$data['patient_id']         = $this->input->post('patient_id');
			$data['invoice_number']     = $this->input->post('invoice_no');
			$data['doctor_id']         = $this->input->post('doctor_id');
			/*$data['service_id']       = $this->input->post('service_id');*/
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
			$data['med_card_no']         = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']      = $this->input->post('discountamount');
			$data['discount']            = $this->input->post('discount');
			$data['recievedamount']      = $this->input->post('recievedamount');
			$data['dueamount']           = $this->input->post('dueamount');
			$data['careof']             = $this->input->post('careof');
			$data['createdby']          = $this->input->post('createdby');
			$data['creation_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			$data['creation_time'] = date('Y-m-d H:i', time());
			$data['approved']=0;
			if($data['discount']>=10)
			{
				$data['need_approval']=1;  //
				}
				else
				{$data['need_approval']=0;} //
			
			//if ( $this->input->post('discount') > 100 )
			if($data['discount']>=100)
			{
				redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
				return;	
			}
			
			$this->db->insert('invoice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('invoice_created'));
			header('location: application/helpers/viewreceipt.php?r='.$this->input->post('invoice_no'));
			redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_id']  = $this->input->post('patient_id');
			$data['doctor_id']  = $this->input->post('doctor_id');
			/*$data['service_id']  = $this->input->post('service_id');*/
			$data['diagnostictype_id']            = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']            = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
			$data['med_card_no']         = $this->input->post('med_card_no');
			$data['totalamount']              = $this->input->post('totalamount');
			$data['discountamount']              = $this->input->post('discountamount');
			$data['discount']              = $this->input->post('discount');
			$data['recievedamount']              = $this->input->post('recievedamount');
			$data['dueamount']        = $this->input->post('dueamount');
			$data['careof']             = $this->input->post('careof');
			$data['createdby']             = $this->input->post('createdby');
			$data['creation_timestamp']      = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			
			$this->db->where('invoice_id', $param3);
			$this->db->update('invoice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('invoice_updated'));
			
			redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('invoice', array(
				'invoice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('invoice_id', $param2);
			$this->db->delete('invoice');
			$this->session->set_flashdata('flash_message', get_phrase('invoice_deleted'));
			redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
		}
		$page_data['page_name']  = 'manage_invoice';
		$page_data['page_title'] = get_phrase('manage_invoice');
		$this->db->order_by('creation_timestamp', 'desc');
		$page_data['invoices'] = $this->db->get('invoice')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/******RECIEVE CASH/HAND 2 HAND PAYMENT AGAINST A CERTAIN INVOICE******/
	function take_cash_payment($invoice_id = '', $param2 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		$data['payment_type']   = $this->input->post('payment_type');
		$data['transaction_id'] = rand(100000, 1000000);
		$data['invoice_id']     = $this->input->post('invoice_id');
		$data['patient_id']     = $this->input->post('patient_id');
		$data['method']         = $this->input->post('method');
		$data['description']    = $this->input->post('description');
		$data['amount']         = $this->input->post('amount');
		$data['timestamp']      = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
		
		$this->db->insert('payment', $data);
		
		$this->db->where('invoice_id', $this->input->post('invoice_id'));
		$this->db->update('invoice', array(
			'status' => 'paid'
		));
		$this->session->set_flashdata('flash_message', get_phrase('payment_created'));
		redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
		
	}
	
	/******MANAGE BILLING/ MAKE PAYMENT*****/
	function view_payment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']  = 'view_payment';
		$page_data['page_title'] = get_phrase('view_payment');
		$page_data['payments']   = $this->db->get_where('payment')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
	function manage_profile($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($param1 == 'update_profile_info') {
			$data['name']    = $this->input->post('name');
			$data['email']   = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['phone']   = $this->input->post('phone');
			
			$this->db->where('reception_id', $this->session->userdata('reception_id'));
			$this->db->update('reception', $data);
			$this->session->set_flashdata('flash_message', get_phrase('profile_updated'));
			redirect(base_url() . 'index.php?reception/manage_profile/', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['password']             = $this->input->post('password');
			$data['new_password']         = $this->input->post('new_password');
			$data['confirm_new_password'] = $this->input->post('confirm_new_password');
			
			$current_password = $this->db->get_where('reception', array(
				'reception_id' => $this->session->userdata('reception_id')
			))->row()->password;
			if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
				$this->db->where('reception_id', $this->session->userdata('reception_id'));
				$this->db->update('reception', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
			} else {
				$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
			}
			redirect(base_url() . 'index.php?reception/manage_profile/', 'refresh');
		}
		$page_data['page_name']    = 'manage_profile';
		$page_data['page_title']   = get_phrase('manage_profile');
		$page_data['edit_profile'] = $this->db->get_where('reception', array(
			'reception_id' => $this->session->userdata('reception_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}
	
 /****** Genaral Complain*****/
	function general_complain($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
		
		    $data['incident_date']           = date('Y-m-d');
			$data['incident_time']           = date('Y-m-d H:i:s',time());  //added to check
			$data['description']         = $this->input->post('description');
			$data['status']         = $this->input->post('status');
			$data['option']         = $this->input->post('option');
			$this->db->insert('general_complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_created'));
			redirect(base_url() . 'index.php?reception/general_complain', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			/*$data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));*/
			$data['description']         = $this->input->post('description');
			$data['status']         = $this->input->post('status');
			$data['option']         = $this->input->post('option');
			
			$this->db->where('general_comp_id', $param3);
			$this->db->update('general_complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_updated'));
			
			redirect(base_url() . 'index.php?reception/general_complain', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('general_complain', array(
				'general_comp_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('general_comp_id', $param2);
			$this->db->delete('general_complain');
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_deleted'));
			redirect(base_url() . 'index.php?reception/general_complain', 'refresh');
		}
		$page_data['page_name']  = 'general_complain';
		$page_data['page_title'] = get_phrase('general_complain');
		$page_data['general_complains'] = $this->db->get('general_complain')->result_array();
		
		$this->load->view('index', $page_data);
	}
 
 /****** Complain Management*****/
 /*
 function complain_management($param1 = '', $param2 = '', $param3 = '')
 {
  if ($this->session->userdata('reception_login') != 1)
   redirect(base_url() . 'index.php?login', 'refresh');
  
  if ($param1 == 'create') {
   $data['employee_id']         = $this->input->post('employee_id');
   $data['complainby']         = $this->input->post('complainby');
   $data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));
   $data['description']         = $this->input->post('description');
   $data['status']         = $this->input->post('status');
   $data['option']         = $this->input->post('option');
   $this->db->insert('complain_management', $data);
   $this->session->set_flashdata('flash_message', get_phrase('complain_management_created'));
   redirect(base_url() . 'index.php?reception/complain_management', 'refresh');
  }
  
  $page_data['page_name']  = 'complain_management';
  $page_data['page_title'] = get_phrase('complain_management');
  $page_data['complain_managements'] = $this->db->get('complain_management')->result_array();
  
  $this->load->view('index', $page_data);
 }

*/

	/****** Complain Management*****/
		function complain_management($param1 = '', $param2 = '', $param3 = '')
		{
			if ($this->session->userdata('reception_login') != 1)
				redirect(base_url() . 'index.php?login', 'refresh');
			
			if ($param1 == 'create') {
				$data['employee_id']         = $this->input->post('employee_id');
				$data['complainby']         = $this->input->post('complainby');
				/*$data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));*/
				$data['incident_date']           = date('Y-m-d');
				$data['incident_time']           = date('Y-m-d H:i:s',time()); 
				$data['description']         = $this->input->post('description');
				$data['status']         = $this->input->post('status');
				$data['option']         = $this->input->post('option');
				$this->db->insert('complain_management', $data);
				$this->session->set_flashdata('flash_message', get_phrase('complain_management_created'));
				redirect(base_url() . 'index.php?reception/complain_management', 'refresh');
			}
			if ($param1 == 'edit' && $param2 == 'do_update') {
				$data['employee_id']         = $this->input->post('employee_id');
				$data['complainby']         = $this->input->post('complainby');
				//$data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));
				$data['description']         = $this->input->post('description');
				$data['status']         = $this->input->post('status');
				$data['option']         = $this->input->post('option');
				
				$this->db->where('comp_manag_id', $param3);
				$this->db->update('complain_management', $data);
				$this->session->set_flashdata('flash_message', get_phrase('complain_management_updated'));
				
				redirect(base_url() . 'index.php?reception/complain_management', 'refresh');
			} else if ($param1 == 'edit') {
				$page_data['edit_profile'] = $this->db->get_where('complain_management', array(
					'comp_manag_id' => $param2
				))->result_array();
			}
			if ($param1 == 'delete') {
				$this->db->where('comp_manag_id', $param2);
				$this->db->delete('complain_management');
				$this->session->set_flashdata('flash_message', get_phrase('complain_management_deleted'));
				redirect(base_url() . 'index.php?reception/complain_management', 'refresh');
			}
			$page_data['page_name']  = 'complain_management';
			$page_data['page_title'] = get_phrase('complain_management');
			$page_data['complain_managements'] = $this->db->get('complain_management')->result_array();
			
			$this->load->view('index', $page_data);
		}

	/******MANAGE SERVICE*****/
	 function manage_service($param1 = '', $param2 = '', $param3 = '')
	 {
	  if ($this->session->userdata('reception_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	  
	  if ($param1 == 'create') {
	   $data['service_name']         = $this->input->post('service_name');
	   $data['maincategory']         = $this->input->post('maincategory');
	   $data['totalamount']         = $this->input->post('totalamount');
	   $data['share']         = $this->input->post('share');
	   
	   $this->db->insert('service', $data);
	   $this->session->set_flashdata('flash_message', get_phrase('service_created'));
	   redirect(base_url() . 'index.php?reception/manage_service', 'refresh');
	  }
	  
	  $page_data['page_name']  = 'manage_service';
	  $page_data['page_title'] = get_phrase('manage_service');
	  $page_data['services'] = $this->db->get('service')->result_array();
	  
	  $this->load->view('index', $page_data);
	 }

		/******MANAGE Employee list****/
	 function manage_employee($param1 = '', $param2 = '', $param3 = '')
	 {
	  if ($this->session->userdata('reception_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	  
	  if ($param1 == 'create') {
	   $data['emp_name']         = $this->input->post('emp_name');
	   $data['dept']         = $this->input->post('dept');
	   
	   $this->db->insert('employee', $data);
	   $this->session->set_flashdata('flash_message', get_phrase('employee_created'));
	   redirect(base_url() . 'index.php?reception/manage_employee', 'refresh');
	  }
	  
	  $page_data['page_name']  = 'manage_employee';
	  $page_data['page_title'] = get_phrase('manage_employee');
	  $page_data['employees'] = $this->db->get('employee')->result_array();
	  
	  $this->load->view('index', $page_data);
	 }

		/******Room Charges*****/
		 function room_charges($param1 = '', $param2 = '', $param3 = '')
		 {
		  if ($this->session->userdata('reception_login') != 1)
		   redirect(base_url() . 'index.php?login', 'refresh');
		  
		  if ($param1 == 'create') {
		   $data['room_type']         = $this->input->post('room_type');
		   $data['charges']         = $this->input->post('charges');
		   
		   $this->db->insert('room_charges', $data);
		   $this->session->set_flashdata('flash_message', get_phrase('roomcharges_created'));
		   redirect(base_url() . 'index.php?reception/room_charges', 'refresh');
		  }
		  
		  $page_data['page_name']  = 'room_charges';
		  $page_data['page_title'] = get_phrase('room_charges');
		  $page_data['roomcharges'] = $this->db->get('room_charges')->result_array();
		  
		  $this->load->view('index', $page_data);
		 }

 /******MANAGE floor*****/
	function manage_floor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['floor_name']         = $this->input->post('floor_name');
			
			$this->db->insert('floor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('floor_created'));
			redirect(base_url() . 'index.php?reception/manage_floor', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['floor_name']  = $this->input->post('floor_name');
			
			$this->db->where('floor_id', $param3);
			$this->db->update('floor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('floor_updated'));
			
			redirect(base_url() . 'index.php?reception/manage_floor', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('floor', array(
				'floor_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('floor_id', $param2);
			$this->db->delete('floor');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?reception/manage_floor', 'refresh');
		}
		$page_data['page_name']  = 'manage_floor';
		$page_data['page_title'] = get_phrase('manage_floor');
		$page_data['floors'] = $this->db->get('floor')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
 	/******MANAGE Area*****/
	function manage_area($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
		   
			$data['area']         = $this->input->post('area');
			$data['floor_id']         = $this->input->post('floor_id');
			$this->db->insert('area', $data);
			$this->session->set_flashdata('flash_message', get_phrase('area_created'));
			redirect(base_url() . 'index.php?reception/manage_area', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['area']  = $this->input->post('area');
			$data['floor_id']         = $this->input->post('floor_id');
			$this->db->where('area_id', $param3);
			$this->db->update('area', $data);
			$this->session->set_flashdata('flash_message', get_phrase('area_updated'));
			
			redirect(base_url() . 'index.php?reception/manage_area', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('floor', array(
				'areea_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('area_id', $param2);
			$this->db->delete('area');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?reception/manage_area', 'refresh');
		}
		$page_data['page_name']  = 'manage_area';
		$page_data['page_title'] = get_phrase('manage_area');
		$page_data['areas'] = $this->db->get('area')->result_array();
		
		$this->load->view('index', $page_data);
	}

	/******MANAGE SCHEDULES*****/
	function ipdaddservice($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'ipdaddservice';
		$page_data['page_title'] = get_phrase('IPD Services');
		
		$this->load->view('index', $page_data);
	}
	
	function generateInvoice($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'viewreceipt';
		$page_data['page_title'] = get_phrase('Generated Invoice');
		
		$this->load->view('index', $page_data);
	}
	
	/******Surgery Type*****/
	function surgery_types($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['desc']         = $this->input->post('desc');
			
			$this->db->insert('surgery_type', $data);
			$this->session->set_flashdata('flash_message', get_phrase('surgery_types_created'));
			redirect(base_url() . 'index.php?reception/surgery_types', 'refresh');
		}
		
	
		$page_data['page_name']  = 'surgery_types';
		$page_data['page_title'] = get_phrase('surgery_types');
		$page_data['surgery_types'] = $this->db->get('surgery_type')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	 /******Category*****/
	function manage_category($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['category_name']         = $this->input->post('category_name');
			$data['surgery_id']         = $this->input->post('surgery_id');
			
			$this->db->insert('category', $data);
			$this->session->set_flashdata('flash_message', get_phrase('category_created'));
			redirect(base_url() . 'index.php?reception/manage_category', 'refresh');
		}
	
		$page_data['page_name']  = 'manage_category';
		$page_data['page_title'] = get_phrase('manage_category');
		$page_data['categorys'] = $this->db->get('category')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/******Surgery*****/
	function surgery($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['surgery_id']         = $this->input->post('surgery_id');
			$data['category_id']         = $this->input->post('category_id');
			$data['type']         = $this->input->post('type');
			
			$this->db->insert('surgery', $data);
			$this->session->set_flashdata('flash_message', get_phrase('category_created'));
			redirect(base_url() . 'index.php?reception/surgery', 'refresh');
		}
	
		
		$page_data['page_name']  = 'surgery';
		$page_data['page_title'] = get_phrase('surgery');
		$page_data['surgerys'] = $this->db->get('surgery')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/***Diagnostic Service**/
	function diagnostic_service($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['diagnostictype_id']          = $this->input->post('diagnostictype_id');
			$data['name']          = $this->input->post('name');
			$data['corporatecharges']          = $this->input->post('corporatecharges');
			
			$this->db->insert('diagnosticservice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?reception/diagnostic_service', 'refresh');
		}
		
		$page_data['page_name']  = 'diagnostic_service';
		$page_data['page_title'] = get_phrase('diagnostic_service');
		$page_data['diagnosticservices']    = $this->db->get('diagnosticservice')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Diagnostic Type**/
	function diagnostic_type($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			
			$data['name']          = $this->input->post('name');
			
			$this->db->insert('diagnostictype', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?reception/diagnostic_type', 'refresh');
		}
		
		$page_data['page_name']  = 'diagnostic_type';
		$page_data['page_title'] = get_phrase('diagnostic_type');
		$page_data['diagnostictypes']    = $this->db->get('diagnostictype')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/*****LIST OF BED, MANAGE THIER TYPES********/
	function manage_bed($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['bed_number']  = $this->input->post('bed_number');
			$data['type']        = $this->input->post('type');
			$data['charges']        = $this->input->post('charges');
			$data['status']      = $this->input->post('status');
			$data['description'] = $this->input->post('description');
			$this->db->insert('bed', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			
			redirect(base_url() . 'index.php?reception/manage_bed', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['bed_number']  = $this->input->post('bed_number');
			$data['type']        = $this->input->post('type');
			$data['charges']        = $this->input->post('charges');
			$data['status']      = $this->input->post('status');
			$data['description'] = $this->input->post('description');
			$this->db->where('bed_id', $param3);
			$this->db->update('bed', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			redirect(base_url() . 'index.php?reception/manage_bed', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('bed', array(
				'bed_id' => $param2
			))->result_array();
		}
		if ($param1 == 'view_bed_history') {
			$page_data['view_bed_history_id'] = $this->db->get_where('bed_allotment', array(
				'bed_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('bed_id', $param2);
			$this->db->delete('bed');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?reception/manage_bed', 'refresh');
		}
		$page_data['page_name']  = 'manage_bed';
		$page_data['page_title'] = get_phrase('manage_bed');
		$page_data['beds']       = $this->db->get('bed')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/******ALLOT / DISCHARGE BED TO PATIENTS*****/
	function manage_bed_allotment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['bed_id']              = $this->input->post('bed_id');
			$data['patient_id']          = $this->input->post('patient_id');
			$data['allotment_timestamp'] = strtotime($this->input->post('allotment_timestamp'));
			$data['discharge_timestamp'] = strtotime($this->input->post('discharge_timestamp'));
		    $data['allotment_time']       = date('Y-m-d H:i', time());
			$currtime=date('Y-m-d H:i', time());
			$data['status']      = 1 ;
			$this->db->insert('bed_allotment', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			

			$data = array('bed_id'=>$this->input->post('bed_id'),
                'patient_id'=>$this->input->post('patient_id'),
                'transferdate'=>$currtime,'status'=>1);

            $this->db->insert('patient_bed_mapping',$data);

			redirect(base_url() . 'index.php?reception/manage_bed_allotment', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['bed_id']              = $this->input->post('bed_id');
			$data['patient_id']          = $this->input->post('patient_id');
			$data['allotment_timestamp'] = strtotime($this->input->post('allotment_timestamp'));
			$data['discharge_timestamp'] = strtotime($this->input->post('discharge_timestamp'));
			$data['allotment_time']       = date('Y-m-d H:i', time());
			$this->db->where('bed_allotment_id', $param3);
			$this->db->update('bed_allotment', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			redirect(base_url() . 'index.php?reception/manage_bed_allotment', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('bed_allotment', array(
				'bed_allotment_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('bed_allotment_id', $param2);
			$this->db->delete('bed_allotment');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?reception/manage_bed_allotment', 'refresh');
		}
		$page_data['page_name']     = 'manage_bed_allotment';
		$page_data['page_title']    = get_phrase('manage_bed_allotment');
		$page_data['bed_allotment'] = $this->db->get('bed_allotment')->result_array();
		$this->load->view('index', $page_data);
	}
	
	 /******bed Sschedule*****/
   	function bed_schedule($param1 = '', $param2 = '', $param3 = '')
    {
      if ($this->session->userdata('reception_login') != 1)
       redirect(base_url() . 'index.php?login', 'refresh');
     
      $page_data['page_name']  = 'bed_schedule';
      $page_data['page_title'] = get_phrase('bed_schedule');
	  
      $page_data['sdate'] = $param1.'/'.$param2.'/'.$param3;
	  
      $this->load->view('index', $page_data);
     }
	 
	 	// *****bed transfer****
 	function bed_transfer($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('reception_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') 
		{
			 $sql1 = "update patient_bed_mapping set status = 0 where patient_id = ".$this->input->post('patient_id')." and bed_id=".$this->input->post('bed_post_id')." and status=1";
		   
		    mysql_query($sql1);
			$result=mysql_fetch_assoc($sql1);
			
			
	/*	$data = array('status' =>0);
		$where = "patient_id=".$this->input->post('patient_id')."  AND bed_id = ".$this->input->post('bed_id')." AND status=1 ";
		$str = $this->db->update_string('patient_bed_mapping', $data, $where);*/ 

			$data['patient_id']  = $this->input->post('patient_id');
			$data['bed_id']        = $this->input->post('bed_id');
			$data['status']        = 1 ;
			$data['transferdate']        = date('Y-m-d H:i:s', time());

			$this->db->insert('patient_bed_mapping', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
          
			redirect(base_url() . 'index.php?reception/bed_transfer', 'refresh');
         
		  
		}

		$page_data['page_name']  = 'bed_transfer';
		$page_data['page_title'] = get_phrase('bed_transfer');
		$page_data['patient_bed_mappings']       = $this->db->get('patient_bed_mapping')->result_array();
		$this->load->view('index', $page_data);
	}
	
		  /******daily reception sale *****/
		  
	 function daily_receptionsale($param1 = '', $param2 = '', $param3 = '')
	 {
	  if ($this->session->userdata('reception_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	  
	  
	  $page_data['page_name']  = 'Daily_receptionsale';
	  $page_data['page_title'] = get_phrase('daily_receptionsale');
	  $page_data['invoices'] = $this->db->get('invoice')->result_array();
	  
	  $this->load->view('index', $page_data);
	 }
	 
	 function daily_cash_summary($param1 = '', $param2 = '', $param3 = '')
	 {
	  if ($this->session->userdata('reception_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	  
	  
	  $page_data['page_name']  = 'daily_cash_summary';
	  $page_data['page_title'] = get_phrase('Daily_Cash_Summary');
	  $page_data['invoices'] = $this->db->get('invoice')->result_array();
	  
	  $this->load->view('index', $page_data);
	 }
	 

}