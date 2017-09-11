 <!DOCTYPE html>
<html>


	<head>
	<title>Patient Slip (OPD)</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
    *{
	padding:0;
	margin:0;
}

.wrapper {
	width: 90%;
	float: left;
	margin-left:5%;
	background-color: #fdfdfd;
	overflow: hidden;
}

.wrapper .header {
	width: 100%;
	float: left;
	background: blue; /* For browsers that do not support gradients */    
    background: -webkit-radial-gradient(#fdfdff,lightblue, powderblue); /* Safari 5.1 to 6.0 */
    background: -o-radial-gradient(#fdfdff,lightblue, powderblue); /* For Opera 11.6 to 12.0 */
    background: -moz-radial-gradient(#fdfdff,lightblue, powderblue); /* For Firefox 3.6 to 15 */
    background: radial-gradient(#fdfdff,lightblue, powderblue); /* Standard syntax (must be last) */

}

.line{
	margin-top: 2px;
	margin-bottom: 0px !important;
}

.header .logo-header {
	float: left;
	width: 100%;
	padding: 0px 30px;
	border-bottom: 2px solid #0000da; 
	float: left;
}

.logo{
	float: left;
	width: 15%;
}

.logo img{
	width: 120px;
	height: 100px;
}

.logo-name{
	width:100%;
	
	/*float: left;*/
}

.batool{

	font-size:26px;
}

.logo-name h1{
	font-size:44px;
	color: red;
	margin-top: 30px;
	margin-bottom: 0px;
	font-family: sans-serif;
	text-align: center;

}

.logo-name p{
	font-size:15px;
	color:#0000da;
	margin-top: 10px;
	font-weight: bold;
	font-family: sans-serif;
}

.info-header{
	width:100%;
	float:left;
	background-color: yellow;
}

.info-header .name{
	width: 32%;
	float: left;

	font-size:1vw;
	font-family: sans-serif;
	padding: 4px;

}


.info-header .dep{
	width:32%;
	float: left;
	line-height: 23px;
}
.info-header .dep2{
	width:44%;
	float: left;
	
}

.info-header .dep2 input{
	padding: 2px 10%;
	margin-bottom: 2px;
	border-radius:5px; 
}

.age{
	width:45%;
	float: left;
	
	font-size:1vw;
	font-family: sans-serif;
	padding: 4px;

}

.info-header .age input{
	padding:2px;
	margin-bottom: 2px;
	border-radius:5px; 
}
.mob{
	margin-top: 5px;
	width:20%;
	float: left;
	font-size:1vw;
	font-family: sans-serif;
	padding: 4px;
	
}

.mob .mob1{
	width: 20%;
	float:left;
}

.mob .mob2{
	width: 20%;
	float:left;
}

.mob .mob2 input{
	padding:2px;
	margin-bottom: 2px;
	border-radius:5px; 
}

.contain{
	width:100%;
	float: left;
	
}


.test{
	float: left
	width:100%;
	font-family: sans-serif;

}

.test1{
	float: left;
	width: 33.2%;
	border:1px solid black; 
	border-right: transparent;
	padding: 5px 0px;
}

.result{
	float: left;
	width: 33.2%;
	text-align: center;
	border:1px solid black; 
	border-left: transparent;
	border-right: transparent;
	padding: 5px 0px;
}

.ref{
	float: left;
	width: 33.3%;
	text-align: right;
	border:1px solid black; 
	border-left: transparent;
	padding: 5px 0px;
}

.maintest{
	width: 100%;
	float: left;
	margin-bottom: 8px;
	font-family: sans-serif;

}


.testlist{
	float: left;
	width: 33%;

}

.testlist p{
	font-size: 13px;
}

.resultlist{
	float: left;
	width: 33%;
	text-align: center;
}

.resultlist p{
	font-size: 13px;
}

.reflist{
	float: left;
	width: 33%;
	text-align: right;
}

.reflist p{
	font-size: 15px;
}

.footer{
	width: 100%;
	float: left;
}

.remarks{
	width:8%;
	float: left;
	
}

.remarkcol{
	width: 90%;
	float: left;
	border:1px solid black;
	
}

.path{
	float: right;
	width: 7%;
}

.blankpath .pathologist{
	width: 100%;
	float: left;
	border: 1px solid black; 
}

.mainfooter{
	width: 100%;
	float: left;
	background-color: #663399;
	margin-top:20px!important;
}

.mainfooter h6{
	font-size:15px;
	color:#fdfdfd;
	letter-spacing: 1px;
	font-family: sans-serif;
	padding-bootom:0px !important;
	text-align: center;
}
.cen td {
	text-align:right;"
}
}
/*.info_header>table{ background-color:#FBFCFC;width:100%; }*/
 .info_header > table > tbody > tr > td{font-size: 10px;}
 /*.contain > table > thead > tr {border:3px solid gray;}
 .contain > table > thead > tr > th{font-size: 18px;background-color:#FBFCFC;padding:0px !important;}*/
 .contain > table > tbody {background-color:#FBFCFC;}
 .contain{background-color:#FBFCFC;}
 .contain > table > tbody > tr > td {padding:5px;}
 .contain > table {margin-bottom: 0px !important;}
 .a { 
 	border-radius: 4px;
 	padding: 5px 10px;
 	background-color: #5555df;
 	color:white;
 }
.b { 
 	border-radius: 4px;
 	padding: 5px 10px;
 	border :2px solid white;
 	
 }

	</style>
	</head>

	<body>
		
		<div class="wrapper">
			<div class="header">
				<div class="logo-header">
					<div class="logo">
						<img src="img/BHI-logo.png" alt="batool_logo">
					</div>
					<div class="logo-name">
						<h1 style="padding-left:30px;">B<span class="batool">ATOOL </span>G<span class="batool">ENERAL </span>H<span class="batool">OSPITAL </span></h1>
						<hr color="red" class="line">
						<hr color="blue" class="line">
						
					</div>
				</div>
				<div class="info_header">
                <table class="table" style="background-color:#FBFCFC;" >
                	
                		
                
                	
                </table>
				
			</div>

			<div class="contain">
				<div class="heading" style="width:100%;font-size:20px;margin-top:0px;"><center>Patient Slip (OPD)</center></div>
				<br />
				<table class="table">
					
						<tbody style="padding:5px !imported;">
                		<tr>
                			
                			<td><label>Slip No :</label><label style = "margin-left:2%;">17-15059 MRN:#0</label></td>
                			<td><label>Date :</label><label style = "margin-left:2%;">15-feb-2017 9:40:42</label></td>
                		</tr>
                		<tr>
                			<td><label>Patient Name :</label><label style = "margin-left:2%;">MASTER MUZAMIL</label></td>
                			<td><label>Age :</label><label style = "margin-left:2%;">5 Days</label></td>
                		    </tr>
                		    <tr>
                			<td><label>User :</label><label style = "margin-left:2%;">SAFIA KHAN</label></td>
                			<td><label>RMO/Consultant :</label><label style = "margin-left:2%;">Dr.SELF</label></td>
                		</tr>
                		<tr>
                			<td><label>Shift :</label><label style = "margin-left:2%;">Morning</label></td>
                		    <td><label>Corporate :</label><label style = "margin-left:20px;">Hospital Patient</label></td>
                		    </tr>

                		
                	</tbody>
				</table>
					
				
                 	
			</div>
					
			<table class="table tab">
					
						<thead>
							<tr>
								<th ><label>Sno</label></th>
								<th colspan="8"><label>Discription</label></th>
								
								<th style="text-align:center;"><label>Amount</label></th>
							</tr>
						</thead>
						<tbody>
						
						<tr >
							<td><label>1</label></td>
                            <td colspan="8"><label >INJECTION</label></td>
                            <td align="center"><label>50.00</label></td> 
                            
                        </tr>
                    
                        <tr>
                        	<td colspan="9" align="right" ><label ><span class="a">Total Amount</span></label></td>
                        	<td align="center"><label ><span class="b">50.00</span></label></td>
                        </tr>
                         <tr>
                        	<td colspan="9" align="right" ><label ><span class="a">Discount</span></label></td>
                        	<td align="center"><label ><span class="b">0.00</span></label></td>
                        </tr>
                         <tr>
                        	<td colspan="9" align="right" ><label ><span class="a">Cash Recieved</span></label ></td>
                        	<td align="center"><label ><span class="b">50.00</span></label></td>
                        </tr>
                         <tr>
                        	<td colspan="9" align="right" ><label ><span class="a">Panel Amount</span></label ></td>
                        	<td align="center"><label ><span class="b">0.00</span></label></td>
                        </tr>
                       </tbody>
                       </table >

                       <table class="table tab" frame="hsides">
                       <tbody>
                        <tr>

							<td><label>Printed By:SAFIA KHAN Print Date-Time :15-02-2017 9:46:34 AM</label></td>
                            <td colspan="2"><label></label></td>
                            <td><label><u></u></label></td>
						</tr>
						<tr >
							<td><label ></label></td>
                            <td ><label></label></td>
                            <td ><label>Signature Of</label></td>
						</tr>	

						
					</tbody>
					</table>
				

			
		<div class="mainfooter">
			<h6>A-197,BLOCK 5,GULISTAN-E-JOHAR,KARACHI. PHONE:34618249,34633942, CELL:0321-2437003,0322-2437003 </h6>
		</div>
	</div>


	</body>


</html> 