<?php
	session_start();
	$_SESSION['hello'] = "hello";
	unset($_SESSION['hello']);
	   if(isset($_SESSION['login_status_location_school_admin']) == ""  ) {
		header('Location: ../../login_panel.php');   
   }
   $location = $_SESSION['login_status_location_school_admin'];
?>
<?php
   
	//**********************************************
    //*
    //*  Connect to MySQL and Database
    //*
    //**********************************************
    
		$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_stopbeingbullied');
	
		if (!$db)
		{
			print "<h1>Unable to Connect to MySQL</h1>";
		}
  
require_once("dbcontroller.php");
$db_handle = new DBController();

// Initial Country Select
$query ="SELECT * FROM country";
$results = $db_handle->runQuery($query);
?>
<!DOCYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bully's No. of Incidents Report</title>
<script src="../../js/jquery-2.1.1.js" type="text/javascript"></script>

<script>
function getTotal(str) {
       	
	if (str == "") {
        document.getElementById("info").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("incidents").value = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","total_bullies_info.php?q="+str,true);
        xmlhttp.send();
    }
}

</script>
<script>
		
		function getBully(val) {
			
			$.ajax({
			type: "POST",
			url: "get_bully.php",
			data: 'grade=' + val,
			success: function(data){
				$("#bully-list").html(data);
			}
			});
		}
		
		
		
	</script>
<style>
html {
	background: url(background.jpg) no-repeat fixed;
	background-size: 100% 100%;
	font-family: Baskerville, 'Palatino Linotype', Palatino, 'Century Teacherbook L', 'Times New Roman', serif;
}
select {
	font-family: Baskerville, 'Palatino Linotype', Palatino, 'Century Teacherbook L', 'Times New Roman', serif;
}
#submit {
	font-family: Baskerville, 'Palatino Linotype', Palatino, 'Century Teacherbook L', 'Times New Roman', serif;
	width: 160px;
	height: 30px;
	border-radius: 7px;
	background-color: #FF0004;
	-webkit-transition: 0.5s ease;
	transition: 0.5s ease;
}
#submit:hover {
	font-size: 20px;
	width: 220px;
	height: 45px;
	background-color: blue;
	color: white;
}

.logout {
	float:right;
	margin-right:10px	 
 }
 

 </style>
</head>
<body>
<form method = "post" action="action_taking_backend.php" >
  <promo>
    <a class = "logout" onclick="<?php  ?>" href="master_reports.php">GO TO ANOTHER REPORT</a>
    
<br/>
 <div style = 'background-color: lightblue; width:100%; hieght:30px'><h1 style='text-align:center'>REPORT ON NUMBER OF INCIDENTS COMITTED BY BULLY</h1></div>
 
 

      <h4 style = "color:black ; margin-left:20px"> Choose Bully Grade:
        <select id = 'grade-list' name = 'grade' onChange="getBully(this.value);" required>
	<option value="">Select Grade...</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>

        </select>
      </h4>
      <h4 style = "color:black ; margin-left:40px"> Choose Bully: <br/>
      <select id = 'bully-list' name = 'bully' size='5' onChange="getTotal(this.value);" required>
        <option value=''>---</option>
      </select>
	  </h4>
		<h2 style = "color:blue ; margin-left:60px"> Total Incident Commited: <br/>
      <input id = "incidents" type = "text" size = "4" disabled='disabled'>
	  </h2>
  </div>
  <br/>
  <div id = "info"></div>
  
 
</form>
</body>
</html>

   



