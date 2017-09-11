<?php
//echo $_POST['post_date_id']; exit;

// Check Posted Data Has Value In It
	//include realpath(".") . "/mydb.php";
	//include realpath(".") .  "\..\dompdf\dompdf_config.inc.php";
	 require_once realpath(".") .  "/../dompdf/dompdf_config.inc.php";
	//echo  realpath("."); exit();
	// Create Objects Of Required Classes
	//$Db = NULL;
	//$Db = new  DB();
	
?>

				<!----TABLE LISTING STARTS--->
           
				  <!--<img src="application/helpers/img/logo.png" />
                  <h1>Bed Schedule</h1>
-->          		 <?php $rep_html ="<div align='center'><img src='../helpers/img/logo.png' />
                  <h1 >OT Schedule 1</h1> </div>".'<table align="center">'.$_POST['post_date_id'].'</table>';
?>	   
               	        <?php //$rep_html .= '</tbody></table></div>';
				   			//echo $rep_html;
						
							$dompdf = new DOMPDF();
							$dompdf->load_html($rep_html);
                          //  $dompdf->set_paper("A4","landscape");
					  	   $dompdf->render();

					      // The next call will store the entire PDF as a string in $pdf
						  $pdf = $dompdf->output();
                         
						  // write $pdf to disk, store it in a database or stream it
						  // to the client.
				        
						 file_put_contents("../../reports/otschedule1.pdf", $pdf);
				   
    ?>
 	



        