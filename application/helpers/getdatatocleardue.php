<?php
try
{
	include realpath(".") . "/mydb.php";

	$Db = new Db(); 

	$q = $_REQUEST["q"]; // requesting coming from  ipdadservice.php

	$hint = ""; // this variable i am using for responce

	if (!empty($q)) {	// condition that request comming should not be empty
		
		$getamt = $Db->getdueamt($q); // calling data from mydb.php

		if (!empty($getamt[0])) { // if data on 0 index is not empty 

		$hint = $getamt[0];	//then responce will be the result	
		// this variable go as a response to ipdadservice.php
		}

	}

	echo $hint === "" ? "You have no dues" : $hint;  // incase hint is empty
	}

catch(Exception $e)
{
  echo $e->getMessage();
}
?>	