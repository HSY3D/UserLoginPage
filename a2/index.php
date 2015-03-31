<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="center-menu.css" rel="stylesheet">
</head>
<body>
	<div>
		<form name="loginform" action="#" method="post">
			<h1>Username</h1><input type="next" name="username"><br>
			<h1>Password</h1><input type="password" name="password"><br><br>
			<input type="submit" onclick="handshake()" value="Login">
		</form>
	</div>
	<script type="text/javascript">
		/**
			This function does all the things
		*/
		function handshake() {
			// Get username and password from form
			var usr = document.loginform.username.value;
			var pwd = document.loginform.password.value;
			var sharedkey = 0;

			// alert(usr + " " + pwd);

			// Set up JSON
			var jsonobj = {"username":usr,"password":pwd};
			var jsonstr = JSON.stringify(jsonobj);
			// alert(jsonstr);

			// Set up handshake
			var xmlhttp = new XMLHttpRequest;
			var params = "username="+usr;
			xmlhttp.open("POST","handshake.php",true);
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					sharedkey = parseInt(xmlhttp.responseText);
					// alert(sharedkey);
					jsonobj.password = encrypt(sharedkey,usr,pwd);
					jsonstr = JSON.stringify(jsonobj);
					// alert(encrypted_key);
					// alert(jsonstr);
					// xmlhttp.open("POST","login.php",true);
					// toJSON(username,pwd);
					window.location = "http://cs.mcgill.ca/~hsyed2/a2/login.php?json="+jsonstr;
				}
			}
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			// xmlhttp.setRequestHeader("Content-length", params.length);
			// xmlhttp.setRequestHeader("Connection",close);
			// alert("jsut sent");
			xmlhttp.send(params);
			
		}

		function encrypt(shiftby, username, password) {
			var pwd = '';
			for (var i = 0; i < password.length; i++) {
				var c = password.charCodeAt(i);
				if (c >= 65 && c <= 90)
					pwd += String.fromCharCode((c - 65 + shiftby) % 26 + 65); // Uppercase
				else if (c >= 97 && c <= 122)
					pwd += String.fromCharCode((c - 97 + shiftby) % 26 + 97); // Lowercase
				else
					pwd += password.charAt(i);
			};
			// alert(pwd);
			return pwd;
			
		}

		// function toJSON(username, ci_password) {
		// 	var jsonObj = {
		// 		"username":"hsyed",
		// 		"password":"root"
		// 	}
		// 	var jsonstr = JSON.stringify(jsonObj);
		// 	alert("poop");

		// 	var xmlhttp = new XMLHttpRequest;
		// 	xmlhttp.open("POST","login.php",true);
		// 	xmlhttp.onreadystatechange = function () {
		// 		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		// 			var string = xmlhttp.responseText;
		// 			alert(xmlhttp.responseText);
		// 		}
		// 	}
		// 	xmlhttp.setRequestHeader("Content-type","application/json");
		// 	// xmlhttp.setRequestHeader("Connection",close);
		// 	xmlhttp.send(jsonstr);
			
		// }

		// alert("reached");

	</script>
</body>
</html>