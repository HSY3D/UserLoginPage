<?php
	// echo "yo";

	$sessionID = $_POST["sessionID"];
	// echo $sessionID;	
	// die();
	$user = 'hsyed2';
		$pass = '260510904';
		$db = '2014fall307hsyed2';
		$servername = 'mysql.cs.mcgill.ca';

		$conn = new mysqli($servername,$user,$pass,$db) or die("Unable to connect");

	// $sql = "SELECT memberID, sharedkey, password FROM members";
	// $result = $conn->query($sql);

	// if ($result->num_rows > 0) {
	//     // output data of each row
	//     while($row = $result->fetch_assoc()) {
	//     	$sharedkey = $row["sharedkey"];
	//     	$passwordDB = $row["password"];
	//     	$memberID = $row["memberID"];
	//         // echo " password: ". $passwordDB;
	//     }
	// } else {
	//     echo "0 results";
	// }

	$sql = "DELETE FROM session WHERE sessionID=$sessionID";
	if ($conn->query($sql) == true) {
		// echo "bye";
		echo <<<END
				<!DOCTYPE html>
				<html>
				<head>
					<title>Logged Out</title>
					<link href="center-menu.css" rel="stylesheet">
				</head>
				<body>
					<div>
						<h1><a href="http://cs.mcgill.ca/~hsyed2/a2/">BACK</a></h1>
					</div>
				</body>
				</html>		
END;
	} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

	$conn->close();
?>