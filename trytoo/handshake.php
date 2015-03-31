<?php
	
	if ($_POST['username']) {
		$usr = $_POST['username'];
		
		$user = 'root';
		$pass = '';
		$db = 'Q2DB';

		$conn = new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");

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