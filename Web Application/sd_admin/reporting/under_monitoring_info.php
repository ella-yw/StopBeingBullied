     <?php
    //**********************************************
    //*
    //*  Connect to MySQL and Database
    //*
    //**********************************************
        error_reporting(0);
    
		$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_stopbeingbullied');
	
		if (!$db)
		{
			print "<h1>Unable to Connect to MySQL</h1>";
		}
		
		$q = intval($_GET['q']);
		//Fetching Data OF ALL Feild Related to Action
		$sql_statement  = "SELECT DISTINCT `bully_id`,`bully_fname`,`bully_lname`, `bully_grade` FROM `action_taking` JOIN `un_incident_reporting_bully` USING (report_id) WHERE action_taking.need_monitoring = 'YES' AND un_incident_reporting_bully.bully_school_id = ".$q;
		
		
		$result = mysqli_query($db, $sql_statement);
		if (!$result) {
			$outputDisplay .= "<p style='color: red;'><b>MySQL No: ".mysqli_errno($db)."<br></b>";
			$outputDisplay .= "<b>MySQL Error: ".mysqli_error($db)."<br></b>";
			$outputDisplay .= "<b><br>SQL: ".$sql_statement."<br></b>";
			$outputDisplay .= "<b><br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br></b>";
			print $outputDisplay;
			print "error";
		}
		?>
			<div style='float:left; margin-left:20px'><h3 style = 'color:blue'><a onclick="<?php session_start(); $_SESSION['school_id_for_pdf'] = $q; ?>" href = "under_monitoring_pdf.php" >SAVE TO PDF</a></h3></div>
			<br/><br/><?php
		echo "<h1 style='text-align:center'>
			Bullies Currently Under Monitoring </h1>";
		echo "<table style='text-align:center;  margin:0 auto; border: 1px solid black;'>
<tr >
<th >&nbsp;&nbsp; Bully ID &nbsp;&nbsp;</th>
<th>&nbsp;&nbsp; Bully Last Name &nbsp;&nbsp;</th>
<th>&nbsp;&nbsp; Bully First Name &nbsp;&nbsp;</th>
<th>&nbsp;&nbsp; Bully Grade &nbsp;&nbsp;</th>
<th>&nbsp;&nbsp; Under Monitoring! &nbsp;&nbsp;</th>
</tr>";
		while ($row = mysqli_fetch_row($result)) {	
		
		$outputDisplay = "";
		
		
			echo "<tr style='text-align:center'> <td>&nbsp; $row[0] &nbsp;</td> <td>&nbsp; $row[1] &nbsp;</td > <td>&nbsp; $row[2] &nbsp;</td> <td>&nbsp; $row[3] &nbsp;</td><td> <input type = 'checkbox' checked/> </td> </tr>";
			
		
		}
		echo "</table>"
			
   ?>          
