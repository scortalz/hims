<?php 
$a = '<table class="opentime-table">
<tbody>
 <tr>

<td>
<select id="1_open_time" name="1_open_time" class="1_open_time" style="width:106px;">
<option value="-1">---- From -----</option>
<option value="00:00">12:00 am</option>
<option value="00:30">12:30 am</option>
<option value="01:00">1:00 am</option>
<option value="01:30">1:30 am</option>
<option value="02:00">2:00 am</option>
<option value="02:30">2:30 am</option>
<option value="03:00">3:00 am</option>
<option value="03:30">3:30 am</option>
<option value="04:00">4:00 am</option>
<option value="04:30">4:30 am</option>
<option value="05:00">5:00 am</option>
<option value="05:30">5:30 am</option>
<option value="06:00">6:00 am</option>
<option value="06:30">6:30 am</option>
<option value="07:00">7:00 am</option>
<option value="07:30">7:30 am</option>
<option value="08:00">8:00 am</option>
<option value="08:30">8:30 am</option>
<option value="09:00">9:00 am</option>
<option value="09:30">9:30 am</option>
<option value="10:00">10:00 am</option>
<option value="10:30">10:30 am</option>
<option value="11:00">11:00 am</option>
<option value="11:30">11:30 am</option>
<option value="12:00">12:00 pm</option>
<option value="12:30">12:30 pm</option>
<option value="13:00">1:00 pm</option>
<option value="13:30">1:30 pm</option>
<option value="14:00">2:00 pm</option>
<option value="14:30">2:30 pm</option>
<option value="15:00">3:00 pm</option>
<option value="15:30">3:30 pm</option>
<option value="16:00">4:00 pm</option>
<option value="16:30">4:30 pm</option>
<option value="17:00">5:00 pm</option>
<option value="17:30">5:30 pm</option>
<option value="18:00">6:00 pm</option>
<option value="18:30">6:30 pm</option>
<option value="19:00">7:00 pm</option>
<option value="19:30">7:30 pm</option>
<option value="20:00">8:00 pm</option>
<option value="20:30">8:30 pm</option>
<option value="21:00">9:00 pm</option>
<option value="21:30">9:30 pm</option>
<option value="22:00">10:00 pm</option>
<option value="22:30">10:30 pm</option>
<option value="23:00">11:00 pm</option>
<option value="23:30">11:30 pm</option>
</select>
<select id="1_close_time" name="1_close_time" class="1_open_time" style="width:106px;">
<option value="-1">---- To -----</option>
<option value="00:00">12:00 am</option>
<option value="00:30">12:30 am</option>
<option value="01:00">1:00 am</option>
<option value="01:30">1:30 am</option>
<option value="02:00">2:00 am</option>
<option value="02:30">2:30 am</option>
<option value="03:00">3:00 am</option>
<option value="03:30">3:30 am</option>
<option value="04:00">4:00 am</option>
<option value="04:30">4:30 am</option>
<option value="05:00">5:00 am</option>
<option value="05:30">5:30 am</option>
<option value="06:00">6:00 am</option>
<option value="06:30">6:30 am</option>
<option value="07:00">7:00 am</option>
<option value="07:30">7:30 am</option>
<option value="08:00">8:00 am</option>
<option value="08:30">8:30 am</option>
<option value="09:00">9:00 am</option>
<option value="09:30">9:30 am</option>
<option value="10:00">10:00 am</option>
<option value="10:30">10:30 am</option>
<option value="11:00">11:00 am</option>
<option value="11:30">11:30 am</option>
<option value="12:00">12:00 pm</option>
<option value="12:30">12:30 pm</option>
<option value="13:00">1:00 pm</option>
<option value="13:30">1:30 pm</option>
<option value="14:00">2:00 pm</option>
<option value="14:30">2:30 pm</option>
<option value="15:00">3:00 pm</option>
<option value="15:30">3:30 pm</option>
<option value="16:00">4:00 pm</option>
<option value="16:30">4:30 pm</option>
<option value="17:00">5:00 pm</option>
<option value="17:30">5:30 pm</option>
<option value="18:00">6:00 pm</option>
<option value="18:30">6:30 pm</option>
<option value="19:00">7:00 pm</option>
<option value="19:30">7:30 pm</option>
<option value="20:00">8:00 pm</option>
<option value="20:30">8:30 pm</option>
<option value="21:00">9:00 pm</option>
<option value="21:30">9:30 pm</option>
<option value="22:00">10:00 pm</option>
<option value="22:30">10:30 pm</option>
<option value="23:00">11:00 pm</option>
<option value="23:30">11:30 pm</option>
</select>
</tr>	

</tbody></table>';
				
//echo $a;
?>


<?php
try
{
	// Include Required Classes
	include realpath(".") . "/mydb.php";

	// Create Objects Of Required Classes
	$Db = new Db();
	// Check Posted Data Has Value In It
	if(isset($_POST['room_id']))
	{
		$datas = $Db->getbookedtiming($_POST['room_id']);
		//print_r($datas);exit;
	//	echo $data['1_open_time'];
	//	echo $data['1_close_time'];
		foreach($datas as $data)
		{
			//print_r($data);
			$am=$data['1_open_time'];
			$pm=$data['1_close_time'];
			$i=$am;
			while( $i<$pm )
			{
				 $i = strtotime($i . ' + 30 minutes ');
				 $i =DATE('H:i',$i );
				//echo $i;
				$a=str_replace('"'.$i.'"','"'.$i.'" disabled',$a);
				}
			$a=str_replace('"'.$am.'"','"'.$am.'" disabled',$a);
			$a=str_replace('"'.$pm.'"','"'.$pm.'" disabled',$a);
			
			}
			
			echo $a; //echo  $b;
	//	 echo json_encode(
			//	  array("message1" => $data[0]['1_open_time'], 
			//	  "message2" => $data[0]['1_close_time']));
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>	



