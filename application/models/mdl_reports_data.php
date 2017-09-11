<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_reports_data extends CI_Model {
function __construct()
    {
        parent::__construct();
    }

    function add_heamatology_report_data($service_id)
    {
      
            $data['patient_name']            = $this->input->post('patient_name');
			// $data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['laboratrist_name']        = $this->session->userdata('laboratorist_name');
			$data['service_name']            = $this->input->post('service_name');
			$data['service_amount']          = $this->input->post('service_amount');
			$data['report_type']             = $this->input->post('report_type');
			$data['invoice_no']              = $this->input->post('invoice_no');
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
			$data['report_date']             =  $this->input->post('creation_date');	// print_r($data);exit();
			// $data['last_donation_timestamp'] = strtotime($this->input->post('last_donation_timestamp'));
			$this->db->insert('hematology_work', $data);
        
			$this->db->where('service_id', $service_id);
            $this->db->update('invoice_service_mapping', array('is_reported' => 1));
              // $this->db->last_query();

     } 

     function add_biochemistry_report_data($service_id)
     {
            $data['patient_name']            = $this->input->post('patient_name');
			// $data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratrist_name']        = $this->session->userdata('laboratorist_name');
			$data['phone']                   = $this->input->post('phone');
			$data['service_name']            = $this->input->post('service_name');
			$data['service_amount']          = $this->input->post('service_amount');
			$data['report_type']             = $this->input->post('report_type');
			$data['invoice_no']              = $this->input->post('invoice_no');
			$data['mobile_no']               = $this->input->post('mobile_no');
            $data['report_date']             = $this->input->post('creation_date');
            $data['glucose']                 = $this->input->post('glucose');
			$data['calcium']                 = $this->input->post('calcium');
			$data['report_date']             =  $this->input->post('creation_date');
            $this->db->insert('biochemistry_work', $data);

            $this->db->where('service_id', $service_id);
            $this->db->update('invoice_service_mapping', array('is_reported' => 1));

     } 
     
     function add_paracytology_report_data($service_id)
     {
            $data['patient_name']            = $this->input->post('patient_name');
			// $data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['laboratrist_name']        = $this->session->userdata('laboratorist_name');
			$data['phone']                   = $this->input->post('phone');
			$data['service_name']            = $this->input->post('service_name');
			$data['service_amount']          = $this->input->post('service_amount');
			$data['report_type']             = $this->input->post('report_type');
			$data['invoice_no']              = $this->input->post('invoice_no');
			$data['mobile_no']               = $this->input->post('mobile_no');
            $data['report_date']             = $this->input->post('creation_date');
            $data['report_date']             = $this->input->post('creation_date');
            $data['volume']                  = $this->input->post('volume');
			$data['color']                   = $this->input->post('color');
			$data['appearance']              = $this->input->post('appearance');
			$data['specific_gravity']        = $this->input->post('specific_gravity');
			$data['ph']                      = $this->input->post('ph');
			$data['glucose']                 = $this->input->post('glucose1');
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
            $this->db->insert('parcytology_work', $data);

            $this->db->where('service_id', $service_id);
            $this->db->update('invoice_service_mapping', array('is_reported' => 1));
       // echo $this->db->last_query();

     } 
     
     function add_heamatology1_report_data($service_id)
     {
       	   $data['patient_name']            = $this->input->post('patient_name');
			// $data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['service_name']            = $this->input->post('service_name');
			$data['service_amount']          = $this->input->post('service_amount');
			$data['report_type']             = $this->input->post('report_type');
			$data['invoice_no']              = $this->input->post('invoice_no');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['laboratrist_name']        = $this->session->userdata('laboratorist_name');
			$data['haemaglobin']             = $this->input->post('haemoglobin');
            $data['red_cells']               = $this->input->post('redcells');
			$data['pcv']                     = $this->input->post('pcv');
			$data['mcv']                     = $this->input->post('mcv');
			$data['mch']                     = $this->input->post('mch');
			$data['mchc']                    = $this->input->post('mchc');
            $data['morphology']              = $this->input->post('morphology');
			$data['report_date']             =  $this->input->post('creation_date');
            $this->db->insert('hematology_1_work', $data);

            $this->db->where('service_id', $service_id);
            $this->db->update('invoice_service_mapping', array('is_reported' => 1));



     } 
     
     function add_immunology_report_data($service_id)
     {
            $data['patient_name']            = $this->input->post('patient_name');
			// $data['blood_group']             = $this->input->post('blood_group');
			$data['sex']                     = $this->input->post('sex');
			$data['age']                     = $this->input->post('age');
			$data['doc_name']                = $this->input->post('doc_name');
			$data['phone']                   = $this->input->post('phone');
			$data['service_name']            = $this->input->post('service_name');
			$data['service_amount']          = $this->input->post('service_amount');
			$data['report_type']             = $this->input->post('report_type');
			$data['invoice_no']              = $this->input->post('invoice_no');
			$data['mobile_no']               = $this->input->post('mobile_no');
			$data['laboratrist_name']        = $this->session->userdata('laboratorist_name');
            $data['report_date']             =  $this->input->post('creation_date');
            $data['blood_hcg']               = $this->input->post('blood_hcg');           
 
            $this->db->insert('immunology_work', $data);

            $this->db->where('service_id', $service_id);
            $this->db->update('invoice_service_mapping', array('is_reported' => 1));


     }
 }