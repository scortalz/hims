<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	$column = $_POST['column'];
	$editval = $_POST['editval'];
	$id = $_POST['id'];

	// Create Objects Of Required Classes
	$Db = new Db();
	


 $Db->invoicekiedit($column,$editval,$id);
		

}
catch(Exception $e)
{
   $Db->invoicekiedit($column,$editval,$id);
}
     echo true;
?>	

