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
 
<table width="100%"  border="1">
  <tr>
  <td ><div align="center"><strong>Beds</strong></div></td>
  <?php
  	$head_row_date = date('m/d/Y', time());

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
	//				echo '<pre>';print_r($arrBS);echo '</pre>';exit();
					$bed_allot_date =   $arrBS['allotment_timestamp'].' '.date('m/d/Y');
					if (count($arrBS) > 0 )
					{
						
						if ($row_date == trim($bed_allot_date))
						{
							echo "<td >&nbsp;</td><td style='background-color:red'><div align='center'>&nbsp;</div></td>";
							//for ($m=$k; $m<=11; $m++)
							//{
							//	echo "<td><div align='center'>&nbsp;</div></td>";
							//}
							break;
						}
						else
						{
							echo "<td><div align='center'>&nbsp;</div></td>";
						}
						
					}
					else
					{
						//if ($i == 1 )
						//{
						//	echo "<td><div align='center'>Bed ".($i)."</div></td>";
						//}
						//else
						//{
							echo "<td><div align='center'>&nbsp;</div></td>";
						//}
					}
				}
				echo " </tr>";
				$row_date = date('m/d/Y',strtotime('+1 day',strtotime($row_date)));
				  
				
				//echo "Just Check...".$k;
				?>
  </tr>
  
  <?php
			}
	?>
</table>

