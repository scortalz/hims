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

<label>Search
<input type="text" id="date" name="date" class="datepicker fill-up" onchange="getdate(this.value)" />
</label>
<input type="button" style="float:right" name="Report" id="Report" onclick="scheduleprint()" value="Print Report" class="btn btn-green" title="Click here to print" />
 
  <table width="100%"  border="1" >
  <tr>
  <td ><div align="center"><strong>Beds</strong></div></td>
    <?php	$head_row_date = date('m/d/Y', time());
	
	//echo $head_row_date;

		//  	for ($m=0; $m<=9; $m++)
	//{
		//echo " <td width='9%'><div align='center'><strong>".date('d-M', strtotime($head_row_date))."</strong></div></td>";
		//$head_row_date = date('m/d/Y',strtotime('+1 day',strtotime($head_row_date)));
	//		}
 ?></tr></table>
  <table  width="100%" id="innertable" cellpadding="0" cellspacing="0" >
  
  <tr>
  <?php
  
  			include realpath(".") . "\application\helpers\mydb.php";
			$Db = new Db();
			$arrBS = NULL;
			$row_date = date('m/d/Y', time());

  			//echo $row_date;
  			//exit();
  
			 // echo $sdate; ; 
  
  if($sdate!='//')
  {
		//$sdate=split('=',$sdate);
	  $limit=1;
		//  $row_date= $sdate;
	  $row_date = date('m/d/Y',strtotime($sdate));
	  
	  $head_row_date = date('m/d/Y',strtotime($sdate));
	  
	  }
	  else
	  $limit=7;
	  
  for($m=1; $m<=$limit; $m++)
  {
	  	 
  echo '<td ><table width="100%"  border="1" cellpadding="0" cellspacing="0"  >';
  
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
				//$head_row_date = date('m/d/Y', time());
		echo " <tr><td colspan='2' style='width:12%;' ><div align='center'><strong>".date('m/d/Y', strtotime($head_row_date))."</strong><br/></div></td></tr>";
		$head_row_date = date('m/d/Y',strtotime('+1 day',strtotime($head_row_date)));
		
				}  
				
			echo '<tr>';
			if($m==1)
			echo '<td width=6% > <strong>'.$arrbedno['type'].'&nbsp;</strong>'.$arrbedno['bed_number'].' </td>';
		
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
					echo "<span style='background-color:red;margin-left:8px;'><strong> ".$arr['name'];" </strong></span>";
					
					}
					else
					echo "<span >&nbsp;</span>";   //booked bed second time
			
			}
					echo '</td>';
			}
			else
			{
					echo "<span >&nbsp;</span>";    //booked bed second time
				}
				echo '</tr>';
		} //for ($i=1; $i <= 20; $i++)
			
					$row_date = date('m/d/Y',strtotime('+1 day',strtotime($row_date))); 	
			echo '</td></table>';
  }
			
		echo '</table></tr>'	
			
	?>
</table>

<script>
		function getdate(id) {
      // alert(id)
       var url = window.location.href;
        var n = url.indexOf("/bed_schedule"); 
                  //alert(n)
                  if(n!=-1)
                      url = url.substring(0, n); 
       window.location.href = url + '/bed_schedule/' + id;
    }
</script>
    
    <script>

	function scheduleprint()
	{
	var data=document.getElementById('innertable').innerHTML;
	//alert(data)
		 jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/printschedule.php",
		data: ({post_date_id: data}),
			success: function(response)	
			{
				//alert(response);
				var v = "reports/bedschedule.pdf";
				  window.location = v;
				
			}
			
			});	
	}
		//var v = "reports/bedschedule.pdf";
		// window.location = v;
</script>


