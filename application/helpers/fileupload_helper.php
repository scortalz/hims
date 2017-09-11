<?php
     function upload_img($filename){
	   $config['upload_path']          = './uploads/diagnosis_report/';
       $config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp';
       $config['max_size']             = 5000;
       $config['encrypt_name']         = FALSE;
    /*   $config['max_width']            = 1024;
       $config['max_height']           = 768;*/
      $CI =& get_instance();
      $CI->load->library('upload', $config);

       if ($CI->upload->do_upload($filename))
       {
	       	return $CI->upload->data();
       }else{
       	return $CI->upload->display_errors('<div class="alert alert-error">', '</div>');
       }
	}
	




	
