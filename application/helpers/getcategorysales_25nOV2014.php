<style>.hidedata{ display: none}</style>
<?php
// Check Posted Data Has Value In It
	include realpath(".") . "\mydb.php";
	
	// Create Objects Of Required Classes
	$Db = NULL;
	$Db = new  DB();
	if(isset($_POST['post_selected_date']))
	{
		$invoices = $Db->getCategorySalesReport($_POST['post_cat_name'],$_POST['post_selected_date'], $_POST["post_selected_date_to"]);
		/*echo  "<pre>";
		print_r($invoices);
		echo "</pre>";
		exit;*/
		//echo $arr_new_id[0]['name'];
?>
				<!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
				          <!-- <img src="application/helpers/img/logo.png" />-->
          		 <?php $rep_html ='<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
					<tr>
                        <td align="center"  colspan="5">
                      	<img class="hidedata" src="../helpers/img/logo.png" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="5">
                      <h1 class="hidedata">Sales Category Report</h1></td>
                        </tr>
						<tr><td class="hidedata" align="right" colspan="5">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date/Time</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Category Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Amount</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Share</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>CreatedBy</div></th>
						</tr>
					</thead>
                    <tbody>';
					
                    	    $count = 1; 
							$Total_Received_Amount = 0;
							$Share_Amount = 0 ;
							$Total_Shared_Amount = 0;
							for($i=0;$i<count($invoices); $i++)
							{
								$Total_Received_Amount += $invoices[$i]['recievedamount'];
								$Share_Amount = (($invoices[$i]['recievedamount'] * 70 ) / 100);
								$Total_Shared_Amount += $Share_Amount;
						
            		     $rep_html .=' <tr>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y H:i', strtotime($invoices[$i]["creation_time"])).'</td>
			            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $invoices[$i]['patient_name'].'</td>
				       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$invoices[$i]["cat_name"].'</td>		
					    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:right;">'.number_format($invoices[$i]['recievedamount'], 0).'</td>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:right;">'.number_format((($invoices[$i]['recievedamount'] * 70 ) / 100), 0).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $invoices[$i]['createdby'].'</td>
                        </tr>';
                       
           					   }
			   			$rep_html .='  <tr><td  colspan="7"> <table  align="right" style="margin-top:10px;">
                		<tr style="background:#3A6EA5; height:40px;"> 
                    	<th style="width:20%; color:#fff;"> Grand Total: </th>
                        <th style="width:20%; color:#fff;text-align:right;">'. number_format($Total_Received_Amount, 0).'</th>
                        <th style="width:20%; color:#fff;text-align:right;;">'. number_format($Total_Shared_Amount, 0).'</th>
						
                    	</tr>
                    	<tr>
                    	<td colspan="4">
                        	<div style="float: right;margin:10px;">
 								<input style="width:220px;height:40px;" type="button" name="btnReport" id="btnReport" value="Print Report" class="btn btn-green" title="Click here to print"/>
						</div>
                        </td>
                    </tr>
                </table></td></tr></tbody></table>';
	}
?>	   
               	        <?php //$rep_html .= '</tbody></table></div>';
				   			echo $rep_html;
						
							include realpath(".") .  "\..\dompdf\dompdf_config.inc.php";
							$dompdf = new DOMPDF();
							$dompdf->load_html($rep_html);

					  	   $dompdf->render();

					      // The next call will store the entire PDF as a string in $pdf
						  $pdf = $dompdf->output();

						  // write $pdf to disk, store it in a database or stream it
						  // to the client.
				        
						 file_put_contents("../../reports/salescategoryreport.pdf", $pdf);
				  
    ?>
 	      </div>
          
<script>

	$(document).ready(function(e) {
        $('#btnReport').click(function () {
  
		  var v = "reports/salescategoryreport.pdf";
		  window.location = v;
 });
    });
	
	</script>

        