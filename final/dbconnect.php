<!DOCTYPE html>
<html>
<head>
	<title>PHP Connect MySQL Database</title>
</head>
<body>
	<p><?php
		function connect_db()
		{
			$db_host = "localhost";   // Hostname
			$db_user = "root";  // Database username
			$db_pass = "";  // Database Password
			$db_name = "db_263_project";  // Database name

			$conn = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Connection failed: %s\n" . $conn->error);
			echo "Connected to the database successfully";
			return $conn;
		}	
	?></p>
</body>
</html>
