<?php
	if(isset($_GET['json'])) {
		$json = json_decode($_GET['json'],true);
		$usr = $json['username'];
		$encpwd = $json['password'];
	}

	$user = 'root';
	$pass = '';
	$db = 'Q2DB';

	$conn = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");

	$sql = "SELECT username, memberID, sharedkey, password FROM members";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	// $username = $row['username'];
	    	// if ($usr == $username) {
	    	
	    	if ($usr == $row["username"]) {
	    	$sharedkey = $row["sharedkey"];
	    	$passwordDB = $row["password"];
	    	$memberID = $row["memberID"];
	        // echo " password: ". $passwordDB;
	    	}
	        
	    }
	} else {
	    echo "0 results";
	}

	// Decode the password
	$pwd = '';
	for ($i =0; $i < strlen($encpwd); $i++) {
		$c = ord($encpwd[$i]);
		if ($c >= 65 && $c <=90) {	
			for ($j = 0; $j < $sharedkey; $j++) {
				$c--;
				if($c == 64) {
					$c = 90;
				}
			}
		} else if ($c >= 97 && $c <= 122) {
			for ($k=0; $k < $sharedkey; $k++) { 
				$c--;
				if($c == 96){
					$c =122;
				}
			}
		} 
		$pwd .= chr($c);
	}
	// echo $pwd;

	if ($pwd == $passwordDB) {
		$sql = "INSERT INTO session (memberID)
		VALUES ($memberID)";
		

		if ($conn->query($sql) === TRUE) {
			$sql = "SELECT sessionID FROM session WHERE memberID=".$memberID;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
	    	// output data of each row
	   			while($row = $result->fetch_assoc()) {
				$sessionID = $row['sessionID'];
				}
			}
			// $sessionID = $row["memberID"];
			
			// echo $sessionID;
		    echo <<<END
		    	<!DOCTYPE html>
				<html>
				<head>
					<title>Logged In</title>
					<link href="center-menu.css" rel="stylesheet">
				</head>
				<body>
					<div>
						<h1>You have succesfully logged in!</h1>
			    		<form method="POST" action="logout.php">
			    			<input type="hidden" name="sessionID" value="$sessionID">
			    			<input type="submit" value="Logout">
			    		</form>
			    	</div>
		    	</body>
		    	</html>

END;

		    $sql = "DELETE FROM session WHERE memberID = $memberID";

		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else {
		echo "<script type='text/javascript'> window.location='index.php'</script>";
	}

	$conn->close();

?>