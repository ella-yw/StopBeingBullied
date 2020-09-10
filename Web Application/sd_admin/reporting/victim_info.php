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
		
		$gender = strval($_GET['q']);
		$grade = intval($_GET['y']);
		$school = intval($_GET['z']);
		
		//Fetching Data OF ALL Feild Related to Action
		$sql_statement  = "SELECT DISTINCT `victim_id`,`victim_fname`,`victim_lname` FROM `un_incident_reporting_victim` WHERE victim_school_id = $school AND victim_grade = $grade AND victim_gender = '$gender' ";
		
		
		$result = mysqli_query($db, $sql_statement);
		
		$outputDisplay = "";
		
		if (!$result) {
			$outputDisplay .= "<p style='color: red;'><b>MySQL No: ".mysqli_errno($db)."<br></b>";
			$outputDisplay .= "<b>MySQL Error: ".mysqli_error($db)."<br></b>";
			$outputDisplay .= "<b><br>SQL: ".$sql_statement."<br></b>";
			$outputDisplay .= "<b><br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br></b>";
			print $outputDisplay;
			print "error";
		}
		if ($gender == "Male") {
			$title = "Male Victims of Bullying";
		}
		elseif ($gender == "Female") {
			$title = "Female Victims of Bullying";
		}
		else {
			$title = "Victims of Bullying (Other)";
		}
		?>
			<div style='float:left; margin-left:20px'><h3 style = 'color:blue'><a onclick="<?php session_start(); $_SESSION['school_id_for_pdf'] = $school; $_SESSION['grade_for_pdf'] = $grade; $_SESSION['gender_for_pdf'] = $gender; ?>" href = "victim_gender_pdf.php" >SAVE TO PDF</a></h3></div>
			<br/><br/><?php
		echo "<h1 style='text-align:center'>
			$title </h1>";
		echo "<table style='text-align:center;  margin:0 auto; border: 1px solid black;'>
<tr >
<th >&nbsp;&nbsp; Victim ID &nbsp;&nbsp;</th>
<th>&nbsp;&nbsp; Victim Last Name &nbsp;&nbsp;</th>
<th>&nbsp;&nbsp; Victim First Name &nbsp;&nbsp;</th>
</tr>";
		while ($row = mysqli_fetch_row($result)) {	
		
		
		
			echo "<tr style='text-align:center'> <td>&nbsp; $row[0] &nbsp;</td> <td>&nbsp; $row[1] &nbsp;</td > <td>&nbsp; $row[2] &nbsp;</td>  </tr>";
			
		
		}
		echo "</table>";
			
   ?>          
