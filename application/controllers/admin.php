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

class Admin extends CI_Controller
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
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($this->session->userdata('admin_login') == 1)
			redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
	}
	
	/***ADMIN DASHBOARD***/
	function dashboard()
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = get_phrase('admin_dashboard');
		$this->load->view('index', $page_data);
	}
	
	/***DEPARTMENTS OF DOCTORS********/
	function manage_department($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->insert('department', $data);
			$this->session->set_flashdata('flash_message', get_phrase('department_opened'));
			redirect(base_url() . 'index.php?admin/manage_department', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->where('department_id', $param3);
			$this->db->update('department', $data);
			$this->session->set_flashdata('flash_message', get_phrase('department_updated'));
			redirect(base_url() . 'index.php?admin/manage_department', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('department', array(
				'department_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('department_id', $param2);
			$this->db->delete('department');
			$this->session->set_flashdata('flash_message', get_phrase('department_deleted'));
			redirect(base_url() . 'index.php?admin/manage_department', 'refresh');
		}
		$page_data['page_name']   = 'manage_department';
		$page_data['page_title']  = get_phrase('manage_department');
		$page_data['departments'] = $this->db->get('department')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage Doctor Schedule**/
	function doctor_schedule($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['days']          = $this->input->post('days');
			$data['doctor_id']          = $this->input->post('doctor_id');
			$data['1_open_time'] = $this->input->post('1_open_time');
			$data['1_close_time'] = $this->input->post('1_close_time');
			
			$this->db->insert('schedule', $data);
			//$this->email_model->account_opening_email('speciality', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/doctor_schedule', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['days']          = $this->input->post('days');
			$data['1_open_time'] = $this->input->post('1_open_time');
			$data['1_close_time'] = $this->input->post('1_close_time');
	
			$this->db->where('timing_id', $param3);
			$this->db->update('schedule', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/doctor_schedule', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('schedule', array(
				'timing_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('timing_id', $param2);
			$this->db->delete('schedule');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/doctor_schedule', 'refresh');
		}
		$page_data['page_name']  = 'doctor_schedule';
		$page_data['page_title'] = get_phrase('doctor_schedule');
		$page_data['schedules']    = $this->db->get('schedule')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage Doctor Speciality**/
	function doctor_speciality($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['speciality_name']          = $this->input->post('speciality_name');
			$data['sub_speciality']          = $this->input->post('sub_speciality');
			
			$this->db->insert('speciality', $data);
			//$this->email_model->account_opening_email('speciality', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/doctor_speciality', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['speciality_name']          = $this->input->post('speciality_name');
			$data['sub_speciality']          = $this->input->post('sub_speciality');
			
			$this->db->where('speciality_id', $param3);
			$this->db->update('speciality', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/doctor_speciality', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('speciality', array(
				'speciality_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('speciality_id', $param2);
			$this->db->delete('speciality');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/doctor_speciality', 'refresh');
		}
		$page_data['page_name']  = 'doctor_speciality';
		$page_data['page_title'] = get_phrase('doctor_speciality');
		$page_data['specialitys']    = $this->db->get('speciality')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage doctors**/
	function manage_doctor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
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
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']          = $this->input->post('name');
			$data['email']         = $this->input->post('email');
			$data['password']      = $this->input->post('password');
			$data['address']       = $this->input->post('address');
			$data['phone']         = $this->input->post('phone');
			$data['doj']         = $this->input->post('doj');
			$data['ratio']         = $this->input->post('ratio');
			$data['department_id'] = $this->input->post('department_id');
			$data['created_by'] = $this->input->post('created_by');
			//$data['profile']       = $this->input->post('profile');
			
			$this->db->where('doctor_id', $param3);
			$this->db->update('doctor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('doctor', array(
				'doctor_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('doctor_id', $param2);
			$this->db->delete('doctor');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		}
		$page_data['page_name']  = 'manage_doctor';
		$page_data['page_title'] = get_phrase('manage_doctor');
		$page_data['doctors']    = $this->db->get('doctor')->result_array();
		$this->load->view('index', $page_data);
		
	}
	/*
	function manage_patient($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['patient_reg_no']            = $this->input->post('patient_reg_no');
			$data['doctor_id']                 = $this->input->post('doctor_id');
			$data['patient_type']              = $this->input->post('patient_type');
			$data['refferedby']                = $this->input->post('refferedby');
			$data['med_card_no']               = $this->input->post('med_card_no');
			$data['salutation']                = $this->input->post('salutation');
			$data['name']                      = $this->input->post('name');
			$data['father_husbandname']        = $this->input->post('father_husbandname');
			$data['email']                     = $this->input->post('email');
			$data['password']                  = $this->input->post('password');
			$data['nic_no']         = $this->input->post('start_5').'-'.$this->input->post('mid_7').'-'.$this->input->post('end_1');
			$data['address']                   = $this->input->post('address');
			$data['phone']                     = $this->input->post('phone');
			$data['sex']                       = $this->input->post('sex');
			$data['birth_date']                = $this->input->post('birth_date');
			$data['age']                       = $this->input->post('age');
			$data['blood_group']               = $this->input->post('blood_group');
			$data['account_opening_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			$this->db->insert('patient', $data);
			$id = mysql_insert_id();
			$this->email_model->account_opening_email('patient', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			$reg_no = 'MR-'.date('ym-', time()).str_pad($id, 4, '0', STR_PAD_LEFT);
			
			$conn = mysql_connect('localhost', 'root','');
			mysql_select_db ('incisivermc');
			$sql = "update patient set patient_reg_no = '".$reg_no."' where patient_id = $id";
			$r = mysql_query ($sql, $conn);
			
			redirect(base_url() . 'index.php?admin/manage_patient', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
		    $data['doctor_id']             = $this->input->post('doctor_id');
			 $data['patient_reg_no']       = $this->input->post('patient_reg_no');
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
			
			redirect(base_url() . 'index.php?admin/manage_patient', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('patient', array(
				'patient_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('patient_id', $param2);
			$this->db->delete('patient');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_patient', 'refresh');
		}
		$page_data['page_name']  = 'manage_patient';
		$page_data['page_title'] = get_phrase('manage_patient');
		//$this->db->order_by("patient_reg_no","desc");
		$page_data['patients']   = $this->db->get('patient')->result_array();
		$this->load->view('index', $page_data);
	}
	*/
	
	function manage_patient($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['patient_reg_no']            = $this->input->post('patient_reg_no');
			$data['doctor_id']                 = $this->input->post('doctor_id');
			$data['patient_type']              = $this->input->post('patient_type');
			$data['refferedby']                = $this->input->post('refferedby');
			$data['med_card_no']               = $this->input->post('med_card_no');
			$data['salutation']                = $this->input->post('salutation');
			$data['name']                      = $this->input->post('name');
			$data['father_husbandname']        = $this->input->post('father_husbandname');
			$data['email']                     = $this->input->post('email');
			$data['password']                  = $this->input->post('password');
			$data['nic_no']                   = $this->input->post('start_5').'-'.$this->input->post('mid_7').'-'.$this->input->post('end_1');
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
			
			
			redirect(base_url() . 'index.php?admin/manage_patient', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update')
		 {
			
          	if(isset($_POST['readmit']))
			
		    {

			include 'application/helpers/mydb.php';
			$sql_history = "INSERT INTO patienthistory select * from patient where patient_reg_no = '".$this->input->post('patient_reg_no')."'";
			mysql_query($sql_history);
			$current_date = date('Y-m-d H:i', time());
			$sql_update_discharge_datetype = "update patient SET discharge_type = NULL, discharge_date = NULL, admission_date = '$current_date' WHERE patient_reg_no =  '".$this->input->post('patient_reg_no')."'";
		  //echo $sql2; exit;
		 
				 mysql_query($sql_update_discharge_datetype);
				
				} //isset
		  
		    $data['doctor_id']             = $this->input->post('doctor_id');
			$data['patient_reg_no']        = $this->input->post('patient_reg_no');
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
			
			redirect(base_url() . 'index.php?admin/manage_patient', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('patient', array(
				'patient_id' => $param2
			))->result_array();
		}
		  
		
		if ($param1 == 'delete') {
			$this->db->where('patient_id', $param2);
			$this->db->delete('patient');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_patient', 'refresh');
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
			  if ($this->session->userdata('admin_login') != 1)
			   redirect(base_url() . 'index.php?login', 'refresh');

			  $page_data['page_name']  = 'dischargepatient';
			  $page_data['page_title'] = get_phrase('discharge patient');
			  $page_data['patients']   = $this->db->get('patient')->result_array();
			   
			  $this->load->view('index', $page_data);
			 }
	
	/******MANAGE IPDAdd Service*****/
	function ipdaddservice($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'ipdaddservice';
		$page_data['page_title'] = get_phrase('IPD Services');
		$this->load->view('index', $page_data);
	}
	
	
	/***Manage Nurses**/
	function manage_nurse($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('nurse', $data);
			$this->email_model->account_opening_email('nurse', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/manage_nurse', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('nurse_id', $param3);
			$this->db->update('nurse', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_nurse', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('nurse', array(
				'nurse_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('nurse_id', $param2);
			$this->db->delete('nurse');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_nurse', 'refresh');
		}
		$page_data['page_name']  = 'manage_nurse';
		$page_data['page_title'] = get_phrase('manage_nurse');
		$page_data['nurses']     = $this->db->get('nurse')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage pharmacists**/
	function manage_pharmacist($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('pharmacist', $data);
			$this->email_model->account_opening_email('pharmacist', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?admin/manage_pharmacist', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('pharmacist_id', $param3);
			$this->db->update('pharmacist', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_pharmacist', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('pharmacist', array(
				'pharmacist_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('pharmacist_id', $param2);
			$this->db->delete('pharmacist');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_pharmacist', 'refresh');
		}
		$page_data['page_name']   = 'manage_pharmacist';
		$page_data['page_title']  = get_phrase('manage_pharmacist');
		$page_data['pharmacists'] = $this->db->get('pharmacist')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	
	function manage_laboratorist($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('laboratorist', $data);
			$this->email_model->account_opening_email('laboratorist', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?admin/manage_laboratorist', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('laboratorist_id', $param3);
			$this->db->update('laboratorist', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_laboratorist', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('laboratorist', array(
				'laboratorist_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('laboratorist_id', $param2);
			$this->db->delete('laboratorist');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?admin/manage_laboratorist', 'refresh');
		}
		$page_data['page_name']     = 'manage_laboratorist';
		$page_data['page_title']    = get_phrase('laboratorists');
		$page_data['laboratorists'] = $this->db->get('laboratorist')->result_array();
		$this->load->view('index', $page_data);
	}
	function Manage_Shift_Closed($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'Create_Shift_Closed') {
			$data['Cash_Recieved']     = $this->input->post('Cash_Recieved');
			$data['Total_bill']    = $this->input->post('Total_bill');
			$data['Total_cash'] = $this->input->post('Total_cash');
			$data['Available_Cash']  = $this->input->post('Available_Cash');
			// print_r($data); exit();
			$data['reason']    = $this->input->post('reason');
			$data['admin_id']    = $this->session->userdata('admin_id');
			$data['name'] = $this->session->userdata('admin_name');
			$data['Closing_Date'] =   date ('Y/m/d');
		  //    $this->db->select('ad.name as adminname');
    //         $this->db->from('admin ad');
    //         $this->db->join('Manage_Shift_Closed msc', 'msc.admin_id = ad.admin_id');
    //         $managedata = $this->db->get();
    //         // $data = $data->result();
 			// $abc = $managedata->row()->adminname;  
 			// $data['name'] = $abc;    
    //     print_r($data);
            // if($data->num_row() > 0){
           
             // print_r($data);
             // exit();
			$this->db->insert('Manage_Shift_Closed', $data);
            // print_r($data); exit();
            // exit;
			// $this->email_model->account_opening_email('laboratorist', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			 $this->session->set_flashdata('flash_message', get_phrase('Shift_Closed'));
			redirect(base_url() . 'index.php?admin/Manage_Shift_Closed', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['Cash_Recieved']     = $this->input->post('Cash_Recieved');
			$data['Total_bill']    = $this->input->post('Total_bill');
			$data['Total_cash'] = $this->input->post('Total_cash');
			$data['Available_Cash']  = $this->input->post('Available_Cash');
			$data['reason']    = $this->input->post('reason');


			$this->db->where('sh_id', $param3);
			$this->db->update('Manage_Shift_Closed', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/Manage_Shift_Closed', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('Manage_Shift_Closed', array(
				'Sh_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('Sh_id', $param2);
			$this->db->delete('Manage_Shift_Closed');
			$this->db->where('admin_id', $param2);
			$this->db->delete('admin');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?admin/Manage_Shift_Closed', 'refresh');
		}
		$page_data['page_name']     = 'Manage_Shift_Closed';
		$page_data['page_title']    = get_phrase('manage_Shift_Closed');
		// $this->db->select('ad.name,msc.Cash_Recieved,msc.Total_Bill,msc.Total_cash,msc.Available_Cash,msc.reason');
  //       $this->db->from('admin ad');
  //       $this->db->join('Manage_Shift_Closed msc', 'msc.admin_id = ad.admin_id');
 
  //      $page_data['Shift_Closed'] = $this->db->get()->result_array();
        $page_data['Shift_Closed'] = $this->db->get('Manage_Shift_Closed')->result_array();
		// $page_data = $this->db->get();
		// $page_data['Shift_Closed'] = $page_data->result();
		// print_r($page_data) ; exit();
		$this->load->view('index', $page_data);
	}
	/***Manage receptions**/
	function manage_reception($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('reception', $data);
			$this->email_model->account_opening_email('reception', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/manage_reception', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('reception_id', $param3);
			$this->db->update('reception', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			redirect(base_url() . 'index.php?admin/manage_reception', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('reception', array(
				'reception_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('reception_id', $param2);
			$this->db->delete('reception');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?admin/manage_reception', 'refresh');
		}
		$page_data['page_name']   = 'manage_reception';
		$page_data['page_title']  = get_phrase('manage_reception');
		$page_data['receptions'] = $this->db->get('reception')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW APPOINTMENT REPORT	********/
	function view_appointment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']    = 'view_appointment';
		$page_data['page_title']   = get_phrase('view_appointment');
		$page_data['appointments'] = $this->db->get('appointment')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW PAYMENT REPORT	********/
	function view_payment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']  = 'view_payment';
		$page_data['page_title'] = get_phrase('view_payment');
		$page_data['payments']   = $this->db->get('payment')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW BED STATUS	********/
	function view_bed_status($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']      = 'view_bed_status';
		$page_data['page_title']     = get_phrase('view_blood_bank');
		$page_data['bed_allotments'] = $this->db->get('bed_allotment')->result_array();
		$page_data['beds']           = $this->db->get('bed')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW BLOOD BANK	********/
	function view_blood_bank($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']    = 'view_blood_bank';
		$page_data['page_title']   = get_phrase('view_blood_bank');
		$page_data['blood_donors'] = $this->db->get('blood_donor')->result_array();
		$page_data['blood_bank']   = $this->db->get('blood_bank')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW MEDICINE********/
	function view_medicine($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']  = 'view_medicine';
		$page_data['page_title'] = get_phrase('view_medicine');
		$page_data['medicines']  = $this->db->get('medicine')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW MEDICINE********/
	function view_report($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']   = 'view_report';
		$page_data['page_title']  = get_phrase('view_' . $param1 . '_report');
		$page_data['report_type'] = $param1;
		$page_data['reports']     = $this->db->get_where('report', array(
			'type' => $param1
		))->result_array();
		$this->load->view('index', $page_data);
	}
	
	/***MANAGE EMAIL TEMPLATE**/
	function manage_email_template($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param2 == 'do_update') {
			$this->db->where('task', $param1);
			$this->db->update('email_template', array(
				'body' => $this->input->post('body'),
				'subject' => $this->input->post('subject')
			));
			$this->session->set_flashdata('flash_message', get_phrase('template_updated'));
			redirect(base_url() . 'index.php?admin/manage_email_template/' . $param1, 'refresh');
		}
		$page_data['page_name']     = 'manage_email_template';
		$page_data['page_title']    = get_phrase('manage_email_template');
		$page_data['template']      = $this->db->get_where('email_template', array(
			'task' => $param1
		))->result_array();
		$page_data['template_task'] = $param1;
		$this->load->view('index', $page_data);
	}
	
	/***MANAGE NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
	function manage_noticeboard($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->insert('noticeboard', $data);
			$this->session->set_flashdata('flash_message', get_phrase('report_created'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->where('notice_id', $param3);
			$this->db->update('noticeboard', $data);
			$this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('noticeboard', array(
				'notice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('notice_id', $param2);
			$this->db->delete('noticeboard');
			$this->session->set_flashdata('flash_message', get_phrase('notice_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_noticeboard', 'refresh');
		}
		$page_data['page_name']  = 'manage_noticeboard';
		$page_data['page_title'] = get_phrase('manage_noticeboard');
		$page_data['notices']    = $this->db->get('noticeboard')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	/*****SITE/SYSTEM SETTINGS*********/
	function system_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param2 == 'do_update') {
			$this->db->where('type', $param1);
			$this->db->update('settings', array(
				'description' => $this->input->post('description')
			));
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
		}
		if ($param1 == 'upload_logo') {
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
		}
		$page_data['page_name']  = 'system_settings';
		$page_data['page_title'] = get_phrase('system_settings');
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*****LANGUAGE SETTINGS*********/
	function manage_language($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	/*****BACKUP / RESTORE / DELETE DATA PAGE**********/
	function backup_restore($operation = '', $type = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect('login', 'refresh');
		
		if ($operation == 'create') {
			$this->crud_model->create_backup($type);
		}
		if ($operation == 'restore') {
			$this->crud_model->restore_backup();
			redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
		}
		if ($operation == 'delete') {
			$this->crud_model->truncate($type);
			redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
		}
		
		$page_data['page_name']  = 'backup_restore';
		$page_data['page_title'] = get_phrase('backup_restore');
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
	function manage_profile($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'update_profile_info') {
			$data['name']    = $this->input->post('name');
			$data['email']   = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['phone']   = $this->input->post('phone');
			
			$this->db->where('admin_id', $this->session->userdata('admin_id'));
			$this->db->update('admin', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['password']             = $this->input->post('password');
			$data['new_password']         = $this->input->post('new_password');
			$data['confirm_new_password'] = $this->input->post('confirm_new_password');
			
			$current_password = $this->db->get_where('admin', array(
				'admin_id' => $this->session->userdata('admin_id')
			))->row()->password;
			if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
				$this->db->where('admin_id', $this->session->userdata('admin_id'));
				$this->db->update('admin', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
			} else {
				$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
			}
			
			redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
		}
		$page_data['page_name']    = 'manage_profile';
		$page_data['page_title']   = get_phrase('manage_profile');
		$page_data['edit_profile'] = $this->db->get_where('admin', array(
			'admin_id' => $this->session->userdata('admin_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}
	
	/***Manage Complain**/
	function manage_complain($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
            
			$data['floor_id']          = $this->input->post('floor_id');
			$data['area_id']          = $this->input->post('area_id');
			$data['room_id']          = $this->input->post('room_id');
			$data['comp_type_id']          = $this->input->post('comp_type_id');
			$data['from_person']         = $this->input->post('from_person');
			$data['complain_date']           = date('Y-m-d');
			//$data['complain_date']       = $this->input->post('complain_date');
			$data['current_time']           = date('Y-m-d H:i:s',time());  //added to check
			$data['complain_desc']         = $this->input->post('complain_desc');
			$data['status'] = $this->input->post('status');
			$this->db->insert('complain', $data);
			/*$this->email_model->account_opening_email('doctor', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL*/
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/manage_complain', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['floor_id']          = $this->input->post('floor_id');
			$data['area_id']          = $this->input->post('area_id');
			$data['room_id']          = $this->input->post('room_id');
			$data['comp_type_id']          = $this->input->post('comp_type_id');
			$data['from_person']         = $this->input->post('from_person');
			//$data['complain_date']       = $this->input->post('complain_date');
			$data['complain_desc']         = $this->input->post('complain_desc');
			$data['status']       = $this->input->post('status');		
			$this->db->where('id', $param3);
			$this->db->update('complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_complain', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('complain', array(
				'id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('complain');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_complain', 'refresh');
		}
		$page_data['page_name']  = 'manage_complain';
		$page_data['page_title'] = get_phrase('manage_complain');
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
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {

			$data['complain_title']          = $this->input->post('complain_title');
			$data['description']         = $this->input->post('description');
			
			$this->db->insert('complain_type', $data);
		//	$this->email_model->account_opening_email('complain_type', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/maintenance_complain', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['complain_title']          = $this->input->post('complain_title');
			$data['description']         = $this->input->post('description');
			
			$this->db->where('comp_type_id', $param3);
			$this->db->update('complain_type', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/maintenance_complain', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('complain_type', array(
				'comp_type_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('comp_type_id', $param2);
			$this->db->delete('complain_type');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/maintenance_complain', 'refresh');
		}
		$page_data['page_name']  = 'maintenance_complain';
		$page_data['page_title'] = get_phrase('maintenance_complain');
		$page_data['complain_types']    = $this->db->get('complain_type')->result_array();
		$this->load->view('index', $page_data);   

		
	}
	
	/***Manage Booked**/
	function manage_booked($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['booked_name']          = $this->input->post('booked_name');
		
			$this->db->insert('booked', $data);
			//$this->email_model->account_opening_email('ot', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
			redirect(base_url() . 'index.php?admin/manage_booked', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['booked_name']          = $this->input->post('booked_name');

			$this->db->where('booked_id', $param3);
			$this->db->update('booked', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_booked', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('booked', array(
				'booked_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('booked_id', $param2);
			$this->db->delete('booked');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_booked', 'refresh');
		}
		$page_data['page_name']  = 'manage_booked';
		$page_data['page_title'] = get_phrase('manage_booked');
		$page_data['booked_names']    = $this->db->get('booked')->result_array();
		$this->load->view('index', $page_data);   

		
	}
	
	/***Manage OT**/
	/*
 	function manage_ot($param1 = '', $param2 = '', $param3 = '')
	{
	  if ($this->session->userdata('admin_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	   
	  if ($param1 == 'create') {
		 
	   $data['doctor_id']          = $this->input->post('doctor_id');
	   $data['anesthesia_name']    = $this->input->post('anesthesia_name');
	   $data['1_open_time']         = $this->input->post('1_open_time');
	   $data['1_close_time']         = $this->input->post('1_close_time');
	   $data['hours']                 = $this->input->post('hours');
	   $data['case_date']              = date('Y-m-d', strtotime($this->input->post('case_date')));
	   $data['no_cases']               = $this->input->post('no_cases');
	   $data['multiplecase_id']        = $this->input->post('multiplecase_id');
	   $data['booking_date']           = date('Y-m-d', strtotime($this->input->post('booking_date')));
	   $data['description']             = $this->input->post('description');
	   $data['booked_id']                = $this->input->post('booked_id');
	   $this->db->insert('ot', $data);
	    $id = mysql_insert_id();
	   //$this->email_model->account_opening_email('ot', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
	   $this->session->set_flashdata('flash_message', get_phrase('account_opened'));
	   
	   
	   $total_hours = $this->input->post('hours');
	   $start_time = $this->input->post('1_open_time');
	   for ($i=0; $i< $total_hours; $i++)
	   {	
			$data1['ot_date'] = date('Y-m-d', strtotime($this->input->post('case_date')));
			$data1['book_time']  = $start_time;
			$data1['ot_master_id']  = $id;
			
			$this->db->insert('ot_details', $data1);
			$start_time = strtotime($start_time . ' + 1 hours');  
			$start_time = date("H:i",$start_time);
	   }
	   redirect(base_url() . 'index.php?admin/manage_ot', 'refresh');
	  }
	  
	  if ($param1 == 'edit' && $param2 == 'do_update') {
	  
	   $data['doctor_id']          = $this->input->post('doctor_id');
	   $data['anesthesia_name']    = $this->input->post('anesthesia_name');
	   $data['1_open_time']         = $this->input->post('1_open_time');
	   $data['1_close_time']         = $this->input->post('1_close_time');
	   $data['hours']                 = $this->input->post('hours');
	   $data['case_date']             = date('Y-m-d', strtotime($this->input->post('case_date')));
	   $data['no_cases']               = $this->input->post('case_date');
	   $data['multiplecase_id']         = $this->input->post('multiplecase_id');
	   $data['booking_date']            = date('Y-m-d', strtotime($this->input->post('booking_date')));
	   $data['description']              = $this->input->post('description');
	   $data['booked_id']                = $this->input->post('booked_id');
	   
	   $this->db->where('ot_id', $param3);
	   $this->db->update('ot', $data);
	   $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
	   
	   redirect(base_url() . 'index.php?admin/manage_ot', 'refresh');
	  } else if ($param1 == 'edit') {
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
	   
	   redirect(base_url() . 'index.php?admin/manage_ot', 'refresh');
	
	  }
	  $page_data['page_name']  = 'manage_ot';
	  $page_data['page_title'] = get_phrase('manage_ot');
	  $page_data['ot1']    = $this->db->get('ot')->result_array();
	  $this->load->view('index', $page_data);   
	
	 }
	*/
	/******MANAGE SERVICE*****/
	/*
	function manage_service($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['service_name']         = $this->input->post('service_name');
			
			$this->db->insert('service', $data);
			$this->session->set_flashdata('flash_message', get_phrase('service_created'));
			redirect(base_url() . 'index.php?admin/manage_service', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['service_name']  = $this->input->post('service_name');
			
			$this->db->where('service_id', $param3);
			$this->db->update('service', $data);
			$this->session->set_flashdata('flash_message', get_phrase('service_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_service', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('service', array(
				'service_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('service_id', $param2);
			$this->db->delete('service');
			$this->session->set_flashdata('flash_message', get_phrase('service_deleted'));
			redirect(base_url() . 'index.php?admin/manage_service', 'refresh');
		}
		$page_data['page_name']  = 'manage_service';
		$page_data['page_title'] = get_phrase('manage_service');
		$page_data['services'] = $this->db->get('service')->result_array();
		
		$this->load->view('index', $page_data);
	}
	*/
	/******surgery type*****/
	function surgery_types($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['desc']         = $this->input->post('desc');
			
			$this->db->insert('surgery_type', $data);
			$this->session->set_flashdata('flash_message', get_phrase('surgery_types_created'));
			redirect(base_url() . 'index.php?admin/surgery_types', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['desc']  = $this->input->post('desc');
			
			$this->db->where('surgery_id', $param3);
			$this->db->update('surgery_type', $data);
			$this->session->set_flashdata('flash_message', get_phrase('surgery_types_updated'));
			
			redirect(base_url() . 'index.php?admin/surgery_types', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('surgery_type', array(
				'surgery_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('surgery_id', $param2);
			$this->db->delete('surgery_type');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?admin/surgery_types', 'refresh');
		}
		$page_data['page_name']  = 'surgery_types';
		$page_data['page_title'] = get_phrase('surgery_types');
		$page_data['surgery_types'] = $this->db->get('surgery_type')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	 /******category*****/
	function manage_category($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['category_name']         = $this->input->post('category_name');
			$data['surgery_id']         = $this->input->post('surgery_id');
			
			$this->db->insert('category', $data);
			$this->session->set_flashdata('flash_message', get_phrase('category_created'));
			redirect(base_url() . 'index.php?admin/manage_category', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['category_name']         = $this->input->post('category_name');
			$data['surgery_id']         = $this->input->post('surgery_id');
			
			$this->db->where('category_id', $param3);
			$this->db->update('category', $data);
			$this->session->set_flashdata('flash_message', get_phrase('category_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_category', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('category', array(
				'category_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('category_id', $param2);
			$this->db->delete('category');
			$this->session->set_flashdata('flash_message', get_phrase('category_deleted'));
			redirect(base_url() . 'index.php?admin/manage_category', 'refresh');
		}
		$page_data['page_name']  = 'manage_category';
		$page_data['page_title'] = get_phrase('manage_category');
		$page_data['categorys'] = $this->db->get('category')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/******surgery*****/
	function surgery($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['surgery_id']         = $this->input->post('surgery_id');
			$data['category_id']         = $this->input->post('category_id');
			$data['type']         = $this->input->post('type');
			
			$this->db->insert('surgery', $data);
			$this->session->set_flashdata('flash_message', get_phrase('category_created'));
			redirect(base_url() . 'index.php?admin/surgery', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['surgery_id']         = $this->input->post('surgery_id');
			$data['category_id']         = $this->input->post('category_id');
			$data['type']         = $this->input->post('type');
			
			$this->db->where('type_id', $param3);
			$this->db->update('surgery', $data);
			$this->session->set_flashdata('flash_message', get_phrase('category_updated'));
			
			redirect(base_url() . 'index.php?admin/surgery', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('surgery', array(
				'type_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('type_id', $param2);
			$this->db->delete('surgery');
			$this->session->set_flashdata('flash_message', get_phrase('category_deleted'));
			redirect(base_url() . 'index.php?admin/surgery', 'refresh');
		}
		$page_data['page_name']  = 'surgery';
		$page_data['page_title'] = get_phrase('surgery');
		$page_data['surgerys'] = $this->db->get('surgery')->result_array();
		
		$this->load->view('index', $page_data);
	}

/***Manage OT**/
 	function manage_ot($param1 = '', $param2 = '', $param3 = '')
	{
	  if ($this->session->userdata('admin_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	   
	  if ($param1 == 'create') {
		  
	   $data['ot1_id']          = $this->input->post('ot1_id');	
	   $data['patient_id']          = $this->input->post('patient_id'); 
	   $data['doctor_id']          = $this->input->post('doctor_id');
	   $data['anesthesia_name']    = $this->input->post('anesthesia_name');
	   $data['1_open_time']         = $this->input->post('1_open_time');
	   $data['1_close_time']         = $this->input->post('1_close_time');
	   $data['hours']                 = $this->input->post('hours');
	   $data['case_date']              = date('Y-m-d', strtotime($this->input->post('case_date')));
	   $data['no_cases']               = $this->input->post('no_cases');
	   $data['surgery_id']        = $this->input->post('surgery_id');
	   $data['category_id']        = $this->input->post('category_id');
	   $data['type_id']        = $this->input->post('type_id');
	   $data['booking_date']           = date('Y-m-d', strtotime($this->input->post('booking_date')));
	   $data['description']             = $this->input->post('description');
	   $data['booked_id']                = $this->input->post('booked_id');
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
	   redirect(base_url() . 'index.php?admin/manage_ot', 'refresh');
	  }
	  
	  if ($param1 == 'edit' && $param2 == 'do_update') {
	  
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
	   
	   redirect(base_url() . 'index.php?admin/manage_ot', 'refresh');
	  } else if ($param1 == 'edit') {
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
	   
	   redirect(base_url() . 'index.php?admin/manage_ot', 'refresh');
	
	  }
	  $page_data['page_name']  = 'manage_ot';
	  $page_data['page_title'] = get_phrase('manage_ot');
	  $page_data['ot1']    = $this->db->get('ot')->result_array();

	  $this->load->view('index', $page_data);   
	
	 }
	 
	 	/******MANAGE OT SCHEDULES1*****/
	function ot_schedules1($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
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
		if ($this->session->userdata('admin_login') != 1)
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
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
	
		$page_data['page_name']  = 'ot_schedules3';
		$page_data['page_title'] = get_phrase('OT Schedules 3');	
		//$sql = "SELECT * FROM ot ";
		//$page_data['ot1']= $this->db->query("SELECT * FROM ot where ot1_id =1")->result_array();	
		//$page_data['ot2']= $this->db->query("SELECT * FROM ot where ot1_id =2")->result_array();	
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE Rate*****/
	function manage_rate($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['doctor_id']         = $this->input->post('doctor_id');
			$data['service_id']         = $this->input->post('service_id');
			$data['rate']         = $this->input->post('rate');
			
			$this->db->insert('amount', $data);
			$this->session->set_flashdata('flash_message', get_phrase('amount_created'));
			redirect(base_url() . 'index.php?admin/manage_rate', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['doctor_id']  = $this->input->post('doctor_id');
			$data['service_id']  = $this->input->post('service_id');
			$data['rate']  = $this->input->post('rate');
			
			$this->db->where('rate_id', $param3);
			$this->db->update('amount', $data);
			$this->session->set_flashdata('flash_message', get_phrase('amount_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_rate', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('amount', array(
				'rate_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('rate_id', $param2);
			$this->db->delete('amount');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?admin/manage_rate', 'refresh');
		}
		$page_data['page_name']  = 'manage_rate';
		$page_data['page_title'] = get_phrase('manage_rate');
		$page_data['amounts'] = $this->db->get('amount')->result_array();
		
		$this->load->view('index', $page_data);
	}
	

	
	/******MANAGE Room*****/
	function manage_room($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['room_name']         = $this->input->post('room_name');
			
			$this->db->insert('room', $data);
			$this->session->set_flashdata('flash_message', get_phrase('room_created'));
			redirect(base_url() . 'index.php?admin/manage_room', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['room_name']  = $this->input->post('room_name');

			
			$this->db->where('room_id', $param3);
			$this->db->update('room', $data);
			$this->session->set_flashdata('flash_message', get_phrase('room_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_room', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('room', array(
				'room_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('room_id', $param2);
			$this->db->delete('room');
			$this->session->set_flashdata('flash_message', get_phrase('room_deleted'));
			redirect(base_url() . 'index.php?admin/manage_room', 'refresh');
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
		if ($this->session->userdata('admin_login') != 1)
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
			redirect(base_url() . 'index.php?admin/assigned_room', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['room_id']  = $this->input->post('room_id');
			$data['days']              = $this->input->post('days');
		    $data['today_date']        = date('Y-m-d H:i:s', time());
			$data['doctor_id']         = $this->input->post('doctor_id');  
			$data['1_open_time']       = $this->input->post('1_open_time');
			$data['1_close_time']      = $this->input->post('1_close_time');
			
			$this->db->where('assignedroom_id', $param3);
			$this->db->update('assignedroom', $data);
			$this->session->set_flashdata('flash_message', get_phrase('assignedroom_updated'));
			
			redirect(base_url() . 'index.php?admin/assigned_room', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('assignedroom', array(
				'assignedroom_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('assignedroom_id', $param2);
			$this->db->delete('assignedroom');
			$this->session->set_flashdata('flash_message', get_phrase('assignedroom_deleted'));
			redirect(base_url() . 'index.php?admin/assigned_room', 'refresh');
		}
		/*if ($param4 == 'search') {
			$this->db->where('room_id', $param2);
			$this->db->delete('room');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?admin/manage_room', 'refresh');
		}*/
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
	
	
	/****** Complain Management*****/
	function complain_management($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
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
			redirect(base_url() . 'index.php?admin/complain_management', 'refresh');
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
			
			redirect(base_url() . 'index.php?admin/complain_management', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('complain_management', array(
				'comp_manag_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('comp_manag_id', $param2);
			$this->db->delete('complain_management');
			$this->session->set_flashdata('flash_message', get_phrase('complain_management_deleted'));
			redirect(base_url() . 'index.php?admin/complain_management', 'refresh');
		}
		$page_data['page_name']  = 'complain_management';
		$page_data['page_title'] = get_phrase('complain_management');
		$page_data['complain_managements'] = $this->db->get('complain_management')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
/****** Genaral Complain*****/
/*
	function general_complain($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));
			$data['description']         = $this->input->post('description');
			$data['status']         = $this->input->post('status');
			$data['option']         = $this->input->post('option');
			$this->db->insert('general_complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_created'));
			redirect(base_url() . 'index.php?admin/general_complain', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));
			$data['description']         = $this->input->post('description');
			$data['status']         = $this->input->post('status');
			$data['option']         = $this->input->post('option');
			
			$this->db->where('general_comp_id', $param3);
			$this->db->update('general_complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_updated'));
			
			redirect(base_url() . 'index.php?admin/general_complain', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('general_complain', array(
				'general_comp_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('general_comp_id', $param2);
			$this->db->delete('general_complain');
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_deleted'));
			redirect(base_url() . 'index.php?admin/general_complain', 'refresh');
		}
		$page_data['page_name']  = 'general_complain';
		$page_data['page_title'] = get_phrase('general_complain');
		$page_data['general_complains'] = $this->db->get('general_complain')->result_array();
		
		$this->load->view('index', $page_data);
	}

*/
/****** Genaral Complain*****/
	function general_complain($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
		
		   $data['incident_date']           = date('Y-m-d');
			$data['incident_time']           = date('Y-m-d H:i:s',time());  //added to check
			$data['description']         = $this->input->post('description');
			$data['status']         = $this->input->post('status');
			$data['option']         = $this->input->post('option');
			$this->db->insert('general_complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_created'));
			redirect(base_url() . 'index.php?admin/general_complain', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			/*$data['incident_date']           = date('Y-m-d', strtotime($this->input->post('incident_date')));*/
			$data['description']         = $this->input->post('description');
			$data['status']         = $this->input->post('status');
			$data['option']         = $this->input->post('option');
			
			$this->db->where('general_comp_id', $param3);
			$this->db->update('general_complain', $data);
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_updated'));
			
			redirect(base_url() . 'index.php?admin/general_complain', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('general_complain', array(
				'general_comp_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('general_comp_id', $param2);
			$this->db->delete('general_complain');
			$this->session->set_flashdata('flash_message', get_phrase('general_complain_deleted'));
			redirect(base_url() . 'index.php?admin/general_complain', 'refresh');
		}
		$page_data['page_name']  = 'general_complain';
		$page_data['page_title'] = get_phrase('general_complain');
		$page_data['general_complains'] = $this->db->get('general_complain')->result_array();
		
		$this->load->view('index', $page_data);
	}
/******MANAGE Employee list****/
	
	function manage_employee($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['emp_name']         = $this->input->post('emp_name');
			$data['dept']         = $this->input->post('dept');
			
			
			
			$this->db->insert('employee', $data);
			$this->session->set_flashdata('flash_message', get_phrase('employee_created'));
			redirect(base_url() . 'index.php?admin/manage_employee', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
		    $data['emp_name']         = $this->input->post('emp_name');
			$data['dept']         = $this->input->post('dept');
			
			
			$this->db->where('employee_id', $param3);
			$this->db->update('employee', $data);
			$this->session->set_flashdata('flash_message', get_phrase('employee_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_employee', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('employee', array(
				'employee_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('employee_id', $param2);
			$this->db->delete('employee');
			$this->session->set_flashdata('flash_message', get_phrase('employee_deleted'));
			redirect(base_url() . 'index.php?admin/manage_employee', 'refresh');
		}
		$page_data['page_name']  = 'manage_employee';
		$page_data['page_title'] = get_phrase('manage_employee');
		$page_data['employees'] = $this->db->get('employee')->result_array();
		
		$this->load->view('index', $page_data);
	}


/******Room Charges*****/

	function room_charges($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['room_type']         = $this->input->post('room_type');
			$data['charges']         = $this->input->post('charges');
			
			$this->db->insert('room_charges', $data);
			$this->session->set_flashdata('flash_message', get_phrase('roomcharges_created'));
			redirect(base_url() . 'index.php?admin/room_charges', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['room_type']         = $this->input->post('room_type');
			$data['charges']         = $this->input->post('charges');
			
			
			$this->db->where('charge_id', $param3);
			$this->db->update('room_charges', $data);
			$this->session->set_flashdata('flash_message', get_phrase('charges_updated'));
			
			redirect(base_url() . 'index.php?admin/room_charges', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('room_charges', array(
				'charge_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('charge_id', $param2);
			$this->db->delete('room_charges');
			$this->session->set_flashdata('flash_message', get_phrase('charges_deleted'));
			redirect(base_url() . 'index.php?admin/room_charges', 'refresh');
		}
		$page_data['page_name']  = 'room_charges';
		$page_data['page_title'] = get_phrase('room_charges');
		$page_data['roomcharges'] = $this->db->get('room_charges')->result_array();
		
		$this->load->view('index', $page_data);
	}

/******MANAGE floor*****/
/*
	function manage_floor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['floor_name']         = $this->input->post('floor_name');
			$data['area']         = $this->input->post('area');
			
			$this->db->insert('floor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('floor_created'));
			redirect(base_url() . 'index.php?admin/manage_floor', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['floor_name']  = $this->input->post('floor_name');
			$data['area']         = $this->input->post('area');
		
			$this->db->where('floor_id', $param3);
			$this->db->update('floor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('floor_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_floor', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('floor', array(
				'floor_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('floor_id', $param2);
			$this->db->delete('floor');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?admin/manage_floor', 'refresh');
		}
		$page_data['page_name']  = 'manage_floor';
		$page_data['page_title'] = get_phrase('manage_floor');
		$page_data['floors'] = $this->db->get('floor')->result_array();
		
		$this->load->view('index', $page_data);
	}
*/
/******MANAGE floor*****/
	function manage_floor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['floor_name']         = $this->input->post('floor_name');
			
			$this->db->insert('floor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('floor_created'));
			redirect(base_url() . 'index.php?admin/manage_floor', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['floor_name']  = $this->input->post('floor_name');
			
			$this->db->where('floor_id', $param3);
			$this->db->update('floor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('floor_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_floor', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('floor', array(
				'floor_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('floor_id', $param2);
			$this->db->delete('floor');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?admin/manage_floor', 'refresh');
		}
		$page_data['page_name']  = 'manage_floor';
		$page_data['page_title'] = get_phrase('manage_floor');
		$page_data['floors'] = $this->db->get('floor')->result_array();
		
		$this->load->view('index', $page_data);
	}

/******MANAGE SERVICE*****/

	function manage_service($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['service_name']         = $this->input->post('service_name');
			$data['maincategory']         = $this->input->post('maincategory');
			$data['totalamount']         = $this->input->post('totalamount');
			$data['share']         = $this->input->post('share');
			
			$this->db->insert('service', $data);
			$this->session->set_flashdata('flash_message', get_phrase('service_created'));
			redirect(base_url() . 'index.php?admin/manage_service', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['service_name']  = $this->input->post('service_name');
			$data['maincategory']         = $this->input->post('maincategory');
			$data['totalamount']         = $this->input->post('totalamount');
			$data['share']         = $this->input->post('share');
			
			$this->db->where('service_id', $param3);
			$this->db->update('service', $data);
			$this->session->set_flashdata('flash_message', get_phrase('service_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_service', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('service', array(
				'service_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('service_id', $param2);
			$this->db->delete('service');
			$this->session->set_flashdata('flash_message', get_phrase('service_deleted'));
			redirect(base_url() . 'index.php?admin/manage_service', 'refresh');
		}
		$page_data['page_name']  = 'manage_service';
		$page_data['page_title'] = get_phrase('manage_service');
		$page_data['services'] = $this->db->get('service')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE Area*****/
	function manage_area($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
		   
			$data['area']         = $this->input->post('area');
			$data['floor_id']         = $this->input->post('floor_id');
			$this->db->insert('area', $data);
			$this->session->set_flashdata('flash_message', get_phrase('area_created'));
			redirect(base_url() . 'index.php?admin/manage_area', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['area']  = $this->input->post('area');
			$data['floor_id']         = $this->input->post('floor_id');
			$this->db->where('area_id', $param3);
			$this->db->update('area', $data);
			$this->session->set_flashdata('flash_message', get_phrase('area_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_area', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('area', array(
				'area_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('area_id', $param2);
			$this->db->delete('area');
			$this->session->set_flashdata('flash_message', get_phrase('amount_deleted'));
			redirect(base_url() . 'index.php?admin/manage_area', 'refresh');
		}
		$page_data['page_name']  = 'manage_area';
		$page_data['page_title'] = get_phrase('manage_area');
		$page_data['areas'] = $this->db->get('area')->result_array();
		
		$this->load->view('index', $page_data);
	}

	/******MANAGE APPROVED DISCOUNT*****/
 function approved_discount($param1 = '', $param2 = '', $param3 = '')
 {
  if ($this->session->userdata('admin_login') != 1)
   redirect(base_url() . 'index.php?login', 'refresh');
  

  $page_data['page_name']  = 'approved_discount';
  $page_data['page_title'] = get_phrase('approved_discount');
  //$page_data['invoices'] =  $this->db->get('invoice')->where('discount ', 10); 
  
  $sql = "SELECT * FROM invoice ";
$page_data['invoices']= $this->db->query("SELECT * FROM invoice where discount >=10 and need_approval =1 and approved =0")->result_array();

//$page_data['invoices'] =$this->db->query($sql); 
//print_r($page_data['invoices']); exit;
  //if($page_data['invoices']>=10)
  $this->load->view('index', $page_data);
 }
 
  /******doctor payment voucher*****/
 function doctor_payment_voucher($param1 = '', $param2 = '', $param3 = '')
 {
  if ($this->session->userdata('admin_login') != 1)
   redirect(base_url() . 'index.php?login', 'refresh');
  
  
  $page_data['page_name']  = 'doctor_payment_voucher';
  $page_data['page_title'] = get_phrase('doctor_payment_voucher');
  $page_data['invoices'] = $this->db->get('invoice')->result_array();
  
  $this->load->view('index', $page_data);
 }
 
  /******daily doctor sale *****/
 function daily_doctorsale($param1 = '', $param2 = '', $param3 = '')
 {
  if ($this->session->userdata('admin_login') != 1)
   redirect(base_url() . 'index.php?login', 'refresh');
  
  
  $page_data['page_name']  = 'daily_doctorsale';
  $page_data['page_title'] = get_phrase('daily_doctorsale');
  $page_data['invoices'] = $this->db->get('invoice')->result_array();
  
  $this->load->view('index', $page_data);
 }
 
  /******Sales Report*****/
 function salesreport($param1 = '', $param2 = '', $param3 = '')
 {
  if ($this->session->userdata('admin_login') != 1)
   redirect(base_url() . 'index.php?login', 'refresh');
  
  
  $page_data['page_name']  = 'salesreport';
  $page_data['page_title'] = 'Sales Report';
  $page_data['invoices'] = $this->db->get('invoice')->result_array();
  
  $this->load->view('index', $page_data);
 }
 
 /******MANAGE BILLING / INVOICES WITH STATUS*****/
	function manage_invoice($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['patient_id']            = $this->input->post('patient_id');
			$data['invoice_number']         = $this->input->post('invoice_no');
			$data['doctor_id']             = $this->input->post('doctor_id');
			$data['service_id']            = $this->input->post('service_id');
			$data['diagnostictype_id']     = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']     = $this->input->post('selected_services');   //service name
			$data['refferedby']            = $this->input->post('refferedby');
			$data['med_card_no']           = $this->input->post('med_card_no');
			$data['totalamount']           = $this->input->post('totalamount');
			$data['discountamount']        = $this->input->post('discountamount');
			$data['discount']              = $this->input->post('discount');
			$data['recievedamount']        = $this->input->post('recievedamount');
			$data['dueamount']             = $this->input->post('dueamount');
			$data['careof']                = $this->input->post('careof');
			$data['createdby']             = $this->input->post('createdby');
			$data['creation_timestamp']    = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			$data['creation_time']         = date('Y-m-d H:i', time());
			$data['approved']=0;
			// print_r($data); exit();
			if($data['discount']>=10)
			{
				$data['need_approval']=1;  //
				}
				else
				{$data['need_approval']=0;} //
			
			if ( $this->input->post('discount') >= 100 )
			{
				redirect(base_url() . 'index.php?admin/manage_invoice', 'refresh');
				return;	
			}
			
			$this->db->insert('invoice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('invoice_created'));
			header('location: application/helpers/viewreceipt.php?r='.$this->input->post('invoice_no'));
			redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_id']  = $this->input->post('patient_id');
			$data['invoice_number']         = $this->input->post('invoice_no');
			$data['doctor_id']  = $this->input->post('doctor_id');
			/*$data['service_id']  = $this->input->post('service_id');*/
			$data['diagnostictype_id']            = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']            = $this->input->post('selected_services');   //service name
			$data['refferedby']            = $this->input->post('refferedby');
			$data['med_card_no']           = $this->input->post('med_card_no');
			$data['totalamount']              = $this->input->post('totalamount');
			$data['discountamount']              = $this->input->post('discountamount');
			$data['discount']              = $this->input->post('discount');
			$data['recievedamount']              = $this->input->post('recievedamount');
			$data['dueamount']        = $this->input->post('dueamount');
			$data['careof']             = $this->input->post('careof');
			$data['creation_timestamp']      = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			
			$this->db->where('invoice_id', $param3);
			$this->db->update('invoice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('invoice_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_invoice', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('invoice', array(
				'invoice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('invoice_id', $param2);
			$this->db->delete('invoice');
			$this->session->set_flashdata('flash_message', get_phrase('invoice_deleted'));
			redirect(base_url() . 'index.php?admin/manage_invoice', 'refresh');
		}
		$page_data['page_name']  = 'manage_invoice';
		$page_data['page_title'] = get_phrase('manage_invoice');
		$this->db->order_by('creation_timestamp', 'desc');
		$page_data['invoices'] = $this->db->get('invoice')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/***Diagnostic Service**/
	function diagnostic_service($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['diagnostictype_id']                 = $this->input->post('diagnostictype_id');
			$data['name']                  = $this->input->post('name');
			$data['corporatecharges']      = $this->input->post('corporatecharges');
			
			$this->db->insert('diagnosticservice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnosticservice_opened'));
			redirect(base_url() . 'index.php?admin/diagnostic_service', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['diagnostictype_id']                 = $this->input->post('diagnostictype_id');
			$data['name']                  = $this->input->post('name');
			$data['corporatecharges']      = $this->input->post('corporatecharges');
			$this->db->where('diagnosticservice_id', $param3);
			$this->db->update('diagnosticservice', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnosticservice_updated'));
			
			redirect(base_url() . 'index.php?admin/diagnostic_service', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('diagnosticservice', array(
				'diagnosticservice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('diagnosticservice_id', $param2);
			$this->db->delete('diagnosticservice');
			$this->session->set_flashdata('flash_message', get_phrase('diagnosticservice_deleted'));
			redirect(base_url() . 'index.php?admin/diagnostic_service', 'refresh');
		}
		$page_data['page_name']  = 'diagnostic_service';
		$page_data['page_title'] = get_phrase('diagnostic_service');
		$page_data['diagnosticservices'] = $this->db->get('diagnosticservice')->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	/***Diagnostic Type**/
	/*
	function diagnostic_type($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']                  = $this->input->post('name');
			
			$this->db->insert('diagnostictype', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnostictype_opened'));
			redirect(base_url() . 'index.php?admin/diagnostic_type', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']                  = $this->input->post('name');
			$this->db->where('diagnostictype_id', $param3);
			$this->db->update('diagnostictype', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnostictype_updated'));
			
			redirect(base_url() . 'index.php?admin/diagnostic_type', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('diagnostictype', array(
				'diagnostictype_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('diagnostictype_id', $param2);
			$this->db->delete('diagnostictype');
			$this->session->set_flashdata('flash_message', get_phrase('diagnostictype_deleted'));
			redirect(base_url() . 'index.php?admin/diagnostic_type', 'refresh');
		}
		$page_data['page_name']  = 'diagnostic_type';
		$page_data['page_title'] = get_phrase('diagnostic_type');
		$page_data['diagnostictypes'] = $this->db->get('diagnostictype')->result_array();
		
		$this->load->view('index', $page_data);
	}
	*/
		/***Diagnostic Type**/
	function diagnostic_type($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']                  = $this->input->post('name');
			$data['ratio']                  = $this->input->post('ratio');
			
			$this->db->insert('diagnostictype', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnostictype_opened'));
			redirect(base_url() . 'index.php?admin/diagnostic_type', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']                  = $this->input->post('name');
			$data['ratio']                  = $this->input->post('ratio');
			$this->db->where('diagnostictype_id', $param3);
			$this->db->update('diagnostictype', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnostictype_updated'));
			
			redirect(base_url() . 'index.php?admin/diagnostic_type', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('diagnostictype', array(
				'diagnostictype_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('diagnostictype_id', $param2);
			$this->db->delete('diagnostictype');
			$this->session->set_flashdata('flash_message', get_phrase('diagnostictype_deleted'));
			redirect(base_url() . 'index.php?admin/diagnostic_type', 'refresh');
		}
		$page_data['page_name']  = 'diagnostic_type';
		$page_data['page_title'] = get_phrase('diagnostic_type');
		$page_data['diagnostictypes'] = $this->db->get('diagnostictype')->result_array();
		
		$this->load->view('index', $page_data);
	}
	/*****LIST OF BED, MANAGE THIER TYPES********/
	function manage_bed($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['bed_number']  = $this->input->post('bed_number');
			$data['type']        = $this->input->post('type');
			$data['charges']        = $this->input->post('charges');
			$data['status']      = $this->input->post('status');
			$data['description'] = $this->input->post('description');
			$this->db->insert('bed', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?admin/manage_bed', 'refresh');
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
			redirect(base_url() . 'index.php?admin/manage_bed', 'refresh');
			
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
			redirect(base_url() . 'index.php?admin/manage_bed', 'refresh');
		}
		$page_data['page_name']  = 'manage_bed';
		$page_data['page_title'] = get_phrase('manage_bed');
		$page_data['beds']       = $this->db->get('bed')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/******ALLOT / DISCHARGE BED TO PATIENTS*****/
	function manage_bed_allotment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['bed_id']              = $this->input->post('bed_id');
			$data['patient_id']          = $this->input->post('patient_id');
			$data['allotment_timestamp'] = strtotime($this->input->post('allotment_timestamp'));
			$data['discharge_timestamp'] = strtotime($this->input->post('discharge_timestamp'));
			$data['allotment_time']       = date('Y-m-d H:i', time());
			$data['status']      = 1;
			$this->db->insert('bed_allotment', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			
		   $data = array('bed_id'=>$this->input->post('bed_id'),
                'patient_id'=>$this->input->post('patient_id'),
                'transferdate'=>$currtime,'status'=>1);

            $this->db->insert('patient_bed_mapping',$data);
			
			redirect(base_url() . 'index.php?admin/manage_bed_allotment', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['bed_id']              = $this->input->post('bed_id');
			$data['patient_id']          = $this->input->post('patient_id');
			$data['allotment_timestamp'] = strtotime($this->input->post('allotment_timestamp'));
			$data['discharge_timestamp'] = strtotime($this->input->post('discharge_timestamp'));
			$this->db->where('bed_allotment_id', $param3);
			$this->db->update('bed_allotment', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			redirect(base_url() . 'index.php?admin/manage_bed_allotment', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('bed_allotment', array(
				'bed_allotment_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('bed_allotment_id', $param2);
			$this->db->delete('bed_allotment');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?admin/manage_bed_allotment', 'refresh');
		}
		$page_data['page_name']     = 'manage_bed_allotment';
		$page_data['page_title']    = get_phrase('manage_bed_allotment');
		$page_data['bed_allotment'] = $this->db->get('bed_allotment')->result_array();
		$this->load->view('index', $page_data);
	}
	
		 /******bed SCHEDULES*****/
   	function bed_schedule($param1 = '', $param2 = '', $param3 = '')
    {
      if ($this->session->userdata('admin_login') != 1)
       redirect(base_url() . 'index.php?login', 'refresh');
     
      $page_data['page_name']  = 'bed_schedule';
      $page_data['page_title'] = get_phrase('bed_schedule');
	  
	  $page_data['sdate'] = $param1.'/'.$param2.'/'.$param3;
	  
      $this->load->view('index', $page_data);
     }
	 
	  	 /******bed transfer*****/
 	function bed_transfer($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			
			 $sql1 = "update patient_bed_mapping set status = 0 where patient_id = ".$this->input->post('patient_id')." and bed_id=".$this->input->post('bed_post_id')." and status=1";
		   
		    mysql_query($sql1);
			$result=mysql_fetch_assoc($sql1);
			
			/*$data = array('status' =>0);
		$where = "patient_id=".$this->input->post('patient_id')."  AND bed_id = ".$this->input->post('bed_id')." AND status=1 ";
		$str = $this->db->update_string('patient_bed_mapping', $data, $where); */
			
			$data['patient_id']  = $this->input->post('patient_id');
			$data['bed_id']        = $this->input->post('bed_id');
			$data['status']        = 1 ;
			$data['transferdate']        = date('Y-m-d H:i:s', time());

			$this->db->insert('patient_bed_mapping', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?admin/bed_transfer', 'refresh');
		}

		$page_data['page_name']  = 'bed_transfer';
		$page_data['page_title'] = get_phrase('bed_transfer');
		$page_data['patient_bed_mappings']       = $this->db->get('patient_bed_mapping')->result_array();
		$this->load->view('index', $page_data);
	}
	
	    /******daily reception sale *****/
	 function daily_receptionsale($param1 = '', $param2 = '', $param3 = '')
	 {
	  if ($this->session->userdata('admin_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	  
	  
	  $page_data['page_name']  = 'daily_receptionsale';
	  $page_data['page_title'] = get_phrase('daily_receptionsale');
	  $page_data['invoices'] = $this->db->get('invoice')->result_array();
	  
	  $this->load->view('index', $page_data);
	 }
	
	/******Sales Category Report*****/
	 function salescategoryreport($param1 = '', $param2 = '', $param3 = '')
	 {
	  if ($this->session->userdata('admin_login') != 1)
	   redirect(base_url() . 'index.php?login', 'refresh');
	  
	  
	  $page_data['page_name']  = 'salescategoryreport';
	  $page_data['page_title'] = 'Sales Category Report';
	  $page_data['invoices'] = $this->db->get('invoice')->result_array();
	  
	  $this->load->view('index', $page_data);
	 }
	 
	 		
	  /****** Consultant Advance Appointment ****/
	function advanceappointment($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['patname']         = $this->input->post('patname');
			$data['doctor_id']       = $this->input->post('doctor_id');
			$data['appdate']         =  date('Y-m-d', strtotime($this->input->post('appdate'))); 
			$data['phone']       = $this->input->post('phone');
			$data['area']      = $this->input->post('area');
			$data['tokenno']        = $this->input->post('tokenno');
			$data['status']        = $this->input->post('status');

			$this->db->insert('advappointment', $data);
			$this->session->set_flashdata('flash_message', get_phrase('advanceppointment_opened'));
			redirect(base_url() . 'index.php?admin/advanceappointment', 'refresh');
		}
		
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patname']        = $this->input->post('patname');
			$data['doctor_id']      = $this->input->post('doctor_id');
			$data['appdate']        = date('Y-m-d', strtotime($this->input->post('appdate'))); 
			$data['phone']        = $this->input->post('phone');
			$data['area']        = $this->input->post('area');
			$data['status']        = $this->input->post('status');
			$this->db->where('app_id', $param3);
			$this->db->update('advappointment', $data);
			$this->session->set_flashdata('flash_message', get_phrase('advanceppointment_updated'));
			redirect(base_url() . 'index.php?admin/advanceappointment', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('advappointment', array(
				'app_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('app_id', $param2);
			$this->db->delete('advappointment');
			$this->session->set_flashdata('flash_message', get_phrase('advanceppointment_deleted'));
			redirect(base_url() . 'index.php?admin/advanceppointment', 'refresh');
		}
	
		$page_data['page_name']  = 'advanceappointment';
		$page_data['page_title'] = get_phrase('advance_appointment');
		$page_data['advappointments'] = $this->db->get('advappointment')->result_array();
		
		$this->load->view('index', $page_data);
	}

 	/****** Advance Appointment Report ****/
			  
	function advanceappointmentreport($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		$page_data['page_name']  = 'advanceappointmentreport';
		$page_data['page_title'] = get_phrase('advance_appointment_report');
		
		
		$this->load->view('index', $page_data);
	}
	 
	 
	
}
