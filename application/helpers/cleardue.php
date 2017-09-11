<?php
try
{
	include realpath(".") . "/mydb.php";

	$Db = new Db(); 

	$q = $_REQUEST["q"]; // requesting coming from  ipdadservice.php

	$hint = ""; // this variable i am using for responce

	if (!empty($q)) {	// condition that request comming should not be empty

		$clrdue = $Db->clrdueamt($q); // calling data from mydb.php
		if ($clrdue == true) { // if response come true from the function in DB
			$hint = "dues are cleared"; // this variable go as a response to ipdadservice.php
		}


	}

	echo $hint === "" ? "Select patient please" : $hint;  // incase hint is empty
	}

catch(Exception $e)
{
  echo $e->getMessage();
}
?>	