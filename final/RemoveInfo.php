<?php
// Import dbconnect script here to use database connection
require_once __DIR__ . '/dbconnect.php';
// Database connection object to access mysql functions
$con = connect_db();

// Check if submit button is clicked
if (isset($_GET['removeIncident'])) {
  // Get data from request
  $IncidentId = $_GET['IncidentId'];
  
  // remove incident to database
  $sql3 = $con->query("select * FROM COMMENT WHERE commenID IN (SELECT commenID  FROM INCIDENT  WHERE incidentID = '$IncidentId')");
  $Incident3 = $sql3->fetch_array();
  $Comment = $Incident3['commenID'];
  
  $sql = $con->query("DELETE FROM incident WHERE incidentID = '$IncidentId'");
  
  $sql4 = $con->query("DELETE FROM comment WHERE commenID = '$Comment'");
  // Check if query ran successfully
  if ($sql) {
    // Query ran successfully show success message
    echo "<script>alert('Successfully removed!')</script>";
  } else {
    // Show Error
    echo "<script>alert('Some error occurred please check your data!')</script>";
  }
}


?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="style1.css">
</head>
<title>Remove Incident Information</title>
<body>
	<nav>
        <div id="logo"><a href="main.html"><img src="owl.png" width="35px"></a></div>

        <label for="drop" class="toggle">Computer Security Incident Response Team</label>
        <input type="checkbox" id="drop" />
            <ul class="menu" style="margin-top: 10px">
                <li><a href="viewInfo.php">View Incident Information</a></li>
				<li><a href="addInfo.php">Add New Incident Information</a></li>
                <li><a href="updateInfo.php">Update Incident Information</a></li>
				<li><a href="RemoveInfo.php">Remove Incident Information</a></li>
            </ul>
	</nav>
	
	<div class="container">
		<!-- Show a form to user to remove incident information-->
		<form method="get">
		<table border="0px"; bordercolor="white"; width=50%; height=50px>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident ID:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="VarChar" class="input" name="IncidentId" placeholder="Enter the Incident ID." required> <br>
							 </input>
					 </td>
			 </tr>
			 
			 </table>
			 <button type="submit" class="btn" name="removeIncident">Submit</button>

</form>
		
		
	</div>
</body>

</html>