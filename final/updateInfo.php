<?php
// Import dbconnect script here to use database connection
require_once __DIR__ . '/dbconnect.php';
// Database connection object to access mysql functions
$con = connect_db();

// Check if submit button is clicked
if (isset($_GET['updateState'])) {
  // Get data from request
  $IncidentID = $_GET['incidentID'];
  $IncidentState = $_GET['state'];
  
  // Update state in database
  $sql = $con->query("UPDATE INCIDENT SET state = '$IncidentState' WHERE incidentID = '$IncidentID'");
  
  // Check if query ran successfully
  if ($sql) {
    // Query ran successfully show success message
    echo "<script>alert('Successfully updated!')</script>";
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
<title>Update Incident Information</title>
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
		<!-- Show a form to user to update incident information-->
		
		<form method="get">
		<table border="0px"; bordercolor="white"; width=50%; height=100px>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident ID:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="VarChar" class="input" name="incidentID" placeholder="Enter the Incident ID." required> 
							 </input>
					 </td>
			 </tr>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident State:</strong><span>
					 </td align="left">
					 <td>
					 		 <select id="state" name="state">
							  <option value="open">Open</option>
							  <option value="closed">Closed</option>
							  <option value="stalled">Stalled</option>
							</select><br><br>
					 </td>
			 </tr>
			 </table>
<button type="submit" class="btn" name="updateState">Submit</button>
		
		
	</div>
</body>

</html>