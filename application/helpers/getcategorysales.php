<style>.hidedata{ display: none}</style>
<?php
// Check Posted Data Has Value In It
	include realpath(".") . "/mydb.php";
	
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
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="forpint11new">
				          <!-- <img src="application/helpers/img/logo.png" />-->
          		 <?php $rep_html ='<table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" style="width:100%;">
                	<thead>
					<tr>
                        <td align="center"  colspan="7">
                      	<img class="hidedata" src="../helpers/img/logo.png" /></td>
                        </tr>
						 <tr>
                        <td align="center"  colspan="7">
                      <h1 class="hidedata">Sales Category Report</h1></td>
                        </tr>
						<tr><td class="hidedata" align="right" colspan="7">Date &amp; Time: '.date('d-m-Y H:i', time()).' </td> </tr>
                		<tr>
                    	<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Serial No.</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Date/Time</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Patient Name</div></th>
					<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Category Name</div></th>
				<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Service Name</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div> Amount</div></th>
			<!--			<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>Discount Amount</div></th>-->
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>AMTF Share</div></th>
				<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>RMC Share</div></th>
						<th style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;"><div>CreatedBy</div></th>
						</tr>
					</thead>
                    <tbody>';
					
                    	    $count = 1; 
							$Total_Received_Amount = 0;
							$Share_Amount = 0 ;
							$Total_Shared_Amount = 0;
							$Total_RMC_Share = 0;
							$totalamount  = 0;
							$disamt =0;
							for($i=0;$i<count($invoices); $i++)
							{
								// $totalamount += $invoices[$i]['totalamount'];
								//$disamt += $invoices[$i]['discountamount'];
								$Total_Received_Amount += $invoices[$i]['recievedamount'];
								$rec_amt=($invoices[$i]['recievedamount']);
								$share_amt=($invoices[$i]['ratio']);
								$Share_Amount = (($rec_amt * $share_amt ) / 100);
								//$Share_Amount = (($invoices[$i]['recievedamount'] * 70 ) / 100);
								$Total_Shared_Amount += $Share_Amount;
								$RMC_Share = $rec_amt - $Share_Amount;
								
								$Total_RMC_Share += $RMC_Share;
								//$disamount=$totalamount-$disamt=$Total_Received_Amount/$Total_Shared_Amount;
						      //  echo $disamount;
            		     $rep_html .=' <tr>
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.($count++).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.date('m/d/Y H:i', strtotime($invoices[$i]["creation_time"])).'</td>
			            <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $invoices[$i]['patient_name'].'</td>
				       <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$invoices[$i]["cat_name"].'</td>	
					    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'.$invoices[$i]["ser_name"].'</td>
						
					    <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:right;">'.number_format($invoices[$i]['recievedamount'], 0).'</td>
				
                        <td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:right;">'.$Share_Amount.'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;text-align:right;">'.number_format($RMC_Share, 0).'</td>
						<td style="text-align:center;padding: 4px 2px 1px 4px; border: 1px solid; border-color: #0000;">'. $invoices[$i]['createdby'].'</td>
                        </tr>';
                       
           					   }
			   			$rep_html .='  <tr><td  colspan="9"> <table  align="right" style="margin-top:10px;">
                		<tr style="background:#3A6EA5; height:40px;"> 
                    	<th style="width:20%; color:#fff;"> Grand Total: </th>
						<th style="width:20%; color:#fff;text-align:right;">'. number_format($Total_Received_Amount, 0).'</th>
                        <th style="width:20%; color:#fff;text-align:right;">'. number_format($Total_Shared_Amount, 0).'</th>
                        <th style="width:20%; color:#fff;text-align:right;;">'. number_format($Total_RMC_Share, 0).'</th>
						
                    	</tr>
                   
                </table></td></tr></tbody></table>';
				
	}
	
	
?>	   
               	      
                        <?php //$rep_html .= '</tbody></table></div>';
				   			echo $rep_html;
						
							/*include realpath(".") .  "\..\dompdf\dompdf_config.inc.php";
							$dompdf = new DOMPDF();
							$dompdf->load_html($rep_html);

					  	   $dompdf->render();

					      // The next call will store the entire PDF as a string in $pdf
						  $pdf = $dompdf->output();

						  // write $pdf to disk, store it in a database or stream it
						  // to the client.
				        
						 file_put_contents("../../reports/salescategoryreport.pdf", $pdf);
				  		*/
    ?>
     <input type="button" class="btn btn-green" name="print" id="print" value="    Print Report   " onClick="forprintdiv()" />
 	      </div>

<script>
    
  function forprintdiv() 
    {
        var data1 = $('#forpint11new').html();
        var mywindow = window.open('', 'my div', 'height=1000,width=1500, overflow=auto');
        mywindow.document.write('<html><head><title>Sales Category Report</title>');
        mywindow.document.write('</head><body>');
      
        mywindow.document.write(data1);
        mywindow.document.write('</body></html>');

        mywindow.print();
      

        return true;
    }
    
    </script>