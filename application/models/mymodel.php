
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


Class Mymodel extends CI_Model{

// Include Required Classes
   
 
 public function upload_img(){
	     $config['upload_path']          = './uploads/diagnosis_report/';
       
       $config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp';
      
       $config['max_size']      =   "5000";
       
       $config['encrypt_name']  = TRUE;
 
       $config['max_width']     =   "1907";
 
       $config['max_height']    =   "1280";
      

       if(is_file($config['upload_path']))
    {
      chmod($config['upload_path'], 777); 
    }
       $this->load->library('upload',$config);
       $this->upload->initialize($config);
      if ( ! $this->upload->do_upload())
                {
                      return  $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);
                }
                else
                {
                       return $data = array('upload_data' => $this->upload->data());

                        // $this->load->view('upload_success', $data);
                }
       // if ($this->upload->do_upload($filename))
       // {
	      //  	return $this->upload->data();
       // }else{
       // 	return "waqar ali";
       // }
	}
 
  public function get_service_name($service_id){

 
     $result = $this->db->get_where('diagnosticservice',array('diagnosticservice_id'=>$service_id))->result();
      return $result;

}
}