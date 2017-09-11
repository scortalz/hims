<?php

    include realpath(".") . "/mydb.php";
	$db = NULL;
	$db = new DB();
	$doctorid=$_POST['post_doctor_id'];
    //echo $doctorid;
	// $today = date('Y-m-d', time());
	$today = date('Y-m-d', strtotime($_POST['post_app_date']));
	$arrDay = $db->Generate_nextdaytoken_Number($today,$doctorid);
	$tokenno=$arrDay[0]['today_token_no'];
	echo $tokenno;

?>