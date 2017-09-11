<style>.hidedata {display:none;}</style>
<?php
// Start Session
/*session_start();
try
{
	// Include Required Classes
	require_once realpath(dirname(__FILE__) . "/../classes/db.php");

	// Create Objects Of Required Classes
	$Db = new Db();

	// Check Posted Data Has Value In It
	if(isset($_POST['post_doctor_id']))
	{
		$arr_new_id = $Db->getServicePrice($_POST['post_doctor_id']);
		echo $arr_new_id[0]['name'];
	}
}
catch(Exception $e)
{
  echo $e->getMessage();
}*/

// Check Posted Data Has Value In It
	include realpath(".") . "/mydb.php";
	//include realpath(".") .  "/../dompdf/dompdf_config.inc.php";
	// Create Objects Of Required Classes
	$Db = NULL;
	$Db = new  DB();
	//if(isset($_POST['post_ownperson']))
	//{
		
		$invoices = $Db->getdailyreceptionsale($_POST['post_ownperson'], $_POST['post_selected_date']);
		if (count($invoices) <= 0 )
		{
			echo  "<center><span style='color:red;font-size:20px;'>Invoice not found</span></center>";
			return;	
		}
		
?>
				<!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="forpint11new">
				          <!-- <img src="application/helpers/img/logo.png" />-->
                      <!--    <tr> <td colspan="6">
                              <div style="float: right;">
 								<input style="width:220px;height:40px;" type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print"/>
						</div>
                        </td></tr>-->
          		 <?php $rep_html ='<table cellpadding="0" cellspacing="0" border="0" class="dTable" style="width:100%;">
                	<thead>
					<tr>
                        <td align="center"  colspan="6">
                      	<img class="hidedata" src="../helpers/img/logo.png" /></td>
                        </tr>
						 <tr>
						 
                        <td align="center"  colspan="7">
                      <h2 class="hidedata">Daily Sale By '.$invoices[0]['createdby'].'</h2></td>
					 
                        </tr>
						<tr><td class="hidedata" align="right" colspan="6">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
						<tr>
                    	<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;width:30px;"><div>S.No.</div></th>
						<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;width:120px;"><div>Patient Reg No</div></th>
						<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
						<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;"><div>Doctor / Service Name </div></th>
						<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;width:100px;"><div>Service Name </div></th>
						<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;"><div>Creation Time</div></th>
							<th style="text-align:center;padding: 2px 2px 1px 2px; border: 1px solid; border-color: #0000;"><div>Amount</div></th>
							
						</tr>
					
					</thead>
                    <tbody>';
                      $Total_Received_Amount =0;
						$count= 1; foreach($invoices as $row):
						$dr_name = $row['dr_name'];
						$service_type = $row['service_type'];
						if (strlen($row['service_type']) <= 0 )
						{
							$service_type = "Consultation";
						}
            		     $rep_html .=' <tr>
     	<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['patient_reg_no'].'</td>
  		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['name'].'</td>
  		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$dr_name .'</td>
		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$service_type.'</td>
  		<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$row['creation_time'].'</td>
	 <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:right;">'.$row['receivedamount'].'</td>
	 </tr>';
	 
	 

	 					
						$Total_Received_Amount = $Total_Received_Amount + $row["receivedamount"];
						endforeach;
						
						
						
					$rep_html .='  <tr><td  colspan="7"> <table  align="right" style="margin-top:10px;">
                		<tr style="background:#3A6EA5; height:40px;"> 
                    	<th style="width:40%; color:#fff;"> Grand Total: </th>
                        <th style="width:40%; color:#fff;text-align:right;;">'. number_format($Total_Received_Amount, 2).'</th>
                    	</tr>';
						
						
					 $rep_html .='	</tbody></table>';
                      ?>	   		
               
                            	   
               	        <?php 
						
				   			echo $rep_html;
						/*
							$dompdf = new DOMPDF();
							$dompdf->load_html($rep_html);

					  	   $dompdf->render();

					      // The next call will store the entire PDF as a string in $pdf
						  $pdf = $dompdf->output();

						  // write $pdf to disk, store it in a database or stream it
						  // to the client.
				        
						 file_put_contents("../../reports/dailyreceptionsale.pdf", $pdf);
						 
						 */
				   
    ?>
 	      </div>
          
  			<input type="button" class="btn btn-green" name="print" id="print" value="    Print Report   " onClick="forprintdiv()" />

        <script>
    
  function forprintdiv() 
    {
        var data1 = $('#forpint11new').html();
        var mywindow = window.open('', 'my div', 'height=1000,width=1500, overflow=auto');
        mywindow.document.write('<html><head><title>Daily Reception Sale</title>');
        mywindow.document.write('</head><body>');
      
        mywindow.document.write(data1);
        mywindow.document.write('</body></html>');

        mywindow.print();
      

        return true;
    }
    
    </script>