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

class laboratorist extends CI_Controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');

		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	
	/***Default function, redirects to login page if no admin logged in yet***/
	public function index()
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		if ($this->session->userdata('laboratorist_login') == 1)
			redirect(base_url() . 'index.php?laboratorist/dashboard', 'refresh');
	}
	
	/***laboratorist DASHBOARD***/
	function dashboard()
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = get_phrase('laboratorist_dashboard');
		$this->load->view('index', $page_data);
	}
	
	
	
	
	/***MANAGE PRESCRIPTIONS******/
	function view_prescription($prescription_id = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		$page_data['page_name']           = 'view_prescription';
		$page_data['page_title']          = get_phrase('view_prescription');
		$page_data['prescription_detail'] = $this->db->get_where('prescription', array(
			'prescription_id' => $prescription_id
		))->result_array();
		$page_data['prescriptions']       = $this->db->get('prescription')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/***MANAGE PRESCRIPTIONS*(UPLOAD/DELETE) DIAGNOSIS REPORTS OF A CERTAIN PRESCRIPTION*****/
	function manage_prescription($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create_diagnosis_report') {
		    $this->load->model('mymodel');
			
			$file_name               = $this->mymodel->upload_img();

			$data['report_type']     = $this->input->post('report_type');
			$data['document_type']   = $this->input->post('document_type');
			$data['prescription_id'] = $this->input->post('prescription_id');
			$data['description']     = $this->input->post('description');
			$data['timestamp']       = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			$data['laboratorist_id'] = $this->session->userdata('laboratorist_id');
			// move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/diagnosis_report/" . $_FILES["userfile"]["name"]);
			$data['file_name'] = $file_name['upload_data']['file_name'];

			$this->db->insert('diagnosis_report', $data);
			$this->session->set_flashdata('flash_message', get_phrase('diagnosis_report_created'));
			redirect(base_url() . 'index.php?laboratorist/manage_prescription/edit/' . $this->input->post('prescription_id'), 'refresh');
		}
		
		if ($param1 == 'delete_diagnosis_report') {
			$this->db->where('diagnosis_report_id', $param2);
			$this->db->delete('diagnosis_report');
			$this->session->set_flashdata('flash_message', get_phrase('diagnosis_report_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_prescription/edit/' . $param3, 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('prescription', array(
				'prescription_id' => $param2
			))->result_array();
		}
		$page_data['page_name']     = 'manage_prescription';
		$page_data['page_title']    = get_phrase('manage_prescription');
		$page_data['prescriptions'] = $this->db->get('prescription')->result_array();
		$this->load->view('index', $page_data);
	}
	

	function labreports($param1 = '', $param2 = '', $param3 = ''){
		
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if($param1 == 'add_report'){

			$page_data['tab_add'] = 1;	

		}

		
		$page_data['page_name']     = 'reports';
		$page_data['page_title']    = get_phrase('lab reports');
		$page_data['services'] = $this->db->get_where('patient_services', array(
				'service_cat_id' => 1,
			))->result_array();
		
		$this->load->view('index', $page_data);
	}
	
	public function insertreport($rowdel = ''){
		
	if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

	if(!$this->input->is_ajax_request()){
			redirect(base_url() . 'index.php?login', 'refresh');
		}

		if(is_numeric($rowdel)) {
			$this->db->where('rep_id',$rowdel);
			$this->db->delete('lab_rep');
		}

		if (empty($rowdel)) {
		
		
		$data = array( 
		'patient_reg_no' 	=> $this->input->post('mrnumber'),
		'service_id' 		=> $this->input->post('serviceid'),
		'rep_session'		=> $this->input->post('rep_session'),
		'test' 				=> $this->input->post('test'),
		'result' 			=> $this->input->post('result'),
		'intvl' 			=> $this->input->post('interval'),
		'date'				=> $this->input->post('date')
		);

		$reportsession = $this->input->post('rep_session');
		$this->db->insert('lab_rep',$data);

		$insert_id = $this->db->insert_id();
		$this->db->select('*');
		$this->db->from('lab_rep');
		$this->db->where('rep_id', $insert_id);
		$report['getsess'] = $this->db->get()->result();
		
		echo json_encode($report);
		}
	}

	function getlabreport($repses = ""){

	if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		$this->db->select('*');
		$this->db->from('lab_rep');
		$this->db->where('rep_session', $repses);
		$data['report'] = $this->db->get()->result_array();
		$this->load->view('lab-report',$data);
		
			}

	function viewrep(){
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		
		$page_data['page_name']     = 'viewrep';
		$page_data['page_title']    = get_phrase('view lab reports');
		$this->db->distinct();
		$this->db->select('rep_session,date,patient_reg_no');
		$page_data['reports'] = $this->db->get('lab_rep')->result_array();
		/*$page_data['services'] = $this->db->get_where('patient_services', array(
				'service_cat_id' => 1,
			))->result_array();*/
		
		$this->load->view('index', $page_data);
	}
	/*******WATCH AND MANAGE STATUS OF BLOOD GROUPS AND THEIR AVAILABLE AMOUNT OF BAGS********/
	function manage_blood_bank($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['status'] = $this->input->post('status');
			$this->db->where('blood_group_id', $param3);
			$this->db->update('blood_bank', $data);
			$this->session->set_flashdata('flash_message', get_phrase('blood_status_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_blood_bank', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('blood_bank', array(
				'blood_group_id' => $param2
			))->result_array();
		}
		$page_data['page_name']  = 'manage_blood_bank';
		$page_data['page_title'] = get_phrase('manage_blood_bank');
		$page_data['blood_bank'] = $this->db->get('blood_bank')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE BLOOD DONORS*****/
	function manage_blood_donor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['name']                    = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['phone']                   = $this->input->post('phone');
			$data['email']                   = $this->input->post('email');
			$data['address']                 = $this->input->post('address');
			$data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('blood_donor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_opened'));
			redirect(base_url() . 'index.php?laboratorist/manage_blood_donor', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']                    = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['phone']                   = $this->input->post('phone');
			$data['email']                   = $this->input->post('email');
			$data['address']                 = $this->input->post('address');
			$data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('blood_donor_id', $param3);

			$this->db->update('blood_donor', $data);
			$this->session->set_flashdata('flash_message', get_phrase('account_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_blood_donor', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('blood_donor', array(
				'blood_donor_id' => $param2
			))->result_array();

		}
		if ($param1 == 'delete') {
			$this->db->where('blood_donor_id', $param2);
			$this->db->delete('blood_donor');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_blood_donor', 'refresh');
		}
		$page_data['page_name']    = 'manage_blood_donor';
		$page_data['page_title']   = get_phrase('manage_blood_donor');
		$page_data['blood_donors'] = $this->db->get('blood_donor')->result_array();
		$this->load->view('index', $page_data);
	}
	public function manage_reports_work($param1 = '', $param2 = '', $param3 = '')

	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		// $this->load->helper('service_name');
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$this->load->model('mdl_reports_data');
			// echo $param2; die;
            if($_POST['report_type']=='heamatology')
            {
            	$this->mdl_reports_data->add_heamatology_report_data($param2);
            	
            
            	redirect(base_url().'index.php?laboratorist/manage_hematology_work','refresh');
            }
             elseif($_POST['report_type']=='immunology')
            {
               $this->mdl_reports_data->add_immunology_report_data($param2);
               redirect(base_url().'index.php?laboratorist/manage_immunology_work','refresh');
            }
            elseif($_POST['report_type']=='heamatology_1')
            {
               $this->mdl_reports_data->add_heamatology1_report_data($param2);
               redirect(base_url().'index.php?laboratorist/manage_hematology_1_work','refresh');
            }
            elseif($_POST['report_type']=='biochemistry')
            {
               $this->mdl_reports_data->add_biochemistry_report_data($param2);
               redirect(base_url().'index.php?laboratorist/manage_biochemistry_work','refresh');

            }
            elseif($_POST['report_type']='paracytology')
            {
               $this->mdl_reports_data->add_paracytology_report_data($param2);
               redirect(base_url().'index.php?laboratorist/manage_paracytology_work','refresh');

            }
        
           
           else
            {

            	 redirect(base_url().'index.php?laboratorist/manage_reports_work','refresh');
            }


			
			$this->session->set_flashdata('flash_message', get_phrase('Report Added Succesfully '));
			redirect(base_url() . 'index.php?laboratorist/manage_reports_work', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['leucocytes']              = $this->input->post('leucocytes');
			$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			$data['report_date']             =  date('Y/m/d');

			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('id', $param3);
			$this->db->update('hematology_work', $data);
			// print_r($data);die();
			$this->session->set_flashdata('flash_message', get_phrase('report_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_reports_work', 'refresh');
			
		} else if ($param1 == 'edit') {
			// echo "waqar ali";
			    $this->db->select('ism.id,ism.invoice_no,ism.service_id,ism.service_amount,ds.diagnostictype_id,ds.name,i.patient_id,i.creation_time,p.phone,d.name as doctor_name,p.name as patient_name,p.nic_no,p.phone,p.sex,p.age');
				$this->db->from('invoice_service_mapping as ism');
				$this->db->join('diagnosticservice as ds', 'ds.diagnosticservice_id = ism.service_id','left');
			    $this->db->join('invoice as i', 'i.invoice_number = ism.invoice_no','left');
			    $this->db->join('patient as p', 'p.patient_id = i.patient_id','left');
			    $this->db->join('doctor as d', 'd.doctor_id = p.doctor_id','left');
			    $this->db->where('ism.service_id', $param2);
                $this->db->limit(1);
                $query = $this->db->get();
			    $page_data['reports_add_data'] = $query;
			
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('hematology_work');
			$this->session->set_flashdata('flash_message', get_phrase('report_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_reports_work', 'refresh');
		}
		// $page_data['service_name']    = '';
		$page_data['page_name']       = 'manage_reports_work';
		$page_data['page_title']      = get_phrase('manage_reports_work');
		        
		        $this->db->select('ism.id,ism.invoice_no,ism.service_id,ism.service_amount,ds.diagnostictype_id,ds.name,i.patient_id,i.creation_time,p.name as patient_name');
				$this->db->from('invoice_service_mapping as ism');
				$this->db->join('diagnosticservice as ds', 'ds.diagnosticservice_id = ism.service_id','left');
			    $this->db->join('invoice as i', 'i.invoice_number = ism.invoice_no','left');
			    $this->db->join('patient as p', 'p.patient_id = i.patient_id','left');
                $this->db->where('is_reported',0);
                $query = $this->db->get();
                /*$ans= $query->patient_id;
                print_r($ans);die;*/
                // $result = $query->service_id;
               /* print_r($result);
                $this->load->model('mymodel');
                $result1 = $this->mymodel->get_service_name($result);
                print_r($result1);die;
               */ // echo $this->db->last_query();
                // print_r($query);die;
 
// - See more at: https://arjunphp.com/how-to-join-tables-in-codeigniter/#sthash.9ayK3ady.dpuf
		$page_data['reports_data'] = $query;
		// var_dump($this->session);die;
		$this->load->view('index', $page_data);
	
	
	}
	public function manage_hematology_work($param1 = '', $param2 = '', $param3 = '')

	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['leucocytes']              = $this->input->post('leucocytes');
			$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['mchc']                    = $this->input->post('mchc');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			$data['report_date']             =  date('Y/m/d');	// print_r($data);exit();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('hematology_work', $data);
			$this->session->set_flashdata('flash_message', get_phrase('Report Added Succesfully '));
			redirect(base_url() . 'index.php?laboratorist/manage_hematology_work', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['leucocytes']              = $this->input->post('leucocytes');
			$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			$data['report_date']             =  date('Y/m/d');

			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('id', $param3);
			$this->db->update('hematology_work', $data);
			// print_r($data);die();
			$this->session->set_flashdata('flash_message', get_phrase('report_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_hematology_work', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_hematology_report_data'] = $this->db->get_where('hematology_work', array(
				'id' => $param2
			))->result_array();
			
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('hematology_work');
			$this->session->set_flashdata('flash_message', get_phrase('report_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_hematology_work', 'refresh');
		}
		$page_data['page_name']    = 'manage_heamatology_work2';
		$page_data['page_title']   = get_phrase('manage_heamatology_work');
		$page_data['hematology_report_data'] = $this->db->get('hematology_work')->result_array();
		$this->load->view('index', $page_data);
	   }

	   public function manage_immunology_work($param1='',$param2='',$param3='')
		{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratrist_name']       = $this->input->post('laboratorist_name');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['depart_no']               = $this->input->post('depart_no');
			$data['phone']                   = $this->input->post('phone');
			$data['blood_hcg']               = $this->input->post('blood_hcg');
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['mchc']                    = $this->input->post('mchc');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			*/$data['report_date']             =  date('Y/m/d');
			// print_r($data);exit();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('immunology_work', $data);
			$this->session->set_flashdata('flash_message', get_phrase('Report Added Succesfully '));
			redirect(base_url() . 'index.php?laboratorist/manage_immunology_work', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratrist_name']        = $this->input->post('laboratorist_name');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['depart_no']               = $this->input->post('department_no');
			$data['phone']                   = $this->input->post('phone');
			$data['blood_hcg']               = $this->input->post('blood_hcg');
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			*/$data['report_date']             =  date('Y/m/d');
   
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('id', $param3);
			$this->db->update('immunology_work', $data);
			// print_r($data);die();
			$this->session->set_flashdata('flash_message', get_phrase('report_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_immunology_work', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_immunology_report_data'] = $this->db->get_where('immunology_work', array(
				'id' => $param2
			))->result_array();
			
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('immunology_work');
			$this->session->set_flashdata('flash_message', get_phrase('report_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_immunology_work', 'refresh');
		}
		$page_data['page_name']    = 'manage_immunology_work';
		$page_data['page_title']   = get_phrase('manage_immunology_work');
		$page_data['immunology_report_data'] = $this->db->get('immunology_work')->result_array();
		$this->load->view('index', $page_data);
	
	
	}
	public function manage_hematology_1_work($param1='',$param2='',$param3='')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['department_no']           = $this->input->post('department_no');
			$data['phone']                   = $this->input->post('phone');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['laboratrist_name']        = $this->input->post('laboratorist_name');
			$data['haemaglobin']             = $this->input->post('haemoglobin');
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');*/
			$data['red_cells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['mchc']                    = $this->input->post('mchc');
			
			// $data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			$data['report_date']             =  date('Y/m/d');
			// print_r($data);exit();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('hematology_1_work', $data);
			$this->session->set_flashdata('flash_message', get_phrase('Report Added Succesfully '));
			redirect(base_url() . 'index.php?laboratorist/manage_hematology_1_work', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['laboratrist_name']        = $this->input->post('laboratrist_name');
			$data['haemaglobin']             = $this->input->post('haemoglobin');
			/*$data['leucocytes']              = $this->input->post('leucocytes');
			$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
		*/  $data['red_cells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			
			// $data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			$data['report_date']             =  date('Y/m/d');
            // print_r($data);die();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('id', $param3);
			$this->db->update('hematology_1_work', $data);
			$this->session->set_flashdata('flash_message', get_phrase('report_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_hematology_1_work', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_hematology_1'] = $this->db->get_where('hematology_1_work', array(
				'id' => $param2
			))->result_array();
           /* print_r($page_data);
			die;*/
		
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('hematology_1_work');
			$this->session->set_flashdata('flash_message', get_phrase('account_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_hematology_1_work', 'refresh');
		}
		$page_data['page_name']    = 'manage_heamatology_1_work';
		$page_data['page_title']   = get_phrase('manage_hematology_1_work');
		$page_data['hematology_1_report_data'] = $this->db->get('hematology_1_work')->result_array();
		$this->load->view('index', $page_data);
	}
	public function manage_biochemistry_work($param1='',$param2='',$param3='')
		{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratrist_name']        = $this->input->post('laboratorist_name');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['department_no']           = $this->input->post('department_no');
			$data['phone']                   = $this->input->post('phone');
			$data['glucose']                 = $this->input->post('glucose');
			$data['calcium']                 = $this->input->post('calcium');
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['mchc']                    = $this->input->post('mchc');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			*/$data['report_date']             =  date('Y/m/d');
			// print_r($data);exit();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('biochemistry_work', $data);
			$this->session->set_flashdata('flash_message', get_phrase('Report Added Succesfully '));
			redirect(base_url() . 'index.php?laboratorist/manage_biochemistry_work', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratrist_name']        = $this->input->post('laboratorist_name');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['department_no']           = $this->input->post('department_no');
			$data['phone']                   = $this->input->post('phone');
			$data['glucose']                 = $this->input->post('glucose');
			$data['calcium']                 = $this->input->post('calcium');
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			*/$data['report_date']             =  date('Y/m/d');
   
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('id', $param3);
			$this->db->update('biochemistry_work', $data);
			// print_r($data);die();
			$this->session->set_flashdata('flash_message', get_phrase('report_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_biochemistry_work', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_biochemistry_report_data'] = $this->db->get_where('biochemistry_work', array(
				'id' => $param2
			))->result_array();
			
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('biochemistry_work');
			$this->session->set_flashdata('flash_message', get_phrase('report_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_biochemistry_work', 'refresh');
		}
		$page_data['page_name']    = 'manage_biochemistry_work';
		$page_data['page_title']   = get_phrase('manage_biochemistry_work');
		$page_data['biochemistry_report_data'] = $this->db->get('biochemistry_work')->result_array();
		$this->load->view('index', $page_data);
	
	
	}
    
	
	public function manage_paracytology_work($param1='',$param2='',$param3='')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types
		if ($param1 == 'create') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratorist_name']       = $this->input->post('laboratorist_name');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['department_no']           = $this->input->post('department_no');
			$data['phone']                   = $this->input->post('phone');
			$data['volume']                  = $this->input->post('volume');
			$data['color']                   = $this->input->post('color');
			$data['appearance']              = $this->input->post('appearance');
			$data['specific_gravity']        = $this->input->post('specific_gravity');
			$data['glucose']                 = $this->input->post('glucose');
			$data['albumin']                 = $this->input->post('albumin');
			$data['bile']                    = $this->input->post('bile');
			$data['urobilinogen']            = $this->input->post('urobilinogen');
			$data['ketone']                  = $this->input->post('ketone');
			$data['nitrite']                 = $this->input->post('nitrite');
			$data['blood']                   = $this->input->post('blood');
			$data['pus_cell']                = $this->input->post('pus_cell');
			$data['red_cell']                = $this->input->post('red_cell');
			$data['epithelial_cell']         = $this->input->post('epithelial_cell');
			$data['bacteria']                = $this->input->post('bacteria');
			$data['yeast_cell']              = $this->input->post('yeast_cell');
			$data['crystal']                 = $this->input->post('crystal');
			$data['amorphose_urates']        = $this->input->post('amorphose_urates');
			$data['granular_cast']           = $this->input->post('granular_cast');
			$data['calcium_oxalate']         = $this->input->post('calcium_oxalate');
			
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['mchc']                    = $this->input->post('mchc');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			*/$data['report_date']             =  date('Y/m/d');
			// print_r($data);exit();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('parcytology_work', $data);
			$this->session->set_flashdata('flash_message', get_phrase('Report Added Succesfully '));
			redirect(base_url() . 'index.php?laboratorist/manage_paracytology_work', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['patient_name']            = $this->input->post('name');
			$data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratorist_name']       = $this->input->post('laboratorist_name');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['department_no']           = $this->input->post('department_no');
			$data['phone']                   = $this->input->post('phone');
			$data['volume']                  = $this->input->post('volume');
			$data['color']                  = $this->input->post('color');
			$data['appearance']              = $this->input->post('appearance');
			$data['specific_gravity']        = $this->input->post('specific_gravity');
			$data['glucose']                 = $this->input->post('glucose');
			$data['albumin']                 = $this->input->post('albumin');
			$data['bile']                    = $this->input->post('bile');
			$data['urobilinogen']            = $this->input->post('urobilinogen');
			$data['ketone']                  = $this->input->post('ketone');
			$data['nitrite']                 = $this->input->post('nitrite');
			$data['blood']                   = $this->input->post('blood');
			$data['pus_cell']                = $this->input->post('pus_cell');
			$data['red_cell']                = $this->input->post('red_cell');
			$data['epithelial_cell']        = $this->input->post('epithelial_cell');
			$data['bacteria']                = $this->input->post('bacteria');
			$data['yeast_cell']             = $this->input->post('yeast_cell');
			$data['crystal']                = $this->input->post('crystal');
			$data['amorphose_urates']        = $this->input->post('amorphose_urates');
			$data['granular_cast']           = $this->input->post('granular_cast');
			$data['calcium_oxalate']         = $this->input->post('calcium_oxalate');
			/*$data['neutrophills']            = $this->input->post('neutrophills');
			$data['lymphocytes']             = $this->input->post('lymphocytes');
			$data['eosinophills']            = $this->input->post('eosinophills');
			$data['monocytes']               = $this->input->post('monocytes');
			$data['basophills']              = $this->input->post('basophills');
			$data['premature']               = $this->input->post('premature');
			$data['blasts']                  = $this->input->post('blasts');
			$data['normoblasts']             = $this->input->post('normoblasts');
			$data['haemoglobin']             = $this->input->post('haemoglobin');
			$data['redcells']                = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['esr']                     = $this->input->post('esr');
			$data['platelets']               = $this->input->post('platelets');
			$data['morphology']              = $this->input->post('morphology');
			*/$data['report_date']             =  date('Y/m/d');
   
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->where('id', $param3);
			$this->db->update('parcytology_work', $data);
			// print_r($data);die();
			$this->session->set_flashdata('flash_message', get_phrase('report_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_paracytology_work', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_paracytology_report_data'] = $this->db->get_where('parcytology_work', array(
				'id' => $param2
			))->result_array();
			
		}
		if ($param1 == 'delete') {
			$this->db->where('id', $param2);
			$this->db->delete('parcytology_work');
			$this->session->set_flashdata('flash_message', get_phrase('report_deleted'));
			redirect(base_url() . 'index.php?laboratorist/manage_paracytology_work', 'refresh');
		}
		$page_data['page_name']    = 'manage_paracytology_work';
		$page_data['page_title']   = get_phrase('manage_paracytology_work');
		$page_data['paracytology_report_data'] = $this->db->get('parcytology_work')->result_array();
		$this->load->view('index', $page_data);
	
	
	}
    

	
	public function mannage_Heamatology($id){
     $data['hematology_data'] = $this->db->get_where('hematology_work',array('id'=>$id));
     $this->load->view('hematology',$data);


	}
	public function manage_Immunology($id)
	{
     $data['immunology_report_data'] = $this->db->get_where('immunology_work',array('id'=>$id));
     $this->load->view('immunology',$data);
    }
    public function manage_Heamatology_1($id)
	{
     $data['hematology_data'] = $this->db->get_where('hematology_1_work',array('id'=>$id));
     $this->load->view('hematology_1',$data);
     
    }
    public function manage_Biochemistry($id)
	{
     $data['biochemistry_data'] = $this->db->get_where('biochemistry_work',array('id'=>$id));
     $this->load->view('biochemistry',$data);
    }
    public function manage_Paracytology($id)
	{
     $data['paracytology_data'] = $this->db->get_where('parcytology_work',array('id'=>$id));
     $this->load->view('paracytology',$data);
     
    }
	
	
	
	
	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
	function manage_profile($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('laboratorist_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'update_profile_info') {
			$data['name']    = $this->input->post('name');
			$data['email']   = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['phone']   = $this->input->post('phone');
			
			$this->db->wherlae('boratorist_id', $this->session->userdata('laboratorist_id'));
			$this->db->update('laboratorist', $data);
			$this->session->set_flashdata('flash_message', get_phrase('profile_updated'));
			redirect(base_url() . 'index.php?laboratorist/manage_profile/', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['password']             = $this->input->post('password');
			$data['new_password']         = $this->input->post('new_password');
			$data['confirm_new_password'] = $this->input->post('confirm_new_password');
			
			$current_password = $this->db->get_where('laboratorist', array(
				'laboratorist_id' => $this->session->userdata('laboratorist_id')
			))->row()->password;
			if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
				$this->db->where('laboratorist_id', $this->session->userdata('laboratorist_id'));
				$this->db->update('laboratorist', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', get_phrase('password_updated'));
			} else {
				$this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
			}
			redirect(base_url() . 'index.php?laboratorist/manage_profile/', 'refresh');
		}
		$page_data['page_name']    = 'manage_profile';
		$page_data['page_title']   = get_phrase('manage_profile');
		$page_data['edit_profile'] = $this->db->get_where('laboratorist', array(
			'laboratorist_id' => $this->session->userdata('laboratorist_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}
}