<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_invoice extends CI_Model {
function __construct()
    {
        parent::__construct();
    }

     function add_patient_also_invoice()
     {      
     	    $patient_reg_no                      = $this->input->post('patient_reg_no');
     	    $mydata['patient_reg_no']            = $this->input->post('patient_reg_no');
            $mydata['doctor_id']                 = $this->input->post('doctor_id');
		    $mydata['patient_type']              = $this->input->post('patient_type');
		    $mydata['refferedby']                = $this->input->post('refferedby');
		    $mydata['med_card_no']               = $this->input->post('med_card_no');
		    $mydata['salutation']                = $this->input->post('salutation');
		    $mydata['name']                      = $this->input->post('name');
		    $mydata['father_husbandname']        = $this->input->post('father_husbandname');
		    // $mydata['email']                     = $this->input->post('email');
		    // $mydata['password']                  = $this->input->post('password');
		    $mydata['nic_no']                    = $this->input->post('start_5').'-'.$this->input->post('mid_7').'-'.$this->input->post('end_1');
		    $mydata['address']                   = $this->input->post('address');
		    $mydata['phone']                     = $this->input->post('phone');
		    $mydata['sex']                       = $this->input->post('sex');
		    $mydata['birth_date']                = $this->input->post('birth_date');
		    $mydata['age']                       = $this->input->post('age');
		    $mydata['blood_group']               = $this->input->post('blood_group');
		    $mydata['admission_date']               = date('Y-m-d H:i:s', time());
		    $mydata['account_opening_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i'));
            $this->db->insert('patient', $mydata);
            
            
            $patient_id = $this->db->get_where('patient',array('patient_reg_no'=>$patient_reg_no))->row();
            $data['patient_id']         = $patient_id->patient_id;
			$data['invoice_number']     = $this->input->post('invoice_no');
			$data['doctor_id']          = $this->input->post('doctor_id');
			/*$data['service_id']       = $this->input->post('service_id');*/
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
		    $data['med_card_no']        = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']     = $this->input->post('discountamount');
			$data['discount']           = $this->input->post('discount');
			$data['recievedamount']     = $this->input->post('recievedamount');
			$data['dueamount']          = $this->input->post('dueamount');
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
          }
          public function add_invoice_only(){

          	$data['patient_id']         = $this->input->post('patient_id');
			$data['invoice_number']     = $this->input->post('invoice_no');
			$data['doctor_id']          = $this->input->post('doctor_id');
			/*$data['service_id']       = $this->input->post('service_id');*/
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
		    $data['med_card_no']        = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']     = $this->input->post('discountamount');
			$data['discount']           = $this->input->post('discount');
			$data['recievedamount']     = $this->input->post('recievedamount');
			$data['dueamount']          = $this->input->post('dueamount');
			$data['careof']             = $this->input->post('careof');
			$data['createdby']          = $this->input->post('createdby');
			$data['creation_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));	
			$data['creation_time']	 	= date('Y-m-d H:i', time());
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
          }
    function add_patient_also_appointment()
     {      
     	    $patient_reg_no                      = $this->input->post('patient_reg_no');
     	    $mydata['patient_reg_no']            = $this->input->post('patient_reg_no');
            $mydata['doctor_id']                 = $this->input->post('doctor_id');
		    $mydata['patient_type']              = $this->input->post('patient_type');
		    $mydata['refferedby']                = $this->input->post('refferedby');
		    $mydata['med_card_no']               = $this->input->post('med_card_no');
		    $mydata['salutation']                = $this->input->post('salutation');
		    $mydata['name']                      = $this->input->post('name');
		    $mydata['father_husbandname']        = $this->input->post('father_husbandname');
		    // $mydata['email']                     = $this->input->post('email');
		    // $mydata['password']                  = $this->input->post('password');
		    $mydata['nic_no']                    = $this->input->post('start_5').'-'.$this->input->post('mid_7').'-'.$this->input->post('end_1');
		    $mydata['address']                   = $this->input->post('address');
		    $mydata['phone']                     = $this->input->post('phone');
		    $mydata['sex']                       = $this->input->post('sex');
		    $mydata['birth_date']                = $this->input->post('birth_date');
		    $mydata['age']                       = $this->input->post('age');
		    $mydata['blood_group']               = $this->input->post('blood_group');
		    $mydata['admission_date']               = date('Y-m-d H:i:s', time());
		    $mydata['account_opening_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i'));

            $this->db->insert('patient', $mydata);

              $patient_id = $this->db->get_where('patient',array('patient_reg_no'=>$patient_reg_no))->row();

    		$inv['patient_id']         = $patient_id->patient_id;
			$inv['invoice_number']     = $this->input->post('invoice_no');
			$inv['doctor_id']          = $this->input->post('doctor_id');
			/*$inv['service_id']       = $this->input->post('service_id');*/
			$inv['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$inv['selected_services']  = $this->input->post('selected_services');   //service name
			$inv['refferedby']         = $this->input->post('refferedby');
		    $inv['med_card_no']        = $this->input->post('med_card_no');
			$inv['totalamount']        = $this->input->post('totalamount');
			$inv['discountamount']     = $this->input->post('discountamount');
			$inv['discount']           = $this->input->post('discount');
			$inv['recievedamount']     = $this->input->post('recievedamount');
			$inv['dueamount']          = $this->input->post('dueamount');
			$inv['careof']             = $this->input->post('careof');
			$inv['createdby']          = $this->input->post('createdby');
			$inv['creation_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			$inv['creation_time']	= date('Y-m-d H:i', time());
			$inv['approved']=0;
			if($inv['discount']>=10)
			{
				$inv['need_approval']=1;  //
				}
				else
				{$inv['need_approval']=0;} //
			
			//if ( $this->input->post('discount') > 100 )
			if($inv['discount']>=100)
			{
				redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
				return;	
			}

			$this->db->insert('invoice', $inv);
            
            
            $patient_id = $this->db->get_where('patient',array('patient_reg_no'=>$patient_reg_no))->row();
            $data['patient_id']         = $patient_id->patient_id;
			$data['invoice_number']     = $this->input->post('invoice_no');
			$data['doctor_id']          = $this->input->post('doctor_id');
			$data['date_of_appointment']= $this->input->post('date_of_appointment');
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
		    $data['med_card_no']        = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']     = $this->input->post('discountamount');
			$data['discount']           = $this->input->post('discount');
			$data['recievedamount']     = $this->input->post('recievedamount');
			$data['dueamount']          = $this->input->post('dueamount');
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


			$this->db->insert('my_advance_appointment', $data);
          }

          public function addinvoiceforadvance(){

			$patient_reg_no                      = $this->input->post('patient_reg_no');
     	    $mydata['patient_reg_no']            = $this->input->post('patient_reg_no');
            $mydata['doctor_id']                 = $this->input->post('doctor_id');
		    $mydata['patient_type']              = $this->input->post('patient_type');
		    $mydata['refferedby']                = $this->input->post('refferedby');
		    $mydata['med_card_no']               = $this->input->post('med_card_no');
		    $mydata['salutation']                = $this->input->post('salutation');
		    $mydata['name']                      = $this->input->post('name');
		    $mydata['father_husbandname']        = $this->input->post('father_husbandname');
		    // $mydata['email']                     = $this->input->post('email');
		    // $mydata['password']                  = $this->input->post('password');
		    $mydata['nic_no']                    = $this->input->post('start_5').'-'.$this->input->post('mid_7').'-'.$this->input->post('end_1');
		    $mydata['address']                   = $this->input->post('address');
		    $mydata['phone']                     = $this->input->post('phone');
		    $mydata['sex']                       = $this->input->post('sex');
		    $mydata['birth_date']                = $this->input->post('birth_date');
		    $mydata['age']                       = $this->input->post('age');
		    $mydata['blood_group']               = $this->input->post('blood_group');
		    $mydata['admission_date']               = date('Y-m-d H:i:s', time());
		    $mydata['account_opening_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i'));




          	//data below will send data to invoice

          	$data['patient_id']         = $this->input->post('patient_id');
			$data['invoice_number']     = $this->input->post('invoice_no');
			$data['doctor_id']          = $this->input->post('doctor_id');
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
		    $data['med_card_no']        = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']     = $this->input->post('discountamount');
			$data['discount']           = $this->input->post('discount');
			$data['recievedamount']     = $this->input->post('recievedamount');
			$data['dueamount']          = $this->input->post('dueamount');
			$data['careof']             = $this->input->post('careof');
			$data['createdby']          = $this->input->post('createdby');
			$data['creation_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));	
			$data['creation_time']	 	= date('Y-m-d H:i', time());
			$data['approved']=0;
			if($data['discount']>=10)
			{
			$data['need_approval']=1;  //
			}
			else
			{
			$data['need_approval']=0;
          	}
			$this->db->insert('invoice', $data);

      }
          public function add_advance_appointment_invoice_only(){

          	$data['patient_id']         = $this->input->post('patient_id');
			$data['invoice_number']     = $this->input->post('invoice_no');
			$data['doctor_id']          = $this->input->post('doctor_id');
			$data['date_of_appointment']= $this->input->post('date_of_appointment');
			/*$data['service_id']       = $this->input->post('service_id');*/
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
		    $data['med_card_no']        = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']     = $this->input->post('discountamount');
			$data['discount']           = $this->input->post('discount');
			$data['recievedamount']     = $this->input->post('recievedamount');
			$data['dueamount']          = $this->input->post('dueamount');
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

          	$inv['patient_id']         = $this->input->post('patient_id');
			$inv['invoice_number']     = $this->input->post('invoice_no');
			$inv['doctor_id']          = $this->input->post('doctor_id');
			/*$inv['service_id']       = $this->input->post('service_id');*/
			$inv['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$inv['selected_services']  = $this->input->post('selected_services');   //service name
			$inv['refferedby']         = $this->input->post('refferedby');
		    $inv['med_card_no']        = $this->input->post('med_card_no');
			$inv['totalamount']        = $this->input->post('totalamount');
			$inv['discountamount']     = $this->input->post('discountamount');
			$inv['discount']           = $this->input->post('discount');
			$inv['recievedamount']     = $this->input->post('recievedamount');
			$inv['dueamount']          = $this->input->post('dueamount');
			$inv['careof']             = $this->input->post('careof');
			$inv['createdby']          = $this->input->post('createdby');
			$inv['creation_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
			$inv['creation_time'] = date('Y-m-d H:i', time());
			$inv['approved']=0;
			if($inv['discount']>=10)
			{
				$inv['need_approval']=1;  //
				}
				else
				{$inv['need_approval']=0;} //
			
			//if ( $this->input->post('discount') > 100 )
			if($inv['discount']>=100)
			{
				redirect(base_url() . 'index.php?reception/manage_invoice', 'refresh');
				return;	
			}

			$this->db->insert('invoice', $inv);

			$this->db->insert('my_advance_appointment', $data);
          }







          

      function edit_invoice()
      {
            $data['patient_id']         = $this->input->post('patient_id');
			$data['doctor_id']          = $this->input->post('doctor_id');
			/*$data['service_id']  = $this->input->post('service_id');*/
			$data['diagnostictype_id']  = $this->input->post('diagnostictype_id');   //category name
			$data['selected_services']  = $this->input->post('selected_services');   //service name
			$data['refferedby']         = $this->input->post('refferedby');
			$data['med_card_no']        = $this->input->post('med_card_no');
			$data['totalamount']        = $this->input->post('totalamount');
			$data['discountamount']     = $this->input->post('discountamount');
			$data['discount']           = $this->input->post('discount');
			$data['recievedamount']     = $this->input->post('recievedamount');
			$data['dueamount']          = $this->input->post('dueamount');
			$data['careof']             = $this->input->post('careof');
			$data['createdby']          = $this->input->post('createdby');
			$data['creation_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
            $this->db->where('invoice_id', $param3);
			$this->db->update('invoice', $data);

      }


		





}