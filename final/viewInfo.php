<?php
// Import dbconnect script here to use database connection
require_once __DIR__ . '/dbconnect.php';
// Database connection object to access mysql functions
$con = connect_db();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="style1.css">
</head>
<title>View Incident Information</title>
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
    <!-- Show a form to get Incidentid and if incidentID matches one in teh database then show incident information -->
    <?php if (empty($_GET)) : ?>

	  <form method="get">
		<table border="0px"; bordercolor="white"; width=50%; height=50px>
			 <tr align="left" valign="top">
			 		 <td>
					 		 <span style="font-size:20px"><strong>Incident ID:</strong><span>
					 </td>
					 <td align="left">
					 		 <input type="VarChar" class="input" name="incidentID" id="incidentID" placeholder="Enter the incidentID." required>
							 </input>
					 </td>
			 </tr>
			 </table>
			 <button type="submit" class="btn" name="checkIncident">Submit</button>

    <?php else : ?>
      <div class="card">
        <?php
        // Check if user submitted the form
        if (isset($_GET['checkIncident'])) {
          // Get incident id
          $incidentID = $_GET['incidentID'];

          // Check for incident in database
          // Create a query to fetch data from incident table
          $sql1 = $con->query("SELECT * FROM Incident WHERE incidentID = '$incidentID'");

          // If number of rows in result is zero then print error
          if ($sql1->num_rows == 0) {
        ?>
            <div class="error">
              Incident not found.
            </div>
          <?php
          } else {
            // Get incident info from incident table and print incident information
            $sql = $con->query("SELECT * FROM INCIDENT WHERE incidentID = '$incidentID'");
			$sql3 = $con->query("SELECT * FROM COMMENT WHERE commenID IN (SELECT commenID  FROM INCIDENT  WHERE incidentID = '$incidentID')");
      $sql4 = $con->query("SELECT * FROM RESPONDER WHERE responderID IN (SELECT responderID  FROM INCIDENT  WHERE incidentID = '$incidentID')");
            $Incident = $sql->fetch_array();
            
			$Incident3 = $sql3->fetch_array();
      $Responder = $sql4->fetch_array();
            // Print details
          ?>
            <b>Incident ID: </b> <?= $Incident['incidentID'] ?> <br>
            <b>Incident Type: </b> <?= $Incident['type'] ?> <br>
            <b>Incident State: </b> <?= $Incident['state'] ?> <br>
			<b>Date of Incident: </b> <?= $Incident['date'] ?> <br>
      <b>Responder ID: </b> <?= $Incident['responderID'] ?> <br>
      <b>Responder: </b> <?= $Responder['handler'] ?> <br>
            <hr>
			
			
        <?php
          }
        }
        ?>
      </div>
    <?php endif ?>
	
	
	
  </div>
</body>

</html>