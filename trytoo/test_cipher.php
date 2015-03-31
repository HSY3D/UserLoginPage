<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		var shiftby = 4;
		var pwd = '';
	var password = 'root';

		for (var i = 0; i < password.length; i++) {
			var c = password.charCodeAt(i);
			if (c >= 65 && c <= 90)
				pwd += String.fromCharCode((c - 65 + shiftby) % 26 + 65); // Uppercase
			else if (c >= 97 && c <= 122)
				pwd += String.fromCharCode((c - 97 + shiftby) % 26 + 97); // Lowercase
			else
				pwd += password.charAt(i);
		};	
		
		alert(pwd);
	</script>
</body>
</html>