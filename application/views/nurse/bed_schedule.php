<div class="box">
<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="<?php if(!isset($edit_profile))echo 'active';?>">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo 'Bed Schedule List';?>
           	  </a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	
</div>

  <table width="100%"  border="1" >
  <tr>
  <td ><div align="center"><strong>Beds</strong></div></td>
    <?php	$head_row_date = date('m/d/Y', time());

//  	for ($m=0; $m<=9; $m++)
	//{
		//echo " <td width='9%'><div align='center'><strong>".date('d-M', strtotime($head_row_date))."</strong></div></td>";
		//$head_row_date = date('m/d/Y',strtotime('+1 day',strtotime($head_row_date)));
//		}
 ?>
  <table width="100%" >
  <tr>
  <?php
  
  			include realpath(".") . "\application\helpers\mydb.php";
			$Db = new Db();
			$arrBS = NULL;
			$row_date = date('m/d/Y', time());
  			//echo $row_date;
  			//exit();
  
  for($m=1; $m<=9; $m++)
  {
	  	 
  echo '<td><table width="100%"  border="1">';
  
	  $arrBSno =  $Db->getBedNumber();
	 /* echo '<pre>';
			print_r($arrBSno);
		echo '</pre>';*/
		
  //	for ($i=1; $i <= 20; $i++)//
//			{
      foreach($arrBSno as $arrbedno)
			{
	
	//print_r($arrbedno['bed_id']); exit;		
	
	$i=$arrbedno['bed_id'];
	if($i==1)
			{
				
		echo " <tr><td colspan='2' style='width:12%;' ><div align='center'><strong>".date('d/m/Y', strtotime($head_row_date))."</strong><br/></div></td></tr>";
		$head_row_date = date('m/d/Y',strtotime('+1 day',strtotime($head_row_date)));
		
				}  
				
					echo '<tr>';
			if($m==1)
			echo '<td width=6%>Bed '.$arrbedno['bed_number'].' </td>';
		
			echo '<td>';
			$arrBS =  $Db->getBedSchedules($row_date);
		/*echo '<pre>';
			print_r($arrBS[0]);
		echo '</pre>';*/
			if(count($arrBS))
			{
			foreach($arrBS as $arr) 
			{
				if($arr['bed_id']==$i )
				{
					echo "<span style='background-color:red;color:white;margin-left:8px;'><strong> ".$arr['name'].$head_row_date." </strong></span>";
					
					}
					else
					echo "<span>&nbsp;</span>";   //booked bed second time
			
			}
					echo '</td>';
			}
			else
			{
					echo "<span>&nbsp;</span>";    //booked bed second time
				}
				echo '</tr>';
		} //for ($i=1; $i <= 20; $i++)
			
					$row_date = date('m/d/Y',strtotime('+1 day',strtotime($row_date))); 	
			echo '</table></td>';
  }
			
		echo '</tr></table>'	
			
  /*	$head_row_date = date('m/d/Y', time());

  	for ($m=0; $m<=9; $m++)
	{
		echo " <td width='9%'><div align='center'><strong>".date('d-M', strtotime($head_row_date))."</strong></div></td>";
		$head_row_date = date('m/d/Y',strtotime('+1 day',strtotime($head_row_date)));
	}
	
	//for ($m=0; $m<=19; $m++)
	//{
	//	echo "<tr> <td width='9%'><div align='center'><strong>Bed #".($m + 1)."</strong></div></td>";
	//}
	
  		//$bed_allotments	=	$this->db->get('bed_allotment')->result_array();
			include realpath(".") . "\application\helpers\mydb.php";
			$Db = new Db();
			$arrBS = NULL;
			$row_date = date('m/d/Y', time());
			
			//echo $row_date;
			//exit;
			for ($i=0; $i < 20; $i++)
			{
				echo "<tr>";
				
				for ($k=1; $k<=11; $k++)
				{
					$arrBS =  $Db->getBedSchedules($row_date);
				//echo '<pre>'.count($arrBS);print_r($arrBS);echo '</pre>';exit();
					//echo $arrBS[0]['allotment_timestamp']; 
					
//					$bed_allot_date =   $arrBS[0]['allotment_timestamp'].' '.date('m/d/Y');
					$bed_allot_date =   date('m/d/Y',$arrBS[0]['allotment_timestamp']);//.' '.date('m/d/Y');
				//	echo $bed_allot_date.$row_date;exit;
					if (count($arrBS) > 0 )
					{
						
						if ($row_date == trim($bed_allot_date))
						{
							//for ($m=$k; $m<=11; $m++)
							//{
							//	echo "<td><div align='center'>&nbsp;</div></td>";
							//}
							if($i+1==$arrBS[0]['bed_id'])
							{
							echo "<td >&nbsp;$i.".$arrBS['bed_id']."$k</td><td style='background-color:red'><div align='center'>&nbsp;</div></td>";
							//exit;
							}
						//	break;
						}
						else
						{
							echo "<td><div align='center'>$row_date &nbsp;trim($bed_allot_date)</div></td>";
						}
						
					}
					else
					{
						if ($k == 1 )
						{
							echo "<td><div align='center'>Bed ".($i)."</div></td>";
						}
						else
						{
				
							echo "<td><div align='center'>&nbsp;$i.".$arrBS[0]['bed_id']."</div></td>";
						}
					}
					//$row_date = date('m/d/Y',strtotime('+1 day',strtotime($row_date)));
				}
				echo " </tr>";
				
				  
				
				//echo "Just Check...".$k;
			}*/
	?>
</table>

