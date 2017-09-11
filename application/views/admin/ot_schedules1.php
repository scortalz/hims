<div class="box">
<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li >
            	<a href="#OT1" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php
						include   realpath(".") . "/application/helpers/mydb.php";
					$db = NULL;
					$db = new DB();
					
					
					 echo get_phrase('OT_Schedule1');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
    <br />
<input style="float:right" type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print" onclick="scheduleprint()"/>
<br /><br />
<div class="tab-pane box active" id="OT1" style="padding: 5px">
<div class="container-fluid padded">
	<div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons-->
            <?php $current_date = date('Y-m-d', time()); ?>
             <div class="span6" style='width:100%!important;' id="innerdiv">
            <div class="box" style='background: none repeat scroll 0 0 #fbfbfb; border: 1px solid rgb(55,158,196);border-radius: 0;box-shadow: 0 2px 2px -2px rgb(55,158,196); margin-bottom: 20px;'>
                <div class="box-header" style=" border-top-left-radius: 0;
    border-top-right-radius: 0;background: none repeat scroll 0 0 rgb(55,158,196) !important;
    border-bottom: 1px solid rgb(55,158,196) !important;
    color: #ffffff !important;
    font-weight: 600;">
                    <div class="title" >
                        <i class="icon-calendar" ></i> <?php echo get_phrase('OT Schedules1 - 24 Hours') . " -  ".date('D d M Y', strtotime($current_date)) ;?>
                    </div>
                </div>
                <div class="box-content" style="border:1px solid rgb(55,158,196);">
                <div class="box-content">
                   <!--<div id="schedule_calendar">-->
                    <?php
					
				
					// Call db->method to for Operation Theator Schedules
					
					$arrRegNo1 = $db->GetOTSchedulesByDate($current_date);
					 //gmdate("h:i");// + '5.00.00';
				//	 print_r($arrRegNo1);
				//	 exit;
					$current_time =	$arrRegNo1[0]['book_time'];
                    $iTimestamp = mktime(0,0,0,1,1,2014);   //mktime ( hour, minute, second, month, day, year)

				         for ($i = 0; $i < 48; $i++) 
    				       {
						    if (count($arrRegNo1) > 0 )
						     {
						      $arrRegNo = $db->GetOTSchedules(date("H:i",$iTimestamp), $current_date);
						  		
						        if (count($arrRegNo) > 0 )
								   {
									for ($m=0; $m< count($arrRegNo); $m++)
									{
									 $start_hour = date('H', strtotime($arrRegNo[$m]['book_time']));
									 $doctor_name = $arrRegNo[$m]['name'];
									 $anesthesia_name = $arrRegNo[$m]['anesthesia_name'];
									 $display_range = strtotime($start_hour . '30 minutes'); 
									 $db_time = $arrRegNo[$m]['book_time'];
									 $end_time = $arrRegNo[$m]['end_time'];
									 $id = $arrRegNo[$m]['id'];
									//$next_time = $db_time;
							// echo "<div class='fc-widget-content' style='height:30px;font-size:18px;color:#fff'><p align='center' style='background-color:red'>". $start_hour. " - ".$display_range . " (Doctor Name: $doctor_name), (Anesthetics Name: $anesthesia_name) </p>\n</div>";  
							 
							  echo "<div class='fc-widget-content' style='height:30px;font-size:18px;color:#fff'><p align='center' style='background-color:red'>". $db_time ." - ".$end_time."(Doctor Name: $doctor_name), (Anesthetics Name: $anesthesia_name) </p>\n</div>";  
							  
							  $next_time = $db_time;
							}
							$db_time = "";
						   }
						   else
						   {
							echo "<div class='fc-widget-content' style='height:30px;font-size:18px'><p align='center' >".date('H:i', $iTimestamp) . "   - ". date('H:i', ( $iTimestamp + 1800 )). " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n<br /></div>"; 
						   }
							//$iTimestamp += 3600;
						  }
						  else
						  {
						   echo "<div class='fc-widget-content' style='height:30px;font-size:18px'><p align='center' >".date('H:i', $iTimestamp) . "   - ". date('H:i',
( $iTimestamp + 1800 )). " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n<br /></div>"; 
						  }
							$iTimestamp += 1800;
						 }
					?>
                    </div>
                </div>
            </div>
        </div>
            
        </div>
        <!---DASHBOARD MENU BAR ENDS HERE-->
    </div>
    <hr />    
</div>

</div>


    <script>

	function scheduleprint()
	{
	var data=document.getElementById('innerdiv').innerHTML;
	//alert(data)
		 jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url();?>/application/helpers/printotschedule1.php",
		data: ({post_date_id: data}),
			success: function(response)	
			{
				//alert(response);
				var v = "reports/otschedule1.pdf";
				  window.location = v;
				
			}
			
			});	
	}

</script>




