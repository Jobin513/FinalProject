<?php
// Import dbconnect script here to use database connection
require_once __DIR__ . '/dbconnect.php';
// Database connection object to access mysql functions
$con = connect_db();

// Check if submit button is clicked
if (isset($_GET['addIncident'])) {
  // Get data from request
  $IncidentId = $_GET['IncidentID'];
  $IncidentType = $_GET['IncidentType'];
  $IncidenState = $_GET['IncidentState'];
  $Date = $_GET['Date'];
  $ResponderID = $_GET['ResponderID'];
  // Add incident to database
 // $sql = $con->query("INSERT INTO COMMENT(commenID, description, date, responderID) VALUES ('$CommentID','$IncidentType', '$Date', '$HandlerID')");
  $sql = $con->query("INSERT INTO INCIDENT(incidentID, type, state, date, responderID) VALUES ('$IncidentId', '$IncidentType', '$IncidenState', '$Date','$ResponderID')");
  $sql3 = $con->query("UPDATE INCIDENT SET commenID = NULL WHERE incidentID = '$IncidentId'");
  //Changes incident table's responderID to the responderID in comment table's
  /*$sql4 = $con->query("UPDATE INCIDENT
  					   JOIN COMMENT ON INCIDENT.commenID = COMMENT.commenID 
					   SET INCIDENT.commenID = '$CommentID', INCIDENT.responderID = COMMENT.responderID");
	//Changes comment table's  to the handlerID in incident table's
 /* $sql5 = $con->query("UPDATE COMMENT
  					   JOIN COMMENT ON INCIDENT.commenID = COMMENT.commenID 
					   SET INCIDENT.commenID = '$CommentID', INCIDENT.responderID = COMMENT.responderID");
	*/
  // Check if query ran successfully
  if ($sql) {
    // Query ran successfully show success message
    echo "<script>alert('Successfully added!')</script>";
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
<title>Add New Incident Information</title>
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
		
	
	<form method="get">
	<table border="0px"; bordercolor="white"; width=50%; height=100px>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident ID:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="VarChar" class="input" name="IncidentID" placeholder="Enter the Incident ID." required> <br>
							 </input>
					 </td>
			 </tr>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident Type:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="VarChar" class="input" name="IncidentType" placeholder="Enter the Incident Type" required>
							 </input>
					 </td>
			 </tr>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident State:</strong><span>
					 </td align="left">
					 <td>
					 		 <select id="IncidentState" name="IncidentState">
							  <option value="open">Open</option>
							  <option value="closed">Closed</option>
							  <option value="stalled">Stalled</option>
							</select>
					 </td>
			 </tr>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Date:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="Date" class="input" name="Date" placeholder="Enter the date of Incident" required>
							 </input>
					 </td>
			 </tr>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Responder ID:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="VarChar" class="input" name="ResponderID" placeholder="Enter the Responder ID" > <br>
							 </input>
					 </td>
			 </tr>
</table>
<button type="submit" class="btn" name="addIncident">Submit</button>

</form>
	
	
</body>

</html>