<?php 
include realpath(".") . "/mydb.php";
$Db = new Db();




function get_service_name($service_id){

 $CI = get_instance();
$result = $CI->$Db->get_where('diagnosticservice',array('diagnosticservice_id'=>$service_id))->result();
return $result;

}