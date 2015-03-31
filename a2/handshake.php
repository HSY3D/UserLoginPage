<?php
	
	if ($_POST['username']) {
		$usr = $_POST['username'];
		
		$user = 'hsyed2';
		$pass = '260510904';
		$db = '2014fall307hsyed2';
		$servername = 'mysql.cs.mcgill.ca';

		$conn = new mysqli($servername,$user,$pass,$db) or die("Unable to connect");

		$sql = "SELECT username, sharedkey FROM members";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$username = $row["username"];
		    	$sharedkey = $row["sharedkey"];
		    	
		    	if ($usr == $username) {
		    		echo $sharedkey;
		    	}
		    }
		} else {
			echo "0 results";
		}

		$conn->close();
	}
?>