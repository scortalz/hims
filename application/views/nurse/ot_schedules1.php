<div class="container-fluid padded">
	<div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons-->
            <?php $current_date = date('Y-m-d', time()); ?>
             <div class="span6" style='width:100%!important;'>
            	<div class="box">
                <div class="box-header">
                    <div class="title">
                        <i class="icon-calendar"></i> <?php echo get_phrase('OT Schedules - 24 Hours') . " -  ".date('D d M Y', strtotime($current_date)) ;?>
                    </div>
                </div>
                <div class="box-content">
                   <!--<div id="schedule_calendar">-->
                    <?php
					
					include   realpath(".") . "/application/helpers/mydb.php";
					$db = NULL;
					$db = new DB();
					// Call db->method to for Operation Theator Schedules
					
					$arrRegNo1 = $db->GetOTSchedulesByDate($current_date);
					$current_time =	$arrRegNo[0]['book_time']; //gmdate("h:i");// + '5.00.00';
					
                    $iTimestamp = mktime(1,0,0,1,1,2014);
					/* for ($i = 1; $i < 24; $i++) 
					{
						if (count($arrRegNo1) > 0 )
						{
							$arrRegNo = $db->GetOTSchedules(date("H:i",$iTimestamp), $current_date);
						
							if (count($arrRegNo) > 0 )
							{
								for ($m=0; $m< count($arrRegNo); $m++)
								{
									$db_time = $arrRegNo[$m]['book_time'];
									$id = $arrRegNo[$m]['id'];
									echo "<div class='fc-widget-content' style='height:30px;font-size:18px;color:#fff'><p align='center' style='background-color:red'>". $db_time . "</p>\n</div>"; 	
								}
								$db_time = "";
							}
							else
							{
								echo "<div class='fc-widget-content' style='height:30px;font-size:18px'><p align='center' >".date('H:i', $iTimestamp) . "</p>\n<br /></div>";	
							}
						 	//$iTimestamp += 3600;
						}
						else
						{
							echo "<div class='fc-widget-content' style='height:30px;font-size:18px'><p align='center' >".date('H:i', $iTimestamp) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n<br /></div>";	
						}
						 	$iTimestamp += 3600;
					}
					*/
					for ($i = 1; $i < 24; $i++) 
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
							 
							 $display_range = $start_hour + 1;
							 $db_time = $arrRegNo[$m]['book_time'];
							 $id = $arrRegNo[$m]['id'];
							 echo "<div class='fc-widget-content' style='height:30px;font-size:18px;color:#fff'><p align='center' style='background-color:red'>". $start_hour. ":00 - ".$display_range . ":00 (Doctor Name: $doctor_name), (Anesthetics Name: $anesthesia_name) </p>\n</div>";  
							}
							$db_time = "";
						   }
						   else
						   {
							echo "<div class='fc-widget-content' style='height:30px;font-size:18px'><p align='center' >".date('H:i', $iTimestamp) . "</p>\n<br /></div>"; 
						   }
							//$iTimestamp += 3600;
						  }
						  else
						  {
						   echo "<div class='fc-widget-content' style='height:30px;font-size:18px'><p align='center' >".date('H:i', $iTimestamp) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n<br /></div>"; 
						  }
							$iTimestamp += 3600;
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