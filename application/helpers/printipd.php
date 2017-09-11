	<!--<script type="text/javascript" src="<?php ADMINISTRATION_PATH ?>js/jquery-latest.pack.js"></script>-->
    <?php
	//echo realpath(".");
	//exit;
	//include (dirname(__FILE__) . "/../includes/config.php");

    $browser_ver = get_browser(null,true);
	$pfn = "../../reports/patient_payment_history-".$_POST['invoice_no'].".pdf";	
    //echo $browser_ver['browser'];
    if($browser_ver['browser'] == 'IE') {
		$pfn = "../../reports/patient_payment_history-".$_POST['invoice_no'].".pdf";	
		?>
    <!DOCTYPE html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
    html { height:100%; }
    </style>
    <script>
    function printIt(id){
    var pdf = document.getElementById("samplePDF");
    pdf.click();
    pdf.setActive();
    pdf.focus();
    pdf.print();
    }
    </script>
    </head>
    <body style="margin:0; height:1000;">
    <embed id="samplePDF" type="application/pdf" src="<?php echo $pfn; ?>"   width="100%" height="1000"   />
    <button onClick="printIt('samplePDF')">Print</button>
    </body>
    </html>
    <?php
    } else {
		$pfn = "../../reports/patient_payment_history-".$_POST['invoice_no'].".pdf";
		//echo $pfn ;
    ?>
    <HTML> 
    <script Language="javascript">
    function printfile(id)
    {
    window.frames[id].focus();
    window.frames[id].print();
    }
    </script>
    <BODY marginheight="0" marginwidth="0">
    <iframe src="<?php echo $pfn; ?>" id="objAdobePrint" name="objAdobePrint" height="1000" width="100%" frameborder=0></iframe>
    <input type="button" value="Print" onClick="javascript: printfile('objAdobePrint');">
    </BODY>
    </HTML>
    <?php
    }
    ?>