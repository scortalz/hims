<?php
try
{
	include realpath(".") . "/mydb.php";

	$Db = new Db(); 

	$q = $_REQUEST["q"]; // requesting coming from  ipdadservice.php

	$hint = ""; // this variable i am using for responce

	if (!empty($q)) {	// condition that request comming should not be empty
		
		$getdoctor = $Db->getdoc($q); // calling data from mydb.php

		}

	

	echo json_encode($getdoctor);  // incase hint is empty
	
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>